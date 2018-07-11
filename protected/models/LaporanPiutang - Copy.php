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
            array('tahun, kecamatan,kelurahan,periode,group_by', 'safe'),
        );
    }
	
    public function search() {
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		
		$sql = "SELECT B.KD_PROPINSI||'.'||B.KD_DATI2||'.'||B.KD_KECAMATAN||'.'||
			B.KD_KELURAHAN||'.'||B.KD_BLOK||'-'||B.NO_URUT||'.'||B.KD_JNS_OP NOP,
			E.SUBJEK_PAJAK_ID AS SUBJEK_ID,
			B.NM_WP_SPPT AS NAMA_WP, 
			B.KD_KECAMATAN,
			B.KD_KELURAHAN,
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
			B.PBB_TERHUTANG_SPPT AS PIUTANG,
			B.THN_PAJAK_SPPT TAHUN,
			B.TGL_TERBIT_SPPT AS TGL_TERBIT,
			B.TGL_JATUH_TEMPO_SPPT AS TGL_JTH_TEMPO
			FROM SPPT B,DAT_OBJEK_PAJAK E
			WHERE  B.KD_PROPINSI=E.KD_PROPINSI(+)
			AND B.KD_DATI2=E.KD_DATI2(+)
			AND B.KD_KECAMATAN=E.KD_KECAMATAN(+)
			AND B.KD_KELURAHAN=E.KD_KELURAHAN(+)
			AND B.KD_BLOK=E.KD_BLOK(+)
			AND B.NO_URUT=E.NO_URUT(+)
			AND B.KD_JNS_OP=E.KD_JNS_OP(+)
			AND B.THN_PAJAK_SPPT = '$tahun'
			AND B.STATUS_PEMBAYARAN_SPPT='0'";
		if( (int) $kecamatan > 0 ){
			$sql .= " AND B.KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( (int) $this->kelurahan > 0 ){
			$sql .= " AND B.KD_KELURAHAN = '".$this->kelurahan."' ";
		}
		if( $this->periode != '' ){
			
		}
		$sql2 = "SELECT A.KD_PROPINSI_P||'.'||A.KD_DATI2_P||'.'||A.KD_KECAMATAN_P||'.'||
				A.KD_KELURAHAN_P||'.'||A.KD_BLOK_P||'-'||A.NO_URUT_P||'.'||A.KD_JNS_OP_P NOP,
				D. SUBJEK_PAJAK_ID AS NOMOR_ID,
				B. NM_WP_SPPT AS NAMA_WP, 
				A.KD_KECAMATAN_P AS KD_KECAMATAN,
				A.KD_KELURAHAN_P AS KD_KELURAHAN,
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
				B. PBB_TERHUTANG_SPPT PIUTANG,
				A. THN_PAJAK_SPPT TAHUN,
				B.TGL_TERBIT_SPPT AS TGL_TERBIT,
				B.TGL_JATUH_TEMPO_SPPT AS TGL_JTH_TEMPO
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
				AND B.STATUS_PEMBAYARAN_SPPT = '1'
				AND A. THN_PAJAK_SPPT = '$tahun'";
		
		if( $this->periode != '' ){
			if( (int) $kecamatan > 0 ){
				$sql2 .= " AND A.KD_KECAMATAN = '".$kecamatan."' ";
			}
			if( (int) $this->kelurahan > 0 ){
				$sql2 .= " AND A.KD_KELURAHAN = '".$this->kelurahan."' ";
			}
			$tbayar = explode(" - ",$this->periode);
			if( count($tbayar) > 0 ){
				$tanggal_b = true;
				$tanggal_awal =  explode("-",$tbayar[0]); //b t T 
				$tanggal_akhir = explode("-",$tbayar[1]);
				// t   b T
				$sql2 .= " AND A.TGL_PEMBAYARAN_SPPT NOT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				
				$sql = $sql." UNION ".$sql2;
				//$sql = $sql2;
				//echo $sql2;
			}
			//echo $sql;
		}
		$model = new LaporanPiutang;
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) c")->queryScalar();
		$sql .= " AND ROWNUM <= $count ";
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
	public function searchRekapitulasi() {
		$tahun = $this->tahun;
		$kecamatan = $this->kecamatan;
		
		$sql = "SELECT 
			B.KD_KECAMATAN,
			B.KD_KELURAHAN,
			B.PBB_TERHUTANG_SPPT AS PIUTANG,
			B.THN_PAJAK_SPPT TAHUN
			
			FROM SPPT B,DAT_OBJEK_PAJAK E
			WHERE  B.KD_PROPINSI=E.KD_PROPINSI(+)
			AND B.KD_DATI2=E.KD_DATI2(+)
			AND B.KD_KECAMATAN=E.KD_KECAMATAN(+)
			AND B.KD_KELURAHAN=E.KD_KELURAHAN(+)
			AND B.KD_BLOK=E.KD_BLOK(+)
			AND B.NO_URUT=E.NO_URUT(+)
			AND B.KD_JNS_OP=E.KD_JNS_OP(+)
			AND B.THN_PAJAK_SPPT = '$tahun'
			AND B.STATUS_PEMBAYARAN_SPPT='0'";
		if( (int) $kecamatan > 0 ){
			$sql .= " AND B.KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( (int) $this->kelurahan > 0 ){
			$sql .= " AND B.KD_KELURAHAN = '".$this->kelurahan."' ";
		}
		
		$sql2 = "SELECT 
				A.KD_KECAMATAN_P AS KD_KECAMATAN,
				A.KD_KELURAHAN_P AS KD_KELURAHAN,
				
				B. PBB_TERHUTANG_SPPT PIUTANG,
				A. THN_PAJAK_SPPT TAHUN
				
				FROM PEMBAYARAN_SPPT A, SPPT B
				WHERE A. KD_PROPINSI_P=B.KD_PROPINSI(+)
				AND A. KD_DATI2_P=B.KD_DATI2(+)
				AND A. KD_KECAMATAN_P=B.KD_KECAMATAN(+)
				AND A. KD_KELURAHAN_P=B.KD_KELURAHAN(+)
				AND A. KD_BLOK_P=B.KD_BLOK(+)
				AND A. NO_URUT_P=B.NO_URUT(+)
				AND A. KD_JNS_OP_P=B.KD_JNS_OP(+)
				AND A. THN_PAJAK_SPPT = B. THN_PAJAK_SPPT(+)
				AND B.STATUS_PEMBAYARAN_SPPT = '1'
				AND A. THN_PAJAK_SPPT = '$tahun'";
		
		if( $this->periode != '' ){
			if( (int) $kecamatan > 0 ){
				$sql2 .= " AND A.KD_KECAMATAN = '".$kecamatan."' ";
			}
			if( (int) $this->kelurahan > 0 ){
				$sql2 .= " AND A.KD_KELURAHAN = '".$this->kelurahan."' ";
			}
			$tbayar = explode(" - ",$this->periode);
			if( count($tbayar) > 0 ){
				$tanggal_b = true;
				$tanggal_awal =  explode("-",$tbayar[0]); //b t T 
				$tanggal_akhir = explode("-",$tbayar[1]);
				// t   b T
				$sql2 .= " AND A.TGL_PEMBAYARAN_SPPT NOT BETWEEN TO_DATE('$tanggal_awal[0]/$tanggal_awal[1]/$tanggal_awal[2] 00:00:00', 'MM/DD/YYYY HH24:MI:SS') 
					AND TO_DATE('$tanggal_akhir[0]/$tanggal_akhir[1]/$tanggal_akhir[2] 11:59:00', 'MM/DD/YYYY HH24:MI:SS')";
				
				$sql = $sql." UNION ".$sql2;
				//$sql = $sql2;
				//echo $sql2;
			}
			//echo $sql;
		}
		$sql = "select KD_KECAMATAN,KD_KELURAHAN, SUM(PIUTANG) AS PIUTANG, TAHUN from ($sql) c GROUP BY C.TAHUN, C.KD_KECAMATAN, C.KD_KELURAHAN";
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
		);
	}
}
