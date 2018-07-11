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
class LaporanObjekPajakLokasi extends CFormModel {

    public $limit = 10;
	public $userId;
	public $jum_rows;
	public $lastdate;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('userId,lastdate', 'safe', 'on'=>'search'),
        );
    }
	public function attributeLabels()
	{
		return array(
			'userId' => 'NIK PEREKAM LOKASI'
		);
	}
	public function getJumROws(){
		return $this->jum_rows;
	}
    public function search() {
		$sql = "select 
					A.KD_PROPINSI||'.'||A.KD_DATI2||'.'||A.KD_KECAMATAN||'.'||
					A.KD_KELURAHAN||'.'||A.KD_BLOK||'-'||A.NO_URUT||'.'||A.KD_JNS_OP NOP,
					B.NM_WP,
					B.KOTA_WP,
					B.KELURAHAN_WP,
					B.JALAN_WP,
					B.RT_WP,
					B.RW_WP,
					A.JALAN_OP,
					A.RT_OP,
					A.RW_OP,
					A.TOTAL_LUAS_BUMI,
					A.TOTAL_LUAS_BNG,
					A.TGL_PENAMBAHAN_LOKASI,
					A.LATTITUDE,
					A.LONGITUDE,
					TO_CHAR(A.TGL_PENAMBAHAN_LOKASI, 'YYYY-MM-DD HH24:MI:SS') AS DATE_TAMBAH_LOKASI
				from 
					DAT_OBJEK_PAJAK A, DAT_SUBJEK_PAJAK B
				WHERE  A.SUBJEK_PAJAK_ID = B.SUBJEK_PAJAK_ID ";
				$sql .= "  AND A.LATTITUDE is not NULL ";
					
		if( $this->userId != "" ){
			$sql .= " AND A.NIP_PEREKAM_LOKASI = '".$this->userId."'";
		}
		if( !empty($this->lastdate)){
			$date = $this->lastdate;
			$sql .= " AND A.TGL_PENAMBAHAN_LOKASI < to_date('$date','YYYY/MM/DD HH24:MI:SS') ";
		}
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		$l = $this->limit;
		$sql .= " AND ROWNUM <= $l ";
		//t_order.tanggal between '$awal' and '$akhir'
	   return new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'NOP',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'TGL_PENAMBAHAN_LOKASI', 'count'
                ),
				'defaultOrder'=>'A.TGL_PENAMBAHAN_LOKASI DESC',
            )
            )
        );
	}

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
