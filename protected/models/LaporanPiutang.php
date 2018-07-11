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
class LaporanPiutang extends CFormModel {

    public $tahun;
    public $kecamatan;
	public $kelurahan;
	public $is_pagination = 10;
	public $periode;
	public $group_by;
	public $tanggal_terbit_sppt;
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
            array('tahun, kecamatan,kelurahan,periode,group_by,tanggal_terbit_sppt', 'safe'),
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
								'value' => 'Yii::app()->report->uangFormat($data["PIUTANG"])',
								'header'=>'PIUTANG',				
							)
								
						)
		];
		$array[self::ORDER_KECAMATAN] = [
			'select' => '  B. KD_KECAMATAN,',
			'selectRekap' => 'KD_KECAMATAN,',
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
								'name' => 'PIUTANG',
								'value' => 'Yii::app()->report->uangFormat($data["PIUTANG"])',
								'header'=>'PIUTANG',				
							), 			
								
						)
		];
		$array[self::ORDER_KELURAHAN] = [
			'select' => ' B. KD_KECAMATAN, B.KD_KELURAHAN, ',
			'selectRekap' => 'KD_KECAMATAN, KD_KELURAHAN,',
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
								'value' => 'Yii::app()->report->uangFormat($data["PIUTANG"])',
								'header'=>'PIUTANG',				
							)
								
						)
		];
		
		if( isset( $array[$order][$type]) ){
			return $array[$order][$type];
		}
	}

	private function sqlQuery( $isKetetapan = '1' ){
		
		$ketetapan = " ( CASE WHEN B.PBB_TERHUTANG_SPPT < D.NILAI_PBB_MINIMAL THEN D.NILAI_PBB_MINIMAL ELSE B.PBB_TERHUTANG_SPPT END ) PIUTANG, ";
		
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		$sql = "SELECT 
					B.KD_PROPINSI||'.'||B.KD_DATI2||'.'||B.KD_KECAMATAN||'.'||B.KD_KELURAHAN||'.'||B.KD_BLOK||'-'||B.NO_URUT||'.'||B.KD_JNS_OP NOP,
					C.SUBJEK_PAJAK_ID AS SUBJEK_ID,
					(C.JALAN_OP) AS ALAMAT_OP,
					B.KD_KECAMATAN,
					B.KD_KELURAHAN,
					$ketetapan
					B.THN_PAJAK_SPPT TAHUN,
					B.TGL_TERBIT_SPPT AS TGL_TERBIT,
					B.TGL_JATUH_TEMPO_SPPT AS TGL_JTH_TEMPO
			FROM 
				SPPT B, 
				PEMBAYARAN_SPPT A, 
				DAT_OBJEK_PAJAK C, 
				PBB_MINIMAL D
			WHERE
				B.KD_PROPINSI = A. KD_PROPINSI_P(+)
				AND B.KD_DATI2 = A. KD_DATI2_P(+)
				AND B.KD_KECAMATAN = A. KD_KECAMATAN_P(+)
				AND B.KD_KELURAHAN = A. KD_KELURAHAN_P(+)
				AND B.KD_BLOK = A. KD_BLOK_P(+)
				AND B.NO_URUT = A. NO_URUT_P(+)
				AND B.KD_JNS_OP =A. KD_JNS_OP_P(+)
				AND B.KD_PROPINSI = C. KD_PROPINSI(+)
				AND B.KD_DATI2 = C. KD_DATI2(+)
				AND B.KD_KECAMATAN = C. KD_KECAMATAN(+)
				AND B.KD_KELURAHAN = C. KD_KELURAHAN(+)
				AND B.KD_BLOK = C. KD_BLOK(+)
				AND B.NO_URUT = C. NO_URUT(+)
				AND B.KD_JNS_OP =C. KD_JNS_OP(+)
				AND B.THN_PAJAK_SPPT = A. THN_PAJAK_SPPT(+)
				AND B.THN_PAJAK_SPPT = D.THN_PBB_MINIMAL(+)
				AND B.THN_PAJAK_SPPT = '$tahun' ";
		
		if( (int) $kecamatan > 0 ){
			$sql .= " AND B.KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( (int) $this->kelurahan > 0 ){
			$sql .= " AND B.KD_KELURAHAN = '".$this->kelurahan."' ";
		}
		return $sql;
	}
	private function sqlPiutangdanRealisasiByNOP( $isSisaPiutang = true ){
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		$_select = "";
		
		if( $this->group_by != "" ){
			$_select = self::_order($this->group_by,'select');
		}
		$sql_tgl_BAYAR = "";
		
		if( !empty($this->periode) ){
			$tPeriode = explode(" - ",$this->periode);
			if( count($tPeriode) > 0 ){
				$tanggal_awal =  explode("-",$tPeriode[0]); //b t T 
				$tanggal_akhir = explode("-",$tPeriode[1]);
				if( $isSisaPiutang == true ){
					$sql_tgl_BAYAR = " AND A.TGL_PEMBAYARAN_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
							AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
					
				}else{
					$sql_tgl_BAYAR = " AND A.TGL_PEMBAYARAN_SPPT NOT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
							AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				}
			}
		}
		$piutang = "(PIUTANG - JUMLAH_BAYAR) PIUTANG, ";
		if( $isSisaPiutang == false ){
			$piutang = " PIUTANG , ";
		}	
		
		$sql = "select 
				KD_PROPINSI||'.'||KD_DATI2||'.'||KD_KECAMATAN||'.'||KD_KELURAHAN||'.'||KD_BLOK||'-'||NO_URUT||'.'||KD_JNS_OP NOP,
				SUBJEK_ID,
				(JALAN_OP) AS ALAMAT_OP ,
				KD_KECAMATAN,
				KD_KELURAHAN,
				$piutang
				B.TAHUN,
				TGL_TERBIT_SPPT AS TGL_TERBIT,
				TGL_JATUH_TEMPO_SPPT AS TGL_JTH_TEMPO
				from (
				select  
					BC.NM_WP_SPPT,
					BC.PBB_TERHUTANG_SPPT AS PIUTANGASLI, 
					E.SUBJEK_PAJAK_ID AS SUBJEK_ID,
					E.JALAN_OP,
					BC.KD_PROPINSI, 
					BC.KD_DATI2, 
					BC.KD_KELURAHAN, 
					BC.KD_KECAMATAN, 
					BC.JLN_WP_SPPT,
					BC.KD_BLOK, 
					BC.NO_URUT, 
					BC.KD_JNS_OP, 
					BC.LUAS_BUMI_SPPT,
					BC.LUAS_BNG_SPPT,
					BC.THN_PAJAK_SPPT AS TAHUN, 
					( CASE WHEN BC.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE BC.PBB_TERHUTANG_SPPT END ) AS PIUTANG,
					BC.STATUS_PEMBAYARAN_SPPT, 
					BC.TGL_JATUH_TEMPO_SPPT,  
					BC.TGL_TERBIT_SPPT
					FROM SPPT BC  JOIN DAT_OBJEK_PAJAK E ON
										BC.KD_PROPINSI=E.KD_PROPINSI(+)
										AND BC.KD_DATI2=E.KD_DATI2(+)
										AND BC.KD_KECAMATAN=E.KD_KECAMATAN(+)
										AND BC.KD_KELURAHAN=E.KD_KELURAHAN(+)
										AND BC.KD_BLOK=E.KD_BLOK(+)
										AND BC.NO_URUT=E.NO_URUT(+)
										AND BC.KD_JNS_OP=E.KD_JNS_OP(+) 
									LEFT JOIN PBB_MINIMAL C ON 
									BC.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL 
					where BC.THN_PAJAK_SPPT = '$tahun' AND BC.STATUS_PEMBAYARAN_SPPT = '1' 
			) B left JOIN (
				select A.KD_PROPINSI_P, A.KD_DATI2_P, A.KD_KELURAHAN_P, A.KD_KECAMATAN_P, A.KD_BLOK_P, A.NO_URUT_P, A.KD_JNS_OP_P, 
				A.THN_PAJAK_SPPT AS TAHUN, SUM(A.JML_SPPT_YG_DIBAYAR - A.DENDA_SPPT) AS JUMLAH_BAYAR,
				MAX(A.TGL_PEMBAYARAN_SPPT) AS  TGL_PEMBAYARAN_SPPT from PEMBAYARAN_SPPT A where 1 = 1 $sql_tgl_BAYAR group by 
				A.KD_PROPINSI_P, A.KD_DATI2_P, A.KD_KELURAHAN_P, A.KD_KECAMATAN_P, A.KD_BLOK_P, A.NO_URUT_P, A.KD_JNS_OP_P, A.THN_PAJAK_SPPT
				
			) Y ON 

			Y.KD_PROPINSI_P = B.KD_PROPINSI AND 
			Y.KD_DATI2_P = B.KD_DATI2 AND 
			Y.KD_KECAMATAN_P = B.KD_KECAMATAN AND 
			Y.KD_KELURAHAN_P = B.KD_KELURAHAN AND 
			Y.KD_BLOK_P = B.KD_BLOK AND 
			Y.NO_URUT_P = B.NO_URUT AND
			Y.KD_JNS_OP_P = B.KD_JNS_OP AND
			Y.TAHUN = B.TAHUN WHERE B.TAHUN = '$tahun' ";
		if( (int) $kecamatan > 0 ){
			$sql .= " AND B.KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( (int) $this->kelurahan > 0 ){
			$sql .= " AND B.KD_KELURAHAN = '".$this->kelurahan."' ";
		}
		return $sql;
	}
	
	public function search(){
		
		$sql = $this->sqlQuery('1') ." AND B.STATUS_PEMBAYARAN_SPPT='0' ";
		
		if( !empty($this->periode) ){
			$tPeriode = explode(" - ",$this->periode);
			if( count($tPeriode) > 0 ){
				$tanggal_b = true;
				$tanggal_awal =  explode("-",$tPeriode[0]); //b t T 
				$tanggal_akhir = explode("-",$tPeriode[1]);
				
				$sql .= " AND B.TGL_JATUH_TEMPO_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				
			}
		}
		if( $this->tanggal_terbit_sppt != '' ){
			$tterbit = explode(" - ",$this->tanggal_terbit_sppt);
			if( count($tterbit) > 0 ){
				$tanggal_awal =  explode("-",$tterbit[0]); //b t T 
				$tanggal_akhir = explode("-",$tterbit[1]);
				// t   b T
				$sql .= " AND B.TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
			}
			//echo $sqls;
		}
		//echo $sql;
		if( !empty($this->periode) || !empty($this->tanggal_terbit_sppt) ){
			$sql3_x = $this->sqlPiutangdanRealisasiByNOP(). " AND B.STATUS_PEMBAYARAN_SPPT='1' "; // SISA PIUTANG
			$sql2 = $this->sqlPiutangdanRealisasiByNOP(false). " AND B.STATUS_PEMBAYARAN_SPPT='1' "; // BAYAR JATUH TEMPO
			if( !empty($this->periode) ){
				$tPeriode = explode(" - ",$this->periode);
				if( count($tPeriode) > 0 ){
					$sql2 .= " AND TGL_JATUH_TEMPO_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				
					$sql2 .= " AND TGL_PEMBAYARAN_SPPT NOT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
                    AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
					
					$sql3_x .= " AND TGL_JATUH_TEMPO_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				
					$sql3_x .= " AND TGL_PEMBAYARAN_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
                    AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
					
				}
			}
			
			

			
			if( $this->tanggal_terbit_sppt != '' ){
				$tterbit = explode(" - ",$this->tanggal_terbit_sppt);
				if( count($tterbit) > 0 ){
					$tanggal_awal =  explode("-",$tterbit[0]); //b t T 
					$tanggal_akhir = explode("-",$tterbit[1]);
					// t   b T
					$sql2 .= " AND TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
					
					$sql3_x .= " AND TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				}
				
			}
			
			$sql3 = " select * from ( $sql3_x) C where PIUTANG > 0  ";
			//echo $sql3;
			$sql = $sql. " UNION ".$sql2. " UNION ". $sql3;
			
		}
		//echo $sql;
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
		$sql
			) c")->queryScalar();
	   return new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'NOP',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'NOP', 'count'
                ),
				'defaultOrder'=>'NOP DESC',
            ),
            'pagination'=>$this->is_pagination,
                )
        );
		
	}
    private function sqlQueryRekapitulasi($isKetetapan=true){
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		
		$_select = "";
		
		if( $this->group_by != "" ){
			$_select = self::_order($this->group_by,'select');
		}
		$ketetapan = " SUM( ( CASE WHEN B.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE B.PBB_TERHUTANG_SPPT END ) ) AS PIUTANG,";
		if( $isKetetapan == false ){
			$ketetapan = "SUM(A.JML_SPPT_YG_DIBAYAR - A.DENDA_SPPT ) AS PIUTANG,";
		}
		///$ketetapan = "SUM(A.JML_SPPT_YG_DIBAYAR - A.DENDA_SPPT ) AS PIUTANG,";
		$sql = "SELECT $_select
			SUM(B.PBB_TERHUTANG_SPPT) AS PIUTANGASLI,
			$ketetapan
			
			COUNT(*) as JUM_OBJEK,
			B.THN_PAJAK_SPPT TAHUN
			FROM SPPT B left join PEMBAYARAN_SPPT A
			ON 
			B.KD_PROPINSI = A. KD_PROPINSI_P(+)
			AND B.KD_DATI2 = A. KD_DATI2_P(+)
			AND B.KD_KECAMATAN = A. KD_KECAMATAN_P(+)
			AND B.KD_KELURAHAN = A. KD_KELURAHAN_P(+)
			AND B.KD_BLOK = A. KD_BLOK_P(+)
			AND B.NO_URUT = A. NO_URUT_P(+)
			AND B.KD_JNS_OP =A. KD_JNS_OP_P(+)
			AND B. THN_PAJAK_SPPT = A. THN_PAJAK_SPPT(+)
			LEFT JOIN PBB_MINIMAL C ON B.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL
			WHERE B.THN_PAJAK_SPPT = '$tahun' ";
		
		if( (int) $kecamatan > 0 ){
			$sql .= " AND B.KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( (int) $this->kelurahan > 0 ){
			$sql .= " AND B.KD_KELURAHAN = '".$this->kelurahan."' ";
		}
		return $sql;
	}
	
	private function sqlPiutangdanRealisasi( $isSisaPiutang = true ){
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		$_select = "";
		
		if( $this->group_by != "" ){
			$_select = self::_order($this->group_by,'select');
		}
		$tahun_sppt1 = "";
		$tahun_sppt2 = "";
		$tahun_sppt3 = "";
		
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
		
		if( !empty($this->periode) ){
			$tPeriode = explode(" - ",$this->periode);
			if( count($tPeriode) > 0 ){
				$tanggal_awal =  explode("-",$tPeriode[0]); //b t T 
				$tanggal_akhir = explode("-",$tPeriode[1]);
				if( $isSisaPiutang == true ){
					$tahun_sppt2 = " AND A.TGL_PEMBAYARAN_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
							AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
					
				}else{
					$tahun_sppt2 = " AND A.TGL_PEMBAYARAN_SPPT NOT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
							AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				}
			}
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
		
		$piutang = "(PIUTANG - JUMLAH_BAYAR) PIUTANG, ";
		if( $isSisaPiutang == false ){
			$piutang = " PIUTANG , ";
		}					
		$sql = "select PIUTANGASLI, $piutang JUMLAH_BAYAR,B.TAHUN,  KD_KELURAHAN, KD_KECAMATAN  from (
				select  
					BC.PBB_TERHUTANG_SPPT AS PIUTANGASLI, BC.KD_PROPINSI, BC.KD_DATI2, BC.KD_KELURAHAN, BC.KD_KECAMATAN, BC.KD_BLOK, 
					BC.NO_URUT, BC.KD_JNS_OP, BC.THN_PAJAK_SPPT AS TAHUN, 
					( CASE WHEN BC.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE BC.PBB_TERHUTANG_SPPT END ) AS PIUTANG,
					BC.STATUS_PEMBAYARAN_SPPT, BC.TGL_JATUH_TEMPO_SPPT,  BC.TGL_TERBIT_SPPT
					FROM  SPPT BC  LEFT JOIN PBB_MINIMAL C ON BC.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL where BC.THN_PAJAK_SPPT = '$tahun' $tahun_sppt1
			) B left JOIN (
				select A.KD_PROPINSI_P, A.KD_DATI2_P, A.KD_KELURAHAN_P,  A.KD_KECAMATAN_P, A.KD_BLOK_P, A.NO_URUT_P, A.KD_JNS_OP_P, 
				A.THN_PAJAK_SPPT AS TAHUN, SUM(A.JML_SPPT_YG_DIBAYAR - A.DENDA_SPPT) AS JUMLAH_BAYAR,
				MAX(A.TGL_PEMBAYARAN_SPPT) AS  TGL_PEMBAYARAN_SPPT from PEMBAYARAN_SPPT A where 1 = 1 AND A.THN_PAJAK_SPPT = '$tahun' $tahun_sppt2 group by 
				A.KD_PROPINSI_P, A.KD_DATI2_P, A.KD_KELURAHAN_P, A.KD_KECAMATAN_P, A.KD_BLOK_P, A.NO_URUT_P, A.KD_JNS_OP_P, A.THN_PAJAK_SPPT
				
			) Y ON 

			Y.KD_PROPINSI_P = B.KD_PROPINSI AND 
			Y.KD_DATI2_P = B.KD_DATI2 AND 
			Y.KD_KECAMATAN_P = B.KD_KECAMATAN AND 
			Y.KD_KELURAHAN_P = B.KD_KELURAHAN AND 
			Y.KD_BLOK_P = B.KD_BLOK AND 
			Y.NO_URUT_P = B.NO_URUT AND
			Y.KD_JNS_OP_P = B.KD_JNS_OP AND
			Y.TAHUN = B.TAHUN WHERE B.TAHUN = '$tahun' $tahun_sppt3 ";
		
		return $sql;
	}
	
	public function searchRekapitulasi() {
		
		$_group = "";
		$_select = "";
		if( $this->group_by != "" ){
			$_group = self::_order($this->group_by,'group');
			$_select = self::_order($this->group_by,'selectRekap');
		}
		$sql = $this->sqlQueryRekapitulasi(true) ." AND B.STATUS_PEMBAYARAN_SPPT='0' ";
		if( !empty($this->periode) ){
			$tPeriode = explode(" - ",$this->periode);
			if( count($tPeriode) > 0 ){
				$tanggal_b = true;
				$tanggal_awal =  explode("-",$tPeriode[0]); //b t T 
				$tanggal_akhir = explode("-",$tPeriode[1]);
				
				$sql .= " AND B.TGL_JATUH_TEMPO_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				
			}
		}
		if( $this->tanggal_terbit_sppt != '' ){
			$tterbit = explode(" - ",$this->tanggal_terbit_sppt);
			if( count($tterbit) > 0 ){
				$tanggal_awal =  explode("-",$tterbit[0]); //b t T 
				$tanggal_akhir = explode("-",$tterbit[1]);
				// t   b T
				$sql .= " AND B.TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
			}
			//echo $sqls;
		}
		$sql .= " GROUP BY $_group B.THN_PAJAK_SPPT";
		
		if( !empty($this->periode) || !empty($this->tanggal_terbit_sppt) ){
			
			$sql3_X1 = $this->sqlPiutangdanRealisasi(). " AND B.STATUS_PEMBAYARAN_SPPT='1' ";
			$sql2_X = $this->sqlPiutangdanRealisasi(false). " AND B.STATUS_PEMBAYARAN_SPPT='1' ";
			if( !empty($this->periode) ){
				$tPeriode = explode(" - ",$this->periode);
				if( count($tPeriode) > 0 ){
					$tanggal_b = true;
					$tanggal_awal =  explode("-",$tPeriode[0]); //b t T 
					$tanggal_akhir = explode("-",$tPeriode[1]);
					
					$sql2_X .= " AND TGL_JATUH_TEMPO_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
						AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
						
					$sql3_X1 .= " AND TGL_JATUH_TEMPO_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
						AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
						
					$sql2_X .= " AND TGL_PEMBAYARAN_SPPT NOT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
							AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
					
					$sql3_X1 .= " AND TGL_PEMBAYARAN_SPPT  BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
							AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				}
			
			}
			
			if( $this->tanggal_terbit_sppt != '' ){
				$tterbit = explode(" - ",$this->tanggal_terbit_sppt);
				if( count($tterbit) > 0 ){
					$tanggal_awal =  explode("-",$tterbit[0]); //b t T 
					$tanggal_akhir = explode("-",$tterbit[1]);
					
					$sql2_X .= " AND TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
					
					
					$sql3_X1 .= " AND TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
					
				}
				//echo $sqls;
			}
			
			
			$sql3_X1SQL = "select $_select  SUM(PIUTANGASLI) AS PIUTANGASLI, SUM(PIUTANG) AS PIUTANG, COUNT(*) as JUM_OBJEK, TAHUN  from ($sql3_X1) B where PIUTANG > 0 ";
			$sql3_X1SQL .= " GROUP BY $_group TAHUN ";
			
			$sql2_X = "select $_select  SUM(PIUTANGASLI) AS PIUTANGASLI, SUM(PIUTANG) AS PIUTANG, COUNT(*) as JUM_OBJEK, TAHUN  from ($sql2_X) B  ";
			$sql2_X .= " GROUP BY $_group TAHUN ";
			
			//echo $sql2_X;
			
			$sql = $sql. " UNION ALL ".$sql2_X ." UNION ALL ".$sql3_X1SQL;
			//$sql = $sql;
		}
		//echo $sql;
		$sql = "select $_select
			SUM(B.PIUTANG) AS PIUTANG,
			SUM(B.JUM_OBJEK) as JUM_OBJEK,
			TAHUN from ($sql) B where 1 = 1 GROUP BY $_group TAHUN ";
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
		$sql
			) c")->queryScalar();
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
	
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
	public function attributeLabels()
	{
		return array(
			'periode' => 'Periode',
			'tanggal_terbit_sppt' => 'Tanggal Terbit SPPT'
		);
	}
}
