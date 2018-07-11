<?php

/**
 * This is the model class for table "{{member_upgrade}}".
 *
 * The followings are the available columns in table '{{member_upgrade}}':
 * @property string $id
 * @property string $promotioncode
 * @property string $tanggal
 * @property integer $idmember
 * @property integer $idmemberplan
 * @property string $tanggal_start
 * @property string $tanggal_expired
 * @property string $price_idr
 * @property string $price_sgd
 * @property string $status
 * @property integer $usercreate
 * @property string $datecreate
 */
class DataRingkasan extends CFormModel {

    public $propinsi;
	public $kotadati2;
    public $kecamatan;
	public $kelurahan;
	public $blok;
	public $nomor_urut;
	public $kd_jenis;
	public $nama_wp;
	public $letak_op;
	public $is_pagination = [];
	/*
    const STATUS_PENDING = 0;
    const STATUS_RUNING = 1;
	*/
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('propinsi, kotadati2,kecamatan,kelurahan,blok,nomor_urut,kd_jenis,nama_wp,letak_op', 'safe'),
        );
    }
    public function search() {
		$kecamatan = $this->kecamatan;
		$kelurahan = $this->kelurahan;
		$blok = $this->blok;
		$nama_wp = $this->nama_wp;
		$letak_op = $this->letak_op;
		
		if( !empty($this->description)){
			$description = explode(" ", $this->description); 
			if( count($description) > 0 ){
				$sl = false;
				foreach( $description as $val ){
					$sl[]= "(produkInfos.nama REGEXP '".addslashes($val)."')";
				}
				if( $sl != false ){
					$pm = implode("+",$sl);
					$criteria2->select = " *,( $pm ) as count_words ";
				}
			}
		}
		
		$sql = "Select 
					DO.KD_BLOK||'-'||DO.NO_URUT||'.'||DO.KD_JNS_OP BLOK_KD_JENIS,
					DO.JALAN_OP,DO.RW_OP||'-'||DO.RT_OP AS RT_RW,
					SP.NM_WP,
					DOP.KD_ZNT,
					DOP.LUAS_BUMI,
					DOB.LUAS_BNG,
					SP.KOTA_WP,
					SP.KELURAHAN_WP,
					SP.RT_WP,
					SP.RW_WP,
					DO.NJOP_BUMI, DO.NJOP_BNG, (DO.NJOP_BUMI + DO.NJOP_BNG ) AS TOTAL_NJOP
				from 
					DAT_OBJEK_PAJAK DO join DAT_SUBJEK_PAJAK SP on DO.SUBJEK_PAJAK_ID = SP.SUBJEK_PAJAK_ID 
					LEFT JOIN DAT_OP_BUMI DOP ON DO.KD_PROPINSI = DOP.KD_PROPINSI
					AND DO.KD_DATI2 = DOP.KD_DATI2
					AND DO.KD_KECAMATAN = DOP.KD_KECAMATAN
					AND DO.KD_KELURAHAN = DOP.KD_KELURAHAN
					AND DO.KD_BLOK = DOP.KD_BLOK
					AND DO.NO_URUT = DOP.NO_URUT
					AND DO.KD_JNS_OP = DOP.KD_JNS_OP
					LEFT JOIN DAT_OP_BANGUNAN DOB ON DO.KD_PROPINSI = DOB.KD_PROPINSI
					AND DO.KD_DATI2 = DOB.KD_DATI2
					AND DO.KD_KECAMATAN = DOB.KD_KECAMATAN
					AND DO.KD_KELURAHAN = DOB.KD_KELURAHAN
					AND DO.KD_BLOK = DOB.KD_BLOK
					AND DO.NO_URUT = DOB.NO_URUT
					AND DO.KD_JNS_OP = DOB.KD_JNS_OP
					WHERE 1 = 1 
				AND DO.KD_PROPINSI = '".Yii::app()->report->Kodepropinsi()."' 
				AND DO.KD_DATI2 = '".Yii::app()->report->Kodekabupaten()."' ";
		if( $kecamatan != "" ){
			$sql .= " AND DO.KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( $kelurahan != "" ){
			$sql .= " AND DO.KD_KELURAHAN = '".$kelurahan."' ";
		}
		if( $blok != "" ){
			$sql .= " AND DO.KD_BLOK = '".$blok."' ";
		}
		if( $blok != "" ){
			$sql .= " AND DO.KD_BLOK = '".$blok."' ";
		}
		if( $this->nomor_urut != "" ){
			$sql .= " AND DO.NO_URUT = '".$this->nomor_urut."' ";
		}
		if( $this->kd_jenis != "" ){
			$sql .= " AND DO.KD_JNS_OP = '".$this->kd_jenis."' ";
		}
		
		if( $nama_wp != "" ){
			
			$sql .= " AND  ( REGEXP_LIKE (SP.NM_WP, '".$nama_wp."') ";
			$nama_wp = explode(" ",$nama_wp);
			if( count($nama_wp) > 0 ){
				foreach( $nama_wp as $p ){
					//$sql .= " OR   REGEXP_LIKE (SP.NM_WP, '".$p."') ";
				}
			}
			$sql .= " ) ";
		}
		if( $letak_op != "" ){
			
			$sql .= " AND  ( REGEXP_LIKE (DO.JALAN_OP, '".$letak_op."') ";
			$letak_op = explode(" ",$letak_op);
			if( count($letak_op) > 0 ){
				foreach( $letak_op as $p ){
					$sql .= " OR   REGEXP_LIKE (DO.JALAN_OP, '".$p."') ";
				}
			}
			$sql .= " ) ";
		}
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		$sql .= " AND ROWNUM <= $count";
		//t_order.tanggal between '$awal' and '$akhir'
	   return new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'BLOK_KD_JENIS',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'BLOK_KD_JENIS', 'count'
                ),
				'defaultOrder'=>'BLOK_KD_JENIS DESC',
            ),
            'pagination'=>$this->is_pagination,
                )
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
