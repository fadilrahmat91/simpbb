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
class LaporanPembayaranNik extends CFormModel {

    public $tahun;
    public $kecamatan;
	public $is_pagination = 10;
	public $kelurahan;
	public $tanggal_bayar;
	public $nip_perekam;
	const PENANGGUNG_JAWAB = "EDDY ERWANTO, SE";
	const NIP_PENAGGUNG_JAWAB = "197612192011011006";
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
            array('tahun, kecamatan,kelurahan,tanggal_bayar,nip_perekam', 'safe'),
        );
    }
    public function search() {
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		
		$sql = "SELECT A.KD_PROPINSI_P||'.'||A.KD_DATI2_P||'.'||A.KD_KECAMATAN_P||'.'||
				A.KD_KELURAHAN_P||'.'||A.KD_BLOK_P||'-'||A.NO_URUT_P||'.'||A.KD_JNS_OP_P NOP,
				D. SUBJEK_PAJAK_ID AS NOMOR_ID,
				B. NM_WP_SPPT AS NAMA_WP, 
				A.KD_KECAMATAN_P AS KD_KECAMATAN,
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
				AND A.NIP_REKAM_BYR_SPPT = '".$this->nip_perekam."'";
			if( (int) $kecamatan > 0 ){
				$sql .= " AND A.KD_KECAMATAN_P = '".$kecamatan."' ";
			}
			if( (int) $this->kelurahan > 0 ){
				$sql .= " AND A.KD_KELURAHAN_P = '".$this->kelurahan."' ";
			}
			$tanggal_b = false;
			/*if( $this->tanggal_bayar != '' ){
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
			}*/
			if( $this->tanggal_bayar != '' ){
				
					$tanggal_awal =  explode("-",$this->tanggal_bayar); //b t T 
					
					// t   b T
					$sql .= " AND A.TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				
				//echo $sqls;
			}
			if( $tanggal_b == false ){
				//$sql .= " AND to_char(A.TGL_PEMBAYARAN_SPPT, 'YYYY')   = B. THN_PAJAK_SPPT ";
			}
			
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
                    'TGL_BAYAR', 'count'
                ),
				'defaultOrder'=>'NOP ASC',
            ),
            'pagination'=>$this->is_pagination,
                )
        );
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

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
