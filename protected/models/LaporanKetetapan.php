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
class LaporanKetetapan extends CFormModel {

    public $tahun;
	public $propinsi;
	public $dati2;
    public $kecamatan;
	public $kelurahan;
	public $blok;
	public $no_urut;
	public $kd_jenis_op;
	public $is_pagination = 10;
	public $status_bayar;
	public $tanggal_terbit;
	public $tanggal_jatuh_tempo;
	public $sortby = "NOP DESC";
	public $limit_date;
	public $group_by;
	const ORDER_TAHUN = 0;
	const ORDER_KECAMATAN = 1;
	const ORDER_KELURAHAN = 2;
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
            array('group_by,tahun, propinsi,dati2, kecamatan,kelurahan,blok,no_urut,kd_jenis_op,status_bayar,tanggal_terbit,limit_date,tanggal_jatuh_tempo', 'safe'),
        );
    }
	public function _order($order, $type ){
		$array[self::ORDER_TAHUN] = [
			'rGrid' => array(
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),
							array(
								'name' => 'JUM_OBJEK',                     
								'header'=>'TOTAL OBJEK'
							),
							array(
								'name' => 'KETETAPAN',
								'header'=>'KETETAPAN',				
							)	
						)
		];
		$array[self::ORDER_KECAMATAN] = [
			'select' => '  B. KD_KECAMATAN,',
			'group' => ' B. KD_KECAMATAN, ',
			'rGrid' => array(
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),
							array(
								'name' => 'KD_KECAMATAN', 
								'header'=>'KECAMATAN',
								'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
							),
							array(
								'name' => 'JUM_OBJEK',                     
								'header'=>'TOTAL OBJEK'
							),
							array(
								'name' => 'KETETAPAN',
								'header'=>'KETETAPAN',				
							)
								
						)
		];
		$array[self::ORDER_KELURAHAN] = [
			'select' => ' B. KD_KECAMATAN, B.KD_KELURAHAN, ',
			'group' => ' B. KD_KECAMATAN, B. KD_KELURAHAN, ',
			'rGrid' => array(
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),
							array(
								'name' => 'KD_KECAMATAN', 
								'header'=>'KECAMATAN',
								'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
							),
							array(
								'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',
								'header'=>'KEL/DESA',
							),
							array(
								'name' => 'JUM_OBJEK',                     
								'header'=>'TOTAL OBJEK'
							),
							array(
								'name' => 'KETETAPAN',
								'header'=>'KETETAPAN',				
							)	
								
						)
		];
		
		if( isset( $array[$order][$type]) ){
			return $array[$order][$type];
		}
	}
    public function search() {
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		
		$sql = "  SELECT B.KD_PROPINSI||'.'||B.KD_DATI2||'.'||B.KD_KECAMATAN||'.'||
				B.KD_KELURAHAN||'.'||B.KD_BLOK||'-'||B.NO_URUT||'.'||B.KD_JNS_OP NOP,
				B.KD_KECAMATAN,
				B.KD_KELURAHAN,
				E.SUBJEK_PAJAK_ID AS NOMOR_ID,
				B.NM_WP_SPPT AS NAMA_WP, 
				B.JLN_WP_SPPT AS ALAMAT_WP,
				E.JALAN_OP AS ALAMAT_OP,
				B.LUAS_BUMI_SPPT AS LUAS_BUMI,
				B.LUAS_BNG_SPPT AS LUAS_BNG,
				B.KD_KLS_TANAH AS KELAS_TANAH,
				B.KD_KLS_BNG AS KELAS_BNG,
				B.NJOP_BUMI_SPPT AS NJOP_BUMI,
				B.NJOP_BNG_SPPT AS NJOP_BNG,
				B.NJOP_SPPT AS NJOP,
				B.NJOPTKP_SPPT AS NJOPTKP,
				B.PBB_TERHUTANG_SPPT AS KETETAPAN_ASLI,
				( CASE WHEN B.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE B.PBB_TERHUTANG_SPPT END ) AS KETETAPAN,
				B.THN_PAJAK_SPPT TAHUN,
				B.TGL_TERBIT_SPPT AS TGL_TERBIT,
				B.KD_KANWIL,
				B.KD_KANTOR,
				B.KD_TP,
				to_char(B.TGL_JATUH_TEMPO_SPPT, 'DD-MON-YY') AS TGL_JTH_TEMPO,
				DECODE(STATUS_PEMBAYARAN_SPPT,'0','BELUM BAYAR','1','BAYAR') STATUS
				FROM SPPT B,DAT_OBJEK_PAJAK E  ,PBB_MINIMAL C
				WHERE 
				---DAT_OBJEK_PAJAK---
				B.KD_PROPINSI=E.KD_PROPINSI(+)
				AND B.KD_DATI2=E.KD_DATI2(+)
				AND B.KD_KECAMATAN=E.KD_KECAMATAN(+)
				AND B.KD_KELURAHAN=E.KD_KELURAHAN(+)
				AND B.KD_BLOK=E.KD_BLOK(+)
				AND B.NO_URUT=E.NO_URUT(+)
				AND B.KD_JNS_OP=E.KD_JNS_OP(+) 
				AND B.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL"; 
		if((int)$this->tahun >= Yii::app()->report->tahun_mulai() ){
			$sql .= " AND B.THN_PAJAK_SPPT = '".$tahun."' ";
		}
		if( (int) $this->propinsi > 0 ){
			$sql .= " AND B.KD_PROPINSI = '".$this->propinsi."' ";
		}
		if( (int) $this->dati2 > 0 ){
			$sql .= " AND B.KD_DATI2 = '".$this->dati2."' ";
		}
		if( (int) $kecamatan > 0 ){
			$sql .= " AND B.KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( (int) $this->kelurahan > 0 ){
			$sql .= " AND B.KD_KELURAHAN = '".$this->kelurahan."' ";
		}
		if( !empty( $this->blok ) ){
			$sql .= " AND B.KD_BLOK = '".$this->blok."' ";
		}
		if( !empty( $this->no_urut ) ){
			$sql .= " AND B.NO_URUT = '".$this->no_urut."' ";
		}
		if( !empty( $this->kd_jenis_op ) ){
			$sql .= " AND B.KD_JNS_OP = '".$this->kd_jenis_op."' ";
		}
		if( $this->status_bayar != '' ){
			$sql .= " AND STATUS_PEMBAYARAN_SPPT = '".$this->status_bayar."' ";
		}
		if( $this->limit_date != "" ){
			$sql .= " AND B.THN_PAJAK_SPPT >= '".$this->limit_date."' ";
		}
		if( $this->tanggal_terbit != '' ){
			$tterbit = explode(" - ", $this->tanggal_terbit );
			if( count($tterbit) == 2 ){ 
				$tanggal_awal =  explode("-",$tterbit[0]); //b t T 
				$tanggal_akhir = explode("-",$tterbit[1]);
				$sql .= " AND B.TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS')
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS')";
			}
		}
		if( $this->tanggal_jatuh_tempo != '' ){
			$tJTempo = explode(" - ", $this->tanggal_jatuh_tempo );
			if( count($tJTempo) == 2 ){ 
				$tanggal_awal =  explode("-",$tJTempo[0]); //b t T 
				$tanggal_akhir = explode("-",$tJTempo[1]);
				$sql .= " AND B.TGL_JATUH_TEMPO_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS')
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS')";
			}
		}
		//echo $sql;
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		$sql .= " AND ROWNUM <= $count ";
		return new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'NOP',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'NOP', 'count'
                ),
				'defaultOrder'=>$this->sortby,
            ),
            'pagination'=>$this->is_pagination,
                )
        );
    }
	public function searchRekapitulasi() {
		$_select = "";
		$_group = "";
		
		if( $this->group_by != "" ){
			$_select = self::_order($this->group_by,'select');
			$_group = self::_order($this->group_by,'group');
		}
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		$sql = "  SELECT 
				$_select
				SUM( ( CASE WHEN B.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE B.PBB_TERHUTANG_SPPT END ) ) AS KETETAPAN,
				COUNT(*) as JUM_OBJEK,
				B.THN_PAJAK_SPPT TAHUN
				FROM SPPT B,DAT_OBJEK_PAJAK E,PBB_MINIMAL C
				WHERE 
				---DAT_OBJEK_PAJAK---
				B.KD_PROPINSI=E.KD_PROPINSI(+)
				AND B.KD_DATI2=E.KD_DATI2(+)
				AND B.KD_KECAMATAN=E.KD_KECAMATAN(+)
				AND B.KD_KELURAHAN=E.KD_KELURAHAN(+)
				AND B.KD_BLOK=E.KD_BLOK(+)
				AND B.NO_URUT=E.NO_URUT(+)
				AND B.KD_JNS_OP=E.KD_JNS_OP(+) 
				AND B.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL";
		if((int)$this->tahun >= Yii::app()->report->tahun_mulai() ){
			$sql .= " AND B.THN_PAJAK_SPPT = '".$tahun."' ";
		}
		
		if( (int) $kecamatan > 0 ){
			$sql .= " AND B.KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( (int) $this->kelurahan > 0 ){
			$sql .= " AND B.KD_KELURAHAN = '".$this->kelurahan."' ";
		}
		
		if( $this->status_bayar != '' ){
			$sql .= " AND B.STATUS_PEMBAYARAN_SPPT = '".$this->status_bayar."' ";
		}
		
		if( $this->tanggal_terbit != '' ){
			$tterbit = explode(" - ", $this->tanggal_terbit );
			if( count($tterbit) == 2 ){ 
				$tanggal_awal =  explode("-",$tterbit[0]); //b t T 
				$tanggal_akhir = explode("-",$tterbit[1]);
				$sql .= " AND B.TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS')
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
			}
		}
		
		$sql .= " GROUP BY $_group  B.THN_PAJAK_SPPT";
		
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		//$sql .= " AND ROWNUM <= $count ";
		return new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'TAHUN',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'TAHUN', 'count'
                ),
				'defaultOrder'=>$this->sortby,
            ),
            'pagination'=>$this->is_pagination,
                )
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
	public function attributeLabels()
	{
		return array(
			'tahun' => 'Tahun Ketetapan',
			'group_by' => 'Kumpulkan Berdasarkan',
			'tanggal_terbit' => 'Periode Penetapan/Terbit'
		);
	}
	

}
