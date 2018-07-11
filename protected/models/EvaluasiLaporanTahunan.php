<?php
	class EvaluasiLaporanTahunan extends CFormModel {

	    public $tahun;
		public $is_pagination = 10;
		public $kecamatan;
		public $kelurahan;
		public $group_by;
		const ORDER_TAHUN = 0;
		const ORDER_KECAMATAN = 1;
		const ORDER_KELURAHAN = 2;
		
	    public function rules() {
	        // NOTE: you should only define rules for those attributes that
	        // will receive user inputs.
	        return array(
	            array('tahun, kecamatan, kelurahan, group_by', 'safe'),
	        );
	    }

	    public function _order($order, $type ){
			$array[self::ORDER_TAHUN] = [
				'rGrid' => array(
					array(
			          'name'=>'TAHUN',
			          'header'=>'TAHUN',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_KETETAPAN',
			          'header'=>'JUMLAH OBJEK KETETAPAN',
			        ),
			        array(
			          'name'=>'KETETAPAN',
			          'header'=>'KETETAPAN',
			          'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_PIUTANG',
			          'header'=>'JUMLAH OBJEK PIUTANG',
			        ),
			        array(
			          'name'=>'PIUTANG',
			          'header'=>'PIUTANG',
			          'value' => 'Yii::app()->report->uangFormat($data["PIUTANG"])',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_REALISASI',
			          'header'=>'JUMLAH OBJEK REALISASI',
			        ),
			        array(
			          'name'=>'REALISASI',
			          'header'=>'REALISASI',
			          'value' => 'Yii::app()->report->uangFormat($data["REALISASI"])',
			        ),
			        array(
			          'name'=>'SELISIH',
			          'header'=>'SELISIH',
			          'value' => 'Yii::app()->report->uangFormat($data["SELISIH"])',
			        ),		
				)
			];
			$array[self::ORDER_KECAMATAN] = [
				'select' => '  KD_KECAMATAN,',
				'group' => ' KD_KECAMATAN, ',
				'rGrid' => array(
					array(
			          'name'=>'TAHUN',
			          'header'=>'TAHUN',
			        ),
			        array(
			          'name'=>'KD_KECAMATAN',
			          'header'=>'KECAMATAN',
			          'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_KETETAPAN',
			          'header'=>'JUMLAH OBJEK KETETAPAN',
			        ),
			        array(
			          'name'=>'KETETAPAN',
			          'header'=>'KETETAPAN',
			          'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_PIUTANG',
			          'header'=>'JUMLAH OBJEK PIUTANG',
			        ),
			        array(
			          'name'=>'PIUTANG',
			          'header'=>'PIUTANG',
			          'value' => 'Yii::app()->report->uangFormat($data["PIUTANG"])',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_REALISASI',
			          'header'=>'JUMLAH OBJEK REALISASI',
			        ),
			        array(
			          'name'=>'REALISASI',
			          'header'=>'REALISASI',
			          'value' => 'Yii::app()->report->uangFormat($data["REALISASI"])',
			        ),
			        array(
			          'name'=>'SELISIH',
			          'header'=>'SELISIH',
			          'value' => 'Yii::app()->report->uangFormat($data["SELISIH"])',
			        ),
				)
			];
			$array[self::ORDER_KELURAHAN] = [
				'select' => ' KD_KECAMATAN, KD_KELURAHAN, ',
				'group' => ' KD_KECAMATAN, KD_KELURAHAN, ',
				'rGrid' => array(
					array(
			          'name'=>'TAHUN',
			          'header'=>'TAHUN',
			        ),
			        array(
			          'name'=>'KD_KECAMATAN',
			          'header'=>'KECAMATAN',
			          'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
			        ),
			        array(
			          'name'=>'KD_KELURAHAN',
			          'header'=>'KELURAHAN',
			          'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_KETETAPAN',
			          'header'=>'JUMLAH OBJEK KETETAPAN',
			        ),
			        array(
			          'name'=>'KETETAPAN',
			          'header'=>'KETETAPAN',
			          'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_PIUTANG',
			          'header'=>'JUMLAH OBJEK PIUTANG',
			        ),
			        array(
			          'name'=>'PIUTANG',
			          'header'=>'PIUTANG',
			          'value' => 'Yii::app()->report->uangFormat($data["PIUTANG"])',
			        ),
			        array(
			          'name'=>'JUM_OBJEK_REALISASI',
			          'header'=>'JUMLAH OBJEK REALISASI',
			        ),
			        array(
			          'name'=>'REALISASI',
			          'header'=>'REALISASI',
			          'value' => 'Yii::app()->report->uangFormat($data["REALISASI"])',
			        ),
			        array(
			          'name'=>'SELISIH',
			          'header'=>'SELISIH',
			          'value' => 'Yii::app()->report->uangFormat($data["SELISIH"])',
			        ),
				)
			];
			
			if( isset( $array[$order][$type]) ){
				return $array[$order][$type];
			}
		}
		public function searchRekapitulasi() {
			$tahun = $this->tahun;
			$kecamatan = $this->kecamatan;
			$kelurahan = $this->kelurahan;
			$_select = "";
			$_group = "";
			
			if( $this->group_by != "" ){
				$_select = self::_order($this->group_by,'select');
				$_group = self::_order($this->group_by,'group');
			}

			$tahun_sppt1 = "";
			$tahun_sppt2 = "";

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
						$tahun_sppt1 = " AND A.THN_PAJAK_SPPT in ($tahun) AND to_char(A.TGl_TERBIT_SPPT,'YYYY') in ($tahun)  ";
						$tahun_sppt2 = " AND A.THN_PAJAK_SPPT in ($tahun)   ";
					}
				}
			}

			if( (int) $kecamatan > 0 ){
				$tahun_sppt1 .= " AND A.KD_KECAMATAN = '".$kecamatan."' ";
				$tahun_sppt2 .= " AND A.KD_KECAMATAN_P = '".$kecamatan."'   ";
			}
			if( (int) $this->kelurahan > 0 ){
				$tahun_sppt1 .= " AND A.KD_KELURAHAN = '".$kelurahan."' ";
				$tahun_sppt2 .= " AND A.KD_KELURAHAN_P = '".$kelurahan."'  ";
			}
			$sql = "SELECT $_select
						TAHUN,
						SUM(JUM_OBJEK_KETETAPAN) AS JUM_OBJEK_KETETAPAN,
						SUM(KETETAPAN) AS KETETAPAN,
						SUM(DENDA_SPPT) AS DENDA_SPPT,
						SUM(JUMLAH_BAYAR) AS JUMLAH_BAYAR,
						SUM( CASE WHEN STATUS = '0' THEN 1 ELSE 0  END) AS JUM_OBJEK_PIUTANG,
						SUM( CASE WHEN STATUS = '0' THEN KETETAPAN ELSE 0  END) AS PIUTANG,
						SUM( CASE WHEN STATUS = '1' THEN 1 ELSE 0  END) AS JUM_OBJEK_REALISASI,
						SUM( CASE WHEN STATUS = '1' THEN JUMLAH_BAYAR ELSE 0  END) AS REALISASI,
						( SUM(KETETAPAN) - SUM( CASE WHEN STATUS = '1' THEN JUMLAH_BAYAR ELSE 0  END) - SUM( CASE WHEN STATUS = '0' THEN KETETAPAN ELSE 0  END) ) AS SELISIH
					 FROM (
						 SELECT 
							BKetetapan.KD_PROPINSI,
							BKetetapan.KD_DATI2,
							BKetetapan.KD_KECAMATAN,
							BKetetapan.KD_KELURAHAN,
							BKetetapan.KD_BLOK,
							BKetetapan.NO_URUT,
							BKetetapan.KD_JNS_OP,
							BKetetapan.TAHUN,
							BKetetapan.KETETAPAN,
							BKetetapan.JUM_OBJEK_KETETAPAN,
							DECODE(BKetetapan.STATUS_PEMBAYARAN_SPPT,'0','BELUM BAYAR','1','BAYAR') STATUS_BAYAR,
							BPembayaran.DENDA_SPPT,
							BPembayaran.JUMLAH_BAYAR,
							BPembayaran.BERAPAKALIBAYAR,
							( CASE WHEN BKetetapan.STATUS_PEMBAYARAN_SPPT = '0' THEN '0' WHEN BPembayaran.STATUS_PEMBAYARAN = '0' THEN '0' ELSE '1' END ) AS STATUS
						 FROM (
							SELECT 
								A.KD_PROPINSI,
								A.KD_DATI2,
								A.KD_KECAMATAN,
								A.KD_KELURAHAN,
								A.KD_BLOK,
								A.KD_JNS_OP,
								A.NO_URUT,
								A.THN_PAJAK_SPPT AS TAHUN,
								1 AS JUM_OBJEK_KETETAPAN,
								( CASE WHEN A.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE A.PBB_TERHUTANG_SPPT END ) AS KETETAPAN,
								A.STATUS_PEMBAYARAN_SPPT
							FROM 
								SPPT A, PBB_MINIMAL C where A.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL $tahun_sppt1
							) BKetetapan left join (
								SELECT 
									XC.KD_PROPINSI_P,
									XC.KD_DATI2_P,
									XC.KD_KECAMATAN_P,
									XC.KD_KELURAHAN_P,
									XC.KD_BLOK_P,
									XC.NO_URUT_P,
									XC.KD_JNS_OP_P,
									XC.TAHUN,
									COUNT(*) AS BERAPAKALIBAYAR,
									SUM(DENDA_SPPT) AS DENDA_SPPT,
									SUM(JUMLAH_BAYAR) AS JUMLAH_BAYAR,
									STATUS_PEMBAYARAN
									FROM (
										SELECT 
											A.KD_PROPINSI_P,
											A.KD_DATI2_P,
											A.KD_KECAMATAN_P,
											A.KD_KELURAHAN_P,
											A.KD_BLOK_P,
											A.NO_URUT_P,
											A.KD_JNS_OP_P,
											A.THN_PAJAK_SPPT AS TAHUN,
											A.DENDA_SPPT AS DENDA_SPPT,
											(A.JML_SPPT_YG_DIBAYAR - A.DENDA_SPPT) AS JUMLAH_BAYAR,
											( CASE WHEN to_char(A.TGl_PEMBAYARAN_SPPT,'YYYY') != A.THN_PAJAK_SPPT THEN '0' ELSE '1' END ) AS STATUS_PEMBAYARAN
										FROM PEMBAYARAN_SPPT  A where 1 = 1 $tahun_sppt2
									) XC
									group by 
									XC.KD_PROPINSI_P,
									XC.KD_DATI2_P,
									XC.KD_KECAMATAN_P,
									XC.KD_KELURAHAN_P,
									XC.KD_BLOK_P,
									XC.NO_URUT_P,
									XC.KD_JNS_OP_P,
									XC.TAHUN,
									XC.STATUS_PEMBAYARAN
							) BPembayaran ON 
								BKetetapan.KD_PROPINSI = BPembayaran.KD_PROPINSI_P AND 
								BKetetapan.KD_DATI2 = BPembayaran.KD_DATI2_P AND 
								BKetetapan.KD_KECAMATAN = BPembayaran.KD_KECAMATAN_P AND 
								BKetetapan.KD_KELURAHAN = BPembayaran.KD_KELURAHAN_P AND 
								BKetetapan.KD_BLOK = BPembayaran.KD_BLOK_P AND 
								BKetetapan.NO_URUT = BPembayaran.NO_URUT_P AND
								BKetetapan.KD_JNS_OP = BPembayaran.KD_JNS_OP_P AND
								BKetetapan.TAHUN = BPembayaran.TAHUN 
					) YX
					";
					$sql .= " GROUP BY  $_group TAHUN ORDER BY TAHUN DESC";
			$count = Yii::app()->dbOracle->createCommand("select count(*) from (
				$sql
				) a")->queryScalar();
			return new CSqlDataProvider($sql, array(
				'db' => Yii::app()->dbOracle,
	            'keyField' => 'TAHUN',
	            'totalItemCount' => $count,
	            'sort' => array(
	                'attributes' => array(
	                    'TAHUN', 'count'
	                ),
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
				'tahun' => 'Tahun',
				'kecamatan' => 'Kecamatan',
				'kelurahan' => 'Kelurahan'
			);
		}
		

	}
