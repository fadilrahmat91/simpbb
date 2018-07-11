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
class RealisasiTahunan extends CFormModel {

    public $tahun;
    public $kecamatan;
	public $is_pagination = 10;
	public $kelurahan;
	public $tanggal_bayar;
	public $tanggal_terbit_sppt;
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
            array('tahun, kecamatan,kelurahan,tanggal_bayar,group_by,tanggal_terbit_sppt', 'safe'),
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
								'name' => 'TOTAL_OBJEK',                     
								'header'=>'TOTAL OBJEK'
							),
							array(
								'name' => 'KETETAPAN', 
								'header'=>'KETETAPAN',
								'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])', 
							),
							array(
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_DENDA"])',
								'header'=>'PEMBAYARAN DENDA',				
							), 			
							array(
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_POKOK"])',                     
								'header'=>'PEMBAYARAN POKOK'
							),
							array(
								'value' => 'Yii::app()->report->uangFormat($data["LEBIH_BAYAR"])',                     
								'header'=>'LEBIH BAYAR'
							),
							array(
								'value' => 'Yii::app()->report->uangFormat($data["KURANG_BAYAR"])',                     
								'header'=>'KURANG BAYAR'
							),
								
						)
		];
		$array[self::ORDER_KECAMATAN] = [
			'select' => '  KD_KECAMATAN,',
			'group' => ' KD_KECAMATAN, ',
			'rGrid' => array(
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),
							array(
								'name' => 'TOTAL_OBJEK',                     
								'header'=>'TOTAL OBJEK'
							),
							array(
								'name' => 'KD_KECAMATAN', 
								'header'=>'KECAMATAN',
								'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
							),
							array(
								'name' => 'KETETAPAN', 
								'header'=>'KETETAPAN',
								'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])', 
							),
							
							array(
								'name' => 'PEMBAYARAN',
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_DENDA"])',
								'header'=>'PEMBAYARAN DENDA',				
							), 			
							array(
								'name' => 'PEMBAYARAN_POKOK',
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_POKOK"])',                     
								'header'=>'PEMBAYARAN POKOK'
							),
							array(
								'value' => 'Yii::app()->report->uangFormat($data["LEBIH_BAYAR"])',                     
								'header'=>'LEBIH BAYAR'
							),
							array(
								'value' => 'Yii::app()->report->uangFormat($data["KURANG_BAYAR"])',                     
								'header'=>'KURANG BAYAR'
							),
						)
		];
		$array[self::ORDER_KELURAHAN] = [
			'select' => ' KD_KECAMATAN, KD_KELURAHAN, ',
			'group' => ' KD_KECAMATAN, KD_KELURAHAN, ',
			'rGrid' => array(
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),
							array(
								'name' => 'TOTAL_OBJEK',                     
								'header'=>'TOTAL OBJEK'
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
								'name' => 'KETETAPAN', 
								'header'=>'KETETAPAN',
								'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])', 
							),
							array(
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_DENDA"])',
								'header'=>'PEMBAYARAN DENDA',				
							), 			
							array(
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_POKOK"])',                     
								'header'=>'PEMBAYARAN POKOK'
							),
							array(
								'value' => 'Yii::app()->report->uangFormat($data["LEBIH_BAYAR"])',                     
								'header'=>'LEBIH BAYAR'
							),
							array(
								'value' => 'Yii::app()->report->uangFormat($data["KURANG_BAYAR"])',                     
								'header'=>'KURANG BAYAR'
							),	
						)
		];
		
		if( isset( $array[$order][$type]) ){
			return $array[$order][$type];
		}
	}
	public function search(){
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		$_select = "";
		$_group = "";
		
		if( $this->group_by != "" ){
			$_select = self::_order($this->group_by,'select');
			$_group = self::_order($this->group_by,'group');
		}
		$tahun_sppt1 = "";
		$tahun_sppt2 = "";
		$tahun_sppt3 = "";
		if( is_array($tahun)){
			if( count($tahun) > 0 ){
				
				$sqltahun = false;
				foreach( $tahun as $ptahun ){
					if( (int)$ptahun >= Yii::app()->report->tahun_mulai() && (int)$ptahun <= Yii::app()->report->tahun_akhir() ){
						//$sqltahun[] = "  A. THN_PAJAK_SPPT = '$ptahun'";
						$sqltahun[] = $ptahun;
					}
				}
				
				if( $sqltahun != false ){
					/*$sql .= " AND ( ";
					$sql .= implode(" or ",$sqltahun);
					$sql .= " ) ";
					*/
					$tahun = "'".implode("','",$sqltahun)."'";
					$tahun_sppt1 = " AND BC.THN_PAJAK_SPPT in ($tahun)  ";
					$tahun_sppt2 = " AND A.THN_PAJAK_SPPT in ($tahun)   ";
					$tahun_sppt3 = " AND B.TAHUN in ($tahun)  ";
				}
			}
		}
		if( (int) $kecamatan > 0 ){
			$tahun_sppt1 .= " AND BC.KD_KECAMATAN = '".$kecamatan."' ";
			$tahun_sppt2 .= " AND A.KD_KECAMATAN_P = '".$kecamatan."'   ";
			$tahun_sppt3 .= " AND KD_KECAMATAN = '".$kecamatan."'  ";
		}
		if( (int) $this->kelurahan > 0 ){
			$tahun_sppt1 .= " AND BC.KD_KELURAHAN = '".$this->kelurahan."' ";
			$tahun_sppt2 .= " AND A.KD_KELURAHAN_P = '".$this->kelurahan."'  ";
			$tahun_sppt3 .= " AND KD_KELURAHAN = '".$this->kelurahan."'  ";
		}
		
		if( $this->tanggal_bayar != '' ){
			$tbayar = explode(" - ",$this->tanggal_bayar);
			if( count($tbayar) > 0 ){
				$tanggal_b = true;
				$tanggal_awal =  explode("-",$tbayar[0]); //b t T 
				$tanggal_akhir = explode("-",$tbayar[1]);
				// t   b T
				$tahun_sppt2 .= " AND A.TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				//AND BC.TGL_TERBIT_SPPT BETWEEN TO_DATE('01/01/2017 00:00:00', 'MM/DD/YYYY HH24:MI:SS') AND TO_DATE('12/31/2017 11:59:00', 'MM/DD/YYYY HH24:MI:SS')
			}
			//echo $sqls;
		}
		if( $this->tanggal_terbit_sppt != '' ){
			$tterbit = explode(" - ",$this->tanggal_terbit_sppt);
			if( count($tterbit) > 0 ){
				
				$tanggal_awal =  explode("-",$tterbit[0]); //b t T 
				$tanggal_akhir = explode("-",$tterbit[1]);
				// t   b T
				$tahun_sppt1 .= " AND BC.TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				//AND A.TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('01/01/2017 00:00:00', 'MM/DD/YYYY HH24:MI:SS') AND TO_DATE('12/31/2017 11:59:00', 'MM/DD/YYYY HH24:MI:SS')  
			}
			//echo $sqls;
		}		
		$sql = "select $_select
					SUM(PIUTANG) as KETETAPAN, COUNT(*) as JUM_OBJEK,
					SUM(JUMLAH_BAYAR) AS PEMBAYARAN_POKOK,
					SUM(SELISIH) as SELISIH,
					SUM(KURANG_BAYAR) as KURANG_BAYAR, 
					SUM(LEBIH_BAYAR) AS LEBIH_BAYAR,
					SUM(DENDA_SPPT) AS PEMBAYARAN_DENDA,
					COUNT(*) AS TOTAL_OBJEK,
					TAHUN
					from (
						select 
							PIUTANG,
							JUMLAH_BAYAR, 
							(CASE WHEN SELISIH > 0 THEN SELISIH ELSE 0 END ) AS LEBIH_BAYAR,
							(CASE WHEN SELISIH < 0 THEN SELISIH ELSE 0 END ) AS KURANG_BAYAR,
							TAHUN,
							DENDA_SPPT,
							SELISIH,
							KD_KECAMATAN,
							KD_KELURAHAN
						from (
								select 
									PIUTANG,  
									JUMLAH_BAYAR,
									(JUMLAH_BAYAR - PIUTANG ) AS SELISIH,
									DENDA_SPPT,
									B.KD_KECAMATAN,
									B.KD_KELURAHAN,
									B.TAHUN  from (
										select  
											BC.PBB_TERHUTANG_SPPT AS PIUTANGASLI, 
											BC.KD_PROPINSI, 
											BC.KD_DATI2, 
											BC.KD_KELURAHAN, 
											BC.KD_KECAMATAN, 
											BC.KD_BLOK, 
											BC.NO_URUT, 
											BC.KD_JNS_OP, 
											BC.THN_PAJAK_SPPT AS TAHUN, 
											( CASE WHEN BC.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE BC.PBB_TERHUTANG_SPPT END ) AS PIUTANG,
											BC.STATUS_PEMBAYARAN_SPPT, 
											BC.TGL_JATUH_TEMPO_SPPT,  
											BC.TGL_TERBIT_SPPT
										FROM  SPPT BC  LEFT JOIN PBB_MINIMAL C ON 
											BC.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL 
										where 1 = 1 AND
											BC.STATUS_PEMBAYARAN_SPPT = '1' 
											$tahun_sppt1
									) B JOIN (
										select 
											A.KD_PROPINSI_P, 
											A.KD_DATI2_P, 
											A.KD_KELURAHAN_P, 
											A.KD_KECAMATAN_P, 
											A.KD_BLOK_P, 
											A.NO_URUT_P, 
											A.KD_JNS_OP_P, 
											A.THN_PAJAK_SPPT AS TAHUN, 
											SUM(A.DENDA_SPPT) AS DENDA_SPPT,
											SUM(A.JML_SPPT_YG_DIBAYAR - A.DENDA_SPPT) AS JUMLAH_BAYAR,
											MAX(A.TGL_PEMBAYARAN_SPPT) AS  TGL_PEMBAYARAN_SPPT 
										from PEMBAYARAN_SPPT A 
										where 1 = 1   
											$tahun_sppt2
										group by 
											A.KD_PROPINSI_P, 
											A.KD_DATI2_P, 
											A.KD_KELURAHAN_P, 
											A.KD_KECAMATAN_P, 
											A.KD_BLOK_P, 
											A.NO_URUT_P, 
											A.KD_JNS_OP_P, 
											A.THN_PAJAK_SPPT
				
									) Y ON 
										Y.KD_PROPINSI_P = B.KD_PROPINSI AND 
										Y.KD_DATI2_P = B.KD_DATI2 AND 
										Y.KD_KECAMATAN_P = B.KD_KECAMATAN AND 
										Y.KD_KELURAHAN_P = B.KD_KELURAHAN AND 
										Y.KD_BLOK_P = B.KD_BLOK AND 
										Y.NO_URUT_P = B.NO_URUT AND
										Y.KD_JNS_OP_P = B.KD_JNS_OP AND
										Y.TAHUN = B.TAHUN 
									WHERE 1=1 $tahun_sppt3) YX  ) x";
		$sql .= " GROUP BY  $_group TAHUN";
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		  //echo $sql;
		//t_order.tanggal between '$awal' and '$akhir'
	   return new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'TAHUN',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'TAHUN', 'count'
                ),
				'defaultOrder'=>'TAHUN DESC',
            ),
            'pagination'=>$this->is_pagination,
                )
        );
	}
    
	public function attributeLabels()
	{
		return array(
			'tahun' => 'Tahun Ketetapan',
			'group_by' => 'Kumpulkan Berdasarkan',
			'tanggal_terbit_sppt' => 'Tanggal Terbit SPPT'
		);
	}
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
