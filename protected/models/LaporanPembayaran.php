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
class LaporanPembayaran extends CFormModel {

    public $tahun;
    public $kecamatan;
	public $is_pagination = 10;
	public $kelurahan;
	public $tanggal_bayar;
	public $nip_perekam;
	public $tanggal_terbit_sppt;
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
            array('tahun, kecamatan,kelurahan,tanggal_bayar,nip_perekam,tanggal_terbit_sppt', 'safe') 
        );
    }
	public function search(){
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
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
		
		if($this->nip_perekam !="" ){
			$tahun_sppt2 .= " AND A.NIP_REKAM_BYR_SPPT = '".$this->nip_perekam."' ";
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
			if( count($tbayar) > 0 ){
				
				$tanggal_awal =  explode("-",$tterbit[0]); //b t T 
				$tanggal_akhir = explode("-",$tterbit[1]);
				// t   b T
				$tahun_sppt1 .= " AND BC.TGL_TERBIT_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
				AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				//AND A.TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('01/01/2017 00:00:00', 'MM/DD/YYYY HH24:MI:SS') AND TO_DATE('12/31/2017 11:59:00', 'MM/DD/YYYY HH24:MI:SS')  
			}
			//echo $sqls;
		}
		
		$sql = " select 
					KD_PROPINSI||'.'||KD_DATI2||'.'||KD_KECAMATAN||'.'||KD_KELURAHAN||'.'||KD_BLOK||'-'||NO_URUT||'.'||KD_JNS_OP NOP,
					PIUTANG AS KETETAPAN,
					JUMLAH_BAYAR AS PEMBAYARAN_POKOK, 
					(CASE WHEN SELISIH > 0 THEN SELISIH ELSE 0 END ) AS LEBIH_BAYAR,
					(CASE WHEN SELISIH < 0 THEN SELISIH ELSE 0 END ) AS KURANG_BAYAR,
					TAHUN,
					DENDA_SPPT AS PEMBAYARAN_DENDA,
					SELISIH,
					KD_KECAMATAN,
					KD_KELURAHAN,
					SUBJEK_PAJAK_ID AS NOMOR_ID,
					TGL_PEMBAYARAN_SPPT AS TGL_BAYAR
				from (
						select 
							PIUTANG,  
							JUMLAH_BAYAR,
							(JUMLAH_BAYAR - PIUTANG ) AS SELISIH,
							DENDA_SPPT,
							B.KD_PROPINSI, 
							B.KD_DATI2, 
							B.KD_KELURAHAN, 
							B.KD_KECAMATAN, 
							B.KD_BLOK, 
							B.NO_URUT, 
							B.KD_JNS_OP, 
							B.TAHUN,
							B.SUBJEK_PAJAK_ID,
							Y.TGL_PEMBAYARAN_SPPT from (
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
									BC.TGL_TERBIT_SPPT,
									E.SUBJEK_PAJAK_ID 
								FROM  SPPT BC  JOIN DAT_OBJEK_PAJAK E ON
										BC.KD_PROPINSI=E.KD_PROPINSI(+)
										AND BC.KD_DATI2=E.KD_DATI2(+)
										AND BC.KD_KECAMATAN=E.KD_KECAMATAN(+)
										AND BC.KD_KELURAHAN=E.KD_KELURAHAN(+)
										AND BC.KD_BLOK=E.KD_BLOK(+)
										AND BC.NO_URUT=E.NO_URUT(+)
										AND BC.KD_JNS_OP=E.KD_JNS_OP(+) 
									LEFT JOIN PBB_MINIMAL C ON 
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
									MAX(A.TGL_PEMBAYARAN_SPPT) AS TGL_PEMBAYARAN_SPPT
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
							WHERE 1=1 $tahun_sppt3) YX ";
		
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		//t_order.tanggal between '$awal' and '$akhir'
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
    public function search_() {
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		$nip_perekam= $this->nip_perekam;

		
		$sql = "SELECT A.KD_PROPINSI_P||'.'||A.KD_DATI2_P||'.'||A.KD_KECAMATAN_P||'.'||
				A.KD_KELURAHAN_P||'.'||A.KD_BLOK_P||'-'||A.NO_URUT_P||'.'||A.KD_JNS_OP_P NOP,
				D. SUBJEK_PAJAK_ID AS NOMOR_ID,
				B. NM_WP_SPPT AS NAMA_WP, 
				A. KD_KECAMATAN_P AS KD_KECAMATAN,
				B. JLN_WP_SPPT AS ALAMAT_WP,  
				D. JALAN_OP AS ALAMAT_OP,
				B. LUAS_BUMI_SPPT AS LUAS_BUMI,
				B. LUAS_BNG_SPPT AS LUAS_BNG,
				B. KD_KLS_TANAH AS KELAS_TANAH,
				B. KD_KLS_BNG AS KELAS_BNG,
				B. NJOP_BUMI_SPPT AS NJOP_BUMI,
				B. NJOP_BNG_SPPT AS NJOP_BNG,
				B. NJOP_SPPT AS NJOP,
				B. NJOPTKP_SPPT AS NJOPTKP,
				B. PBB_YG_HARUS_DIBAYAR_SPPT KETETAPAN,
				A. THN_PAJAK_SPPT TAHUN,
				A. DENDA_SPPT AS PEMBAYARAN_DENDA, 
				(CASE WHEN A.DENDA_SPPT IS NULL THEN A. JML_SPPT_YG_DIBAYAR ELSE A. JML_SPPT_YG_DIBAYAR - A. DENDA_SPPT  END ) AS PEMBAYARAN_POKOK,
				A. TGL_PEMBAYARAN_SPPT AS TGL_BAYAR
				FROM PEMBAYARAN_SPPT A, SPPT B, DAT_OBJEK_PAJAK D
				WHERE A. KD_PROPINSI_P=B.KD_PROPINSI(+)
				AND A. KD_DATI2_P=B.KD_DATI2(+)
				AND A. KD_KECAMATAN_P=B.KD_KECAMATAN(+)
				AND A. KD_KELURAHAN_P=B.KD_KELURAHAN(+)
				AND A. KD_BLOK_P=B.KD_BLOK(+)
				AND A. NO_URUT_P=B.NO_URUT(+)
				AND A. KD_JNS_OP_P=B.KD_JNS_OP(+)
				AND A. THN_PAJAK_SPPT = B. THN_PAJAK_SPPT(+)
				AND A. KD_PROPINSI_P=D.KD_PROPINSI(+)
				AND A. KD_DATI2_P=D.KD_DATI2(+)
				AND A. KD_KECAMATAN_P=D.KD_KECAMATAN(+)
				AND A. KD_KELURAHAN_P=D.KD_KELURAHAN(+)
				AND A. KD_BLOK_P=D.KD_BLOK(+)
				AND A. NO_URUT_P=D.NO_URUT(+)
				AND A. KD_JNS_OP_P=D.KD_JNS_OP(+)
				";
				
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
						$sql .= " AND A. THN_PAJAK_SPPT in ($tahun)";
					}

				}
			}
			if( (int) $kecamatan > 0 ){
				$sql .= " AND A.KD_KECAMATAN_P = '".$kecamatan."' ";
			}
			if( (int) $this->kelurahan > 0 ){
				$sql .= " AND A.KD_KELURAHAN_P = '".$this->kelurahan."' ";
			}
			
			$tanggal_b = false;
			if( $this->tanggal_bayar != '' ){
				$tbayar = explode(" - ",$this->tanggal_bayar);
				if( count($tbayar) > 0 ){
					$tanggal_b = true;
					$tanggal_awal =  explode("-",$tbayar[0]); //b t T 
					$tanggal_akhir = explode("-",$tbayar[1]);
					// t   b T
					$sql .= " AND A.TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				}
				//echo $sqls;
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
			if($this->nip_perekam !="" ){
				$sql .= " AND A.NIP_REKAM_BYR_SPPT = '".$this->nip_perekam."' ";
			}
			echo $sql;
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		  $sql .= " AND ROWNUM <= $count ";
		//t_order.tanggal between '$awal' and '$akhir'
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
	   //$sql .= "GROUP BY ='".$this->nip_perekam."' ";
    }
	public function search_old() {
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		
		$sql = "SELECT A.KD_PROPINSI||'.'||A.KD_DATI2||'.'||A.KD_KECAMATAN||'.'||
				A.KD_KELURAHAN||'.'||A.KD_BLOK||'-'||A.NO_URUT||'.'||A.KD_JNS_OP NOP,
				D. SUBJEK_PAJAK_ID AS NOMOR_ID,
				B. NM_WP_SPPT AS NAMA_WP, 
				C. NM_KECAMATAN AS KECAMATAN, 
				B. JLN_WP_SPPT AS ALAMAT_WP,  
				D. JALAN_OP AS ALAMAT_OP,
				B. LUAS_BUMI_SPPT AS LUAS_BUMI,
				B. LUAS_BNG_SPPT AS LUAS_BNG,
				B. KD_KLS_TANAH AS KELAS_TANAH,
				B. KD_KLS_BNG AS KELAS_BNG,
				B. NJOP_BUMI_SPPT AS NJOP_BUMI,
				B. NJOP_BNG_SPPT AS NJOP_BNG,
				B. NJOP_SPPT AS NJOP,
				B. NJOPTKP_SPPT AS NJOPTKP,
				B. PBB_YG_HARUS_DIBAYAR_SPPT KETETAPAN,
				A. THN_PAJAK_SPPT TAHUN,
				A. DENDA_SPPT AS PEMBAYARAN_DENDA, 
				A. JML_SPPT_YG_DIBAYAR AS PEMBAYARAN_POKOK,
				A. TGL_PEMBAYARAN_SPPT AS TGL_BAYAR
				FROM PEMBAYARAN_SPPT A, SPPT B, REF_KECAMATAN C, DAT_OBJEK_PAJAK D
				WHERE A. KD_PROPINSI=B.KD_PROPINSI(+)
				AND A. KD_DATI2=B.KD_DATI2(+)
				AND A. KD_KECAMATAN=B.KD_KECAMATAN(+)
				AND A. KD_KELURAHAN=B.KD_KELURAHAN(+)
				AND A. KD_BLOK=B.KD_BLOK(+)
				AND A. NO_URUT=B.NO_URUT(+)
				AND A. KD_JNS_OP=B.KD_JNS_OP(+)
				AND A. THN_PAJAK_SPPT = B. THN_PAJAK_SPPT(+)
				AND A. KD_PROPINSI=D.KD_PROPINSI(+)
				AND A. KD_DATI2=D.KD_DATI2(+)
				AND A. KD_KECAMATAN=D.KD_KECAMATAN(+)
				AND A. KD_KELURAHAN=D.KD_KELURAHAN(+)
				AND A. KD_BLOK=D.KD_BLOK(+)
				AND A. NO_URUT=D.NO_URUT(+)
				AND A. KD_JNS_OP=D.KD_JNS_OP(+)
				AND A. KD_PROPINSI=C.KD_PROPINSI(+)
				AND A. KD_DATI2=C.KD_DATI2(+)
				AND A. KD_KECAMATAN=C.KD_KECAMATAN 
				AND A. THN_PAJAK_SPPT = '$tahun'";
			if( (int) $kecamatan > 0 ){
				$sql .= " AND A.KD_KECAMATAN = '".$kecamatan."' ";
			}
			if( (int) $this->kelurahan > 0 ){
				$sql .= " AND A.KD_KELURAHAN = '".$this->kelurahan."' ";
			}
			$tanggal_b = false;
			if( $this->tanggal_bayar != '' ){
				$tbayar = explode(" - ",$this->tanggal_bayar);
				if( count($tbayar) > 0 ){
					$tanggal_b = true;
					$tanggal_awal =  explode("-",$tbayar[0]); //b t T 
					$tanggal_akhir = explode("-",$tbayar[1]);
					// t   b T
					$sql .= " AND A.TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				}
				//echo $sqls;
			}
			
			if( $tanggal_b == false ){
				$sql .= "
				AND A.TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('01/01/$tahun 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
				AND TO_DATE('12/31/$tahun 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
			}
			//echo $sql;
			//$sql  .= " ORDER BY A.THN_PAJAK_SPPT,A.KD_KECAMATAN,a.kd_propinsi||'.'||a.kd_dati2||'.'||a.kd_kecamatan||'.'||a.kd_kelurahan||'.'||a.kd_blok||'-'||a.no_urut||'.'||a.kd_jns_op";
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		  
		//t_order.tanggal between '$awal' and '$akhir'
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
	public function attributeLabels()
	{
		return array(
			'tanggal_terbit_sppt' => 'Tanggal Terbit SPPT'
		);
	}
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }


}
