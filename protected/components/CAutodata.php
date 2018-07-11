<?php
class CAutodata{
    public function init()
    {
        date_default_timezone_set("UTC");
    }
	public function getminimalketetapan($tahun){
		$data = MinimalKetetapan::model()->findByAttributes(array('tahun'=>$tahun));
		if( !empty($data)){
			return $data->minimal_ketetapan;
		}
		return 0;
	}
	
	public function goSqlRealisasiKelurahan($tahun){
		$oci = Yii::app()->dbOracle;
		$sql = "SELECT THN_PAJAK_SPPT, count(*) AS JUM_OBJEK_PAJAK, KD_DATI2_P AS KD_DATI2, KD_KECAMATAN_P AS KD_KECAMATAN, KD_KELURAHAN_P AS KD_KELURAHAN, sum(DENDA_SPPT) AS DENDA, sum(JML_SPPT_YG_DIBAYAR) as JML_SPPT_YG_DIBAYAR FROM PEMBAYARAN_SPPT WHERE THN_PAJAK_SPPT = '$tahun' AND TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('01/01/$tahun 00:00:00', 'MM/DD/YYYY HH24:MI:SS')
AND TO_DATE('12/31/$tahun 00:00:00', 'MM/DD/YYYY HH24:MI:SS') GROUP BY THN_PAJAK_SPPT,KD_DATI2_P, KD_KECAMATAN_P, KD_KELURAHAN_P";
		$command = $oci->createCommand($sql);
		$dataReader = $command->queryAll();
		echo $tahun."<br>";
		TotalRealisasiPajakKelurahan::model()->deleteAll('tahun_pajak_sppt =:tahun', [':tahun' => $tahun]);;
		if( !empty($dataReader)){
			foreach($dataReader as $row) {
				$model = new TotalRealisasiPajakKelurahan;
				$model->kabupaten_id = $row['KD_DATI2'];
				$model->tahun_pajak_sppt = $row['THN_PAJAK_SPPT'];
				$model->denda = $row['DENDA'];
				$model->jumlah_bayar = $row['JML_SPPT_YG_DIBAYAR'];
				$model->total_objek = $row['JUM_OBJEK_PAJAK'];
				$model->kd_kecamatan = $row['KD_KECAMATAN'];
				$model->kd_kelurahan = $row['KD_KELURAHAN'];
				$model->save();
			}
			Crontab::model()->run_crontab(Crontab::RUNREALISASIKELURAHAN);
		}
	}
	public function goSqlPembayaranPiutang($tahun){
		 $sql = "select 	HRD.KD_PROPINSI,
					HRD.KD_DATI2,
					HRD.KD_KECAMATAN,
					HRD.KD_KELURAHAN,
					HRD.THN_PAJAK_SPPT,
					COUNT(*) AS TOTAL_OBJEK_PAJAK,
					SUM(KETETAPAN) AS KETETAPAN,
					SUM(PEMBAYARAN_DENDA) AS PEMBAYARAN_DENDA,
					SUM(PEMBAYARAN_POKOK) AS PEMBAYARAN_POKOK,
					to_char(HRD.TANGGAL_PEMBAYARAN, 'YYYY')  AS TAHUN_BAYAR
				from 
					HIS_REALISASI_DATA HRD
				where  to_char(HRD.TANGGAL_PEMBAYARAN, 'YYYY') = '$tahun'
				group by
					HRD.KD_PROPINSI,
					HRD.KD_DATI2,
					HRD.KD_KECAMATAN,
					HRD.KD_KELURAHAN,
					HRD.THN_PAJAK_SPPT,
					to_char(HRD.TANGGAL_PEMBAYARAN, 'YYYY')
				";
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		
		$dataReader = new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'TAHUN',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'TAHUN', 'count'
                ),
				'defaultOrder'=>'TAHUN_BAYAR DESC',
            ),
            'pagination'=>false,
                )
        );
		$dataReader = $dataReader->getData();
		/*
		echo "<pre>";
		print_r($dataReader);
		echo "</pre>";
		*/
		echo $tahun;
		echo "</br>";
		//$command = $oci->createCommand($sql);
		//$dataReader = $command->queryAll();
		
		TotalPembayaranPiutang::model()->deleteAll('tahun_bayar =:tahun', [':tahun' => $tahun]);
		if( !empty($dataReader)){
			foreach($dataReader as $row) {
				$model = new TotalPembayaranPiutang;
				$model->kabupaten_id = $row['KD_DATI2'];
				$model->kecamatan_id = $row['KD_KECAMATAN'];
				$model->kelurahan_id = $row['KD_KELURAHAN'];
				$model->tahun_bayar  = $row['TAHUN_BAYAR'];
				$model->tahun_pajak  = $row['THN_PAJAK_SPPT'];
				$model->total_objek  = $row['TOTAL_OBJEK_PAJAK'];
				$model->pembayaran_denda = $row['PEMBAYARAN_DENDA'];
				$model->pembayaran_pokok = $row['PEMBAYARAN_POKOK'];
				$model->save();
			}
			Crontab::model()->run_crontab(Crontab::RUNPEMBAYARANPIUTANG);
		}
	}
	public function goSqlRealisasiKabupaten($tahun){
		$oci = Yii::app()->dbOracle;
		$sql = "SELECT THN_PAJAK_SPPT, count(*) AS JUM_OBJEK_PAJAK, KD_DATI2_P AS KD_DATI2, KD_KECAMATAN_P as KD_KECAMATAN, sum(DENDA_SPPT) AS DENDA, sum(JML_SPPT_YG_DIBAYAR) as JML_SPPT_YG_DIBAYAR FROM PEMBAYARAN_SPPT WHERE THN_PAJAK_SPPT = '$tahun' AND TGL_PEMBAYARAN_SPPT BETWEEN TO_DATE('01/01/$tahun 00:00:00', 'MM/DD/YYYY HH24:MI:SS')
AND TO_DATE('12/31/$tahun 00:00:00', 'MM/DD/YYYY HH24:MI:SS') GROUP BY THN_PAJAK_SPPT,KD_DATI2_P, KD_KECAMATAN_P";
		$command = $oci->createCommand($sql);
		$dataReader = $command->queryAll();
		echo $tahun."<br>";
		TotalRealisasiPajakKabupaten::model()->deleteAll('tahun_pajak_sppt =:tahun', [':tahun' => $tahun]);
		if( !empty($dataReader)){
			foreach($dataReader as $row) {
				$model = new TotalRealisasiPajakKabupaten;
				$model->kabupaten_id = $row['KD_DATI2'];
				$model->tahun_pajak_sppt = $row['THN_PAJAK_SPPT'];
				$model->denda = $row['DENDA'];
				$model->jumlah_bayar = $row['JML_SPPT_YG_DIBAYAR'];
				$model->total_objek = $row['JUM_OBJEK_PAJAK'];
				$model->kd_kecamatan = $row['KD_KECAMATAN'];
				$model->save();
			}
			Crontab::model()->run_crontab(Crontab::RUNREALISASIKABUPATEN);
		}
	}
	public function goSqlTargetKelurahan($tahun){
		$minimal_ketetapan = self::getminimalketetapan( $tahun );
		$oci = Yii::app()->dbOracle;
		$sql = "SELECT
			B.KD_DATI2,
			B.THN_PAJAK_SPPT,
			B.KD_KECAMATAN,
			B.KD_KELURAHAN,
			count(*) AS JUM_OBJEK_PAJAK,
			SUM( (CASE WHEN B.PBB_TERHUTANG_SPPT < $minimal_ketetapan THEN $minimal_ketetapan ELSE B.PBB_TERHUTANG_SPPT END)  ) AS MINIMAL_KETETAPAN,
			SUM(B.PBB_TERHUTANG_SPPT) AS PBB_TERHITUNG,
			SUM(B.LUAS_BUMI_SPPT) AS LUAS_BUMI,
			SUM(B.LUAS_BNG_SPPT) AS LUAS_BANGUNAN
			FROM
			PBB.SPPT B ,
			PBB.DAT_OBJEK_PAJAK E
			WHERE
			B.KD_PROPINSI = E.KD_PROPINSI(+) AND
			B.KD_DATI2 = E.KD_DATI2(+) AND
			B.KD_KECAMATAN = E.KD_KECAMATAN(+) AND
			B.KD_KELURAHAN = E.KD_KELURAHAN(+) AND
			B.KD_BLOK = E.KD_BLOK(+) AND
			B.NO_URUT = E.NO_URUT(+) AND
			B.KD_JNS_OP = E.KD_JNS_OP(+) AND B.THN_PAJAK_SPPT = '".$tahun."'   GROUP BY B.KD_DATI2, B.THN_PAJAK_SPPT,B.KD_KECAMATAN,B.KD_KELURAHAN";

		$command = $oci->createCommand($sql);
		$dataReader = $command->queryAll();
		TotalTargetPajakKelurahan::model()->deleteAll('tahun_pajak_sppt =:tahun', [':tahun' => $tahun]);
		echo $tahun."<br>";
		if( !empty($dataReader)){
			$totalketetapan = [];
			$luasbumi = [];
			$luasbangunan = [];
			$KD_DATI2 = 0;
			foreach($dataReader as $row) {

				$model = new TotalTargetPajakKelurahan;
				$model->kabupaten_id = $row['KD_DATI2'];
				$model->tahun_pajak_sppt = $row['THN_PAJAK_SPPT'];
				$model->ketetapan = $row['PBB_TERHITUNG'];
				$model->total_objek = $row['JUM_OBJEK_PAJAK'];
				$model->luas_bumi = $row['LUAS_BUMI'];
				$model->luas_bangunan = $row['LUAS_BANGUNAN'];
				$model->kd_kecamatan = $row['KD_KECAMATAN'];
				$model->kd_kelurahan = $row['KD_KELURAHAN'];
				$model->minimal_ketetapan = $row['MINIMAL_KETETAPAN'];
				$model->save();

				//echo $row['nama_lengkap'].'-'.$row['userlevel'].' <br>';
			}
			Crontab::model()->run_crontab(Crontab::RUNTARGETKELURAHAN);
		}
	}
	
	public function goSqlTargetKabupaten($tahun){
		$minimal_ketetapan = self::getminimalketetapan( $tahun );
		$oci = Yii::app()->dbOracle;
		$sql = "SELECT
			B.KD_DATI2,
			B.THN_PAJAK_SPPT,
			B.KD_KECAMATAN,
			count(*) AS JUM_OBJEK_PAJAK,
			SUM( (CASE WHEN B.PBB_TERHUTANG_SPPT < $minimal_ketetapan THEN $minimal_ketetapan ELSE B.PBB_TERHUTANG_SPPT END)  ) AS MINIMAL_KETETAPAN,
			SUM( B.PBB_TERHUTANG_SPPT ) AS PBB_TERHITUNG,
			SUM(B.LUAS_BUMI_SPPT) AS LUAS_BUMI,
			SUM(B.LUAS_BNG_SPPT) AS LUAS_BANGUNAN
			FROM
			PBB.SPPT B ,
			PBB.DAT_OBJEK_PAJAK E
			WHERE
			B.KD_PROPINSI = E.KD_PROPINSI(+) AND
			B.KD_DATI2 = E.KD_DATI2(+) AND
			B.KD_KECAMATAN = E.KD_KECAMATAN(+) AND
			B.KD_KELURAHAN = E.KD_KELURAHAN(+) AND
			B.KD_BLOK = E.KD_BLOK(+) AND
			B.NO_URUT = E.NO_URUT(+) AND
			B.KD_JNS_OP = E.KD_JNS_OP(+) AND B.THN_PAJAK_SPPT = '".$tahun."'   GROUP BY B.KD_DATI2, B.THN_PAJAK_SPPT,B.KD_KECAMATAN";
		
		$command = $oci->createCommand($sql);
		$dataReader = $command->queryAll();
		
		TotalTargetPajakKabupaten::model()->deleteAll('tahun_pajak_sppt =:tahun', [':tahun' => $tahun]);
		if( !empty($dataReader)){
			$totalketetapan = [];
			$luasbumi = [];
			$luasbangunan = [];
			$KD_DATI2 = 0;
			foreach($dataReader as $row) {

				$model = new TotalTargetPajakKabupaten;
				$model->kabupaten_id = $row['KD_DATI2'];
				$model->tahun_pajak_sppt = $row['THN_PAJAK_SPPT'];
				$model->ketetapan = $row['PBB_TERHITUNG'];
				$model->total_objek = $row['JUM_OBJEK_PAJAK'];
				$model->luas_bumi = $row['LUAS_BUMI'];
				$model->luas_bangunan = $row['LUAS_BANGUNAN'];
				$model->kd_kecamatan = $row['KD_KECAMATAN'];
				$model->minimal_ketetapan = $row['MINIMAL_KETETAPAN'];
				//$model->kd_kelurahan = $row['KD_KELURAHAN'];
				$model->save();

				//echo $row['nama_lengkap'].'-'.$row['userlevel'].' <br>';
			}
			Crontab::model()->run_crontab(Crontab::RUNTARGETKABUPATEN);
		}
	}
	public function saveRealisasiSimpatda($tahun, $data){
		if( count($data->data) > 0 ){
			RealisasiTahunanSimpatda::model()->deleteAll('tahun =:tahun', [':tahun' => $tahun]);
			foreach($data->data as $row) {
				
				$model = new RealisasiTahunanSimpatda;
				$model->kodejenispajak = $row->kodejenispajak;
				$model->tahun = $tahun;
				$model->pajakterutang = $row->pajakterutang;
				$model->denda = $row->denda;
				$model->sanksi_adm = $row->sanksi_adm;
				$model->save();

				//echo $row['nama_lengkap'].'-'.$row['userlevel'].' <br>';
			}
			Crontab::model()->run_crontab(Crontab::RUNREALISASIPAJAKSIMPATDA);
		}
	}
	public function saveRealisasiKecamatanSimpatda($tahun,$data){
		
		if( count($data->data) > 0 ){
			RealisasiKecamatanSimpatda::model()->deleteAll('tahun =:tahun', [':tahun' => $tahun]);
			foreach($data->data as $row) {
				
				$model = new RealisasiKecamatanSimpatda;
				$model->kd_kecamatan = $row->kecamatan;
				$model->kodejenispajak = $row->kodejenispajak;
				$model->tahun = $tahun;
				$model->jumlah_objek = $row->jumlah_objek;
				$model->ketetapan = $row->ketetapan;
				$model->jumlah_bayar = $row->jumlah_bayar;
				$model->jumlah_denda = $row->jumlah_denda;
				$model->jumlah_sanksi_adm = $row->jumlah_sanksi_adm;
				$model->save();

				//echo $row['nama_lengkap'].'-'.$row['userlevel'].' <br>';
			}
			Crontab::model()->run_crontab(Crontab::RUNREALISASIKECAMATANSIMPATDA);
		}
	}
	public function saveKetetapanKecamatanSimpatda( $tahun,$data , $type ){
		
		if( count($data->data) > 0 ){
			KetetapanKecamatanSimpatda::model()->deleteAll('tahun =:tahun and type_pajak=:type_pajak', [':tahun' => $tahun,':type_pajak'=>$type]);
			foreach($data->data as $row) {
				
				$model = new KetetapanKecamatanSimpatda;
				$model->kd_kecamatan = $row->kecamatan;
				$model->kodejenispajak = $row->kodejenispajak;
				$model->tahun = $tahun;
				$model->jumlah_objek = $row->jumlah_objek;
				$model->ketetapan = $row->pajak_terutang;
				$model->sanksi_adm = $row->sanksi_adm;
				$model->type_pajak = $type;
				$model->save();

				//echo $row['nama_lengkap'].'-'.$row['userlevel'].' <br>';
			}
			if( $type == KetetapanKecamatanSimpatda::TYPE_PAJAK ){
				Crontab::model()->run_crontab(Crontab::KETETAPANPAJAKKECAMATAN);
			}else{
				Crontab::model()->run_crontab(Crontab::KETETAPANPAJAKRETRIBUSIKECAMATAN);
			}
		}
	}
	
	public function savekecamatanSimpatda( $data ){
		
	
		if( count($data->data) > 0 ){
			KecamatanSimpatda::model()->deleteAll();
			foreach($data->data as $row) {
				
				$model = new KecamatanSimpatda;
				$model->kdkecamatan = $row->kode_kecamatan;
				$model->nama_kecamatan = $row->nama_kecamatan;
				$model->save();

				//echo $row['nama_lengkap'].'-'.$row['userlevel'].' <br>';
			}
			Crontab::model()->run_crontab(Crontab::RUNKECAMATANSIMPATDA);
		}
		
	}
	
	public function savejenisPajakSimpatda( $data ){
		
	
		if( count($data->data) > 0 ){
			JenisObjekPajakSimpatda::model()->deleteAll();
			foreach($data->data as $row) {
				
				$model = new JenisObjekPajakSimpatda;
				$model->kodejenispajak = $row->kodejenispajak;
				$model->jenispajak = $row->jenispajak;
				$model->save();

				//echo $row['nama_lengkap'].'-'.$row['userlevel'].' <br>';
			}
			Crontab::model()->run_crontab(Crontab::RUNJENISPAJAKSIMPATDA);
		}
		
	}
	
}

?>