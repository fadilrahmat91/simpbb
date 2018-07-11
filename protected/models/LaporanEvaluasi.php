<?php
class LaporanEvaluasi extends CFormModel {
	public $jurusan;
 	public $tahun;
    public $kecamatan;
	public $kelurahan;
	public $is_pagination = 10;

	public $selisih;
	public $tanggal_terbit;
	public $tanggal_jatuh_tempo;
	public $sortby = "NOP DESC";
	public $limit_date;
	public $group_by;
	public $nop;
	
	const ORDER_TAHUN = 0;
	
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tahun,jurusan, kecamatan,selisih,kelurahan,nop', 'safe'),
        );
    }
    public function SiswabyJurusan()
	{
         $jurusan= $this->jurusan;
		$sql = "SELECT * FROM mahasiswa WHERE jurusan='$jurusan'";
		$command= Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();

	}
	
   
	public function searchRekapitulasi(){
		$_select = "";
		$_group = "";
		
		$tahun = $this->tahun;
		$nop = $this->nop;
		$where1 = "";
		$where2 = "";
		$nopnya= "";
	
		if($nop !=""){
			$nop = str_replace("-",".",$nop);
				list($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$no_urut,$kd_jenis) = explode(".",$nop); 
				$nopnya="AND A.KD_PROPINSI = '".$kd_propinsi."' 
						AND A.KD_DATI2 = '".$kd_dati2."'
						AND A.KD_KECAMATAN = '".$kd_kecamatan."'
						AND A.KD_KELURAHAN = '".$kd_kelurahan."'
						AND A.KD_BLOK = '".$kd_blok."'
						AND A.NO_URUT = '".$no_urut."'
						AND A.KD_JNS_OP = '".$kd_jenis."' ";
	

		}
		
		if($tahun != "" ){
			$where1 .= " 
						 AND A.THN_PAJAK_SPPT = '".$tahun."'
						 AND to_char(A.TGl_TERBIT_SPPT,'YYYY') = '".$tahun."'";
			$where2 .= " AND A.THN_PAJAK_SPPT = '".$tahun."' ";
			//$where3 .= " AND A.THN_PAJAK_SPPT = '".$tahun."' AND to_char(A.TGl_TERBIT_SPPT,'YYYY') = '".$tahun."' ";
			
		}
		$kecamatan = $this->kecamatan;
		$kelurahan = $this->kelurahan;
		$selisih = $this->selisih;


		$sql = "  
		select * from ( SELECT KD_PROPINSI||'.'||KD_DATI2||'.'||KD_KECAMATAN||'.'||
				KD_KELURAHAN||'.'||KD_BLOK||'-'||NO_URUT||'.'||KD_JNS_OP NOP,
				KD_PROPINSI,
				KD_DATI2,
				KD_KECAMATAN,
				KD_KELURAHAN,
				KD_BLOK,
				NO_URUT,
				KD_JNS_OP,
				TAHUN,
				STATUS_BAYAR,
				(KETETAPAN) AS KETETAPAN,
				(DENDA_SPPT) AS DENDA_SPPT,
				( CASE WHEN STATUS = '0' THEN KETETAPAN ELSE 0  END) AS PIUTANG,
				( CASE WHEN STATUS = '1' THEN JUMLAH_BAYAR ELSE 0  END) AS REALISASI,
				(KETETAPAN-CASE WHEN STATUS = '1' THEN JUMLAH_BAYAR ELSE 0  END-CASE WHEN STATUS = '0' THEN KETETAPAN ELSE 0  END) AS SELISIH,
				TGL_TERBIT,
				TGL_JATUH_TEMPO
			 from (
				 select 
					BK.KD_PROPINSI,
					BK.KD_DATI2,
					BK.KD_KECAMATAN,
					BK.KD_KELURAHAN,
					BK.KD_BLOK,
					BK.NO_URUT,
					BK.KD_JNS_OP,
					BK.TAHUN,
					BK.KETETAPAN,
					BK.TGL_TERBIT,
					BK.TGL_JATUH_TEMPO,
					DECODE(BK.STATUS_PEMBAYARAN_SPPT,'0','BELUM BAYAR','1','BAYAR') STATUS_BAYAR,
					BP.DENDA_SPPT,
					BP.JUMLAH_BAYAR,
					BP.BERAPAKALIBAYAR,
					( CASE WHEN BK.STATUS_PEMBAYARAN_SPPT = '0' THEN '0' WHEN BP.STATUS_PEMBAYARAN = '0' THEN '0' ELSE '1' END ) AS STATUS
				 from (
					select 
						A.KD_PROPINSI,
						A.KD_DATI2,
						A.KD_KECAMATAN,
						A.KD_KELURAHAN,
						A.KD_BLOK,
						A.KD_JNS_OP,
						A.NO_URUT,
						A.THN_PAJAK_SPPT AS TAHUN,
						A.TGl_TERBIT_SPPT AS TGL_TERBIT,
						A.TGL_JATUH_TEMPO_SPPT AS TGL_JATUH_TEMPO,
						( CASE WHEN A.PBB_TERHUTANG_SPPT < C.NILAI_PBB_MINIMAL THEN C.NILAI_PBB_MINIMAL ELSE A.PBB_TERHUTANG_SPPT END ) AS KETETAPAN,
						A.STATUS_PEMBAYARAN_SPPT
					from 
						SPPT A, PBB_MINIMAL C where 1=1 AND A.THN_PAJAK_SPPT = C.THN_PBB_MINIMAL $where1 $nopnya
					) BK left join (
						select 
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
							from (
								select 
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
								from PEMBAYARAN_SPPT  A where 1=1 $where2 $nopnya
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
					) BP ON 
						BK.KD_PROPINSI = BP.KD_PROPINSI_P AND 
						BK.KD_DATI2 = BP.KD_DATI2_P AND 
						BK.KD_KECAMATAN = BP.KD_KECAMATAN_P AND 
						BK.KD_KELURAHAN = BP.KD_KELURAHAN_P AND 
						BK.KD_BLOK = BP.KD_BLOK_P AND 
						BK.NO_URUT = BP.NO_URUT_P AND
						BK.KD_JNS_OP = BP.KD_JNS_OP_P AND
						BK.TAHUN = BP.TAHUN 
			) YX ) YZ where 1=1";

		
		
			if( $selisih != "" ){
				
				if( $selisih == '1'){
					$sql .= " AND SELISIH > 0 ";
				}else if( $selisih == '0'){
					$sql .= " AND SELISIH < 0 ";
				}
			}
		// 	if(isset($this->tahun >= Yii::app()->report->tahun_mulai() ){
		// 	$sql .= " AND B.THN_PAJAK_SPPT = '".$tahun."' ";
		// }
			
			
		
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		//$sql .= " AND ROWNUM <= $count ";
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

    public function status($hasil)
    {
    	$status="";
    	if($hasil <= 0){
    		$status='Kurang Bayar';
    	}else{
    		$status='Lebih Bayar';
    	}
    	return $status;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
	public function attributeLabels()
	{
		return array(

			'tahun' => 'Tahun',
		

	
		);
	}
	

}
