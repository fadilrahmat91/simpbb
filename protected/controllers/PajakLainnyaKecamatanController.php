<?php
/*

*/
class PajakLainnyaKecamatanController extends Controller
{
	public $layout='column2';
	private function tahun($tahun){
		$date = date('Y');
		if( (int) $tahun < Yii::app()->report->tahun_mulai_simpatda() || (int) $tahun > $date ){
			return $date;
		}
		return $tahun;
	}
	public function actionLaporan($tahun = ""){
		$kecamatan = @$_GET['kecamatan'];
		$tahun = self::tahun($tahun);
		
		if( (int) $kecamatan <=0 || (int)$tahun <=0){
			$this->render('laporanpilihtanggalkecamatan',[
				'kecamatan' => $kecamatan,
				'tahun' => $tahun
			]);
		}else{
			
			$this->render('laporanutama',[
				'tahun' => $tahun,
				'kecamatan' => $kecamatan
			]);
		}
		
		
	}
	public function actionKetetapanPajak($tahun,$kecamatan){
		$tahun = self::tahun($tahun);
		$type_pajak = KetetapanKecamatanSimpatda::TYPE_PAJAK;
		$ketetapan   = KetetapanKecamatanSimpatda::get_ketetapan_tahunan_chart($tahun,$type_pajak,$kecamatan);
		$jenis_pajak = JenisObjekPajakSimpatda::reArrangeJenisPajak($type_pajak);
		$charts = KetetapanKecamatanSimpatda::chartKetetapan("PAJAK",$tahun,$jenis_pajak,$ketetapan);
		echo CJSON::encode($charts,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionKetetapanRetribusi($tahun,$kecamatan){
		$tahun = self::tahun($tahun);
		$type_pajak = KetetapanKecamatanSimpatda::TYPE_PAJAK_RETRIBUSI;
		
		$ketetapan   = KetetapanKecamatanSimpatda::get_ketetapan_tahunan_chart($tahun,$type_pajak,$kecamatan);
		$jenis_pajak = JenisObjekPajakSimpatda::reArrangeJenisPajak($type_pajak);
		$charts = KetetapanKecamatanSimpatda::chartKetetapan("RETRIBUSI",$tahun,$jenis_pajak,$ketetapan);
		echo CJSON::encode($charts,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionRealisasiPajak($tahun,$kecamatan){
		$tahun = self::tahun($tahun);
		$type_pajak = KetetapanKecamatanSimpatda::TYPE_PAJAK;
		
		$realisasi   = RealisasiKecamatanSimpatda::get_realisasi_tahunan_chart($tahun,$type_pajak,$kecamatan);
		$jenis_pajak = JenisObjekPajakSimpatda::reArrangeJenisPajak($type_pajak);
		$charts = RealisasiKecamatanSimpatda::chartRealisasi("PAJAK",$tahun,$jenis_pajak,$realisasi);
		echo CJSON::encode($charts,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionRealisasiRetribusi($tahun,$kecamatan){
		$tahun = self::tahun($tahun);
		$type_pajak = KetetapanKecamatanSimpatda::TYPE_PAJAK_RETRIBUSI;
		
		$realisasi   = RealisasiKecamatanSimpatda::get_realisasi_tahunan_chart($tahun,$type_pajak,$kecamatan);
		$jenis_pajak = JenisObjekPajakSimpatda::reArrangeJenisPajak($type_pajak);
		$charts = RealisasiKecamatanSimpatda::chartRealisasi("RETRIBUSI",$tahun,$jenis_pajak,$realisasi);
		echo CJSON::encode($charts,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionKetetapanPajakKecamatan($tahun){
		$tahun = self::tahun($tahun);
		$type_pajak = KetetapanKecamatanSimpatda::TYPE_PAJAK;
		$ketetapan   = KetetapanKecamatanSimpatda::get_ketetapan_tahunan_kecamatan_chart($tahun,$type_pajak);
		$kecamatan = KecamatanSimpatda::reArrangeKecamatan();
		$jenis_pajak = JenisObjekPajakSimpatda::reArrangeJenisPajak($type_pajak);
		$charts = KetetapanKecamatanSimpatda::chartKetetapanKecamatan("PAJAK",$tahun,$jenis_pajak,$kecamatan,$ketetapan);
		echo CJSON::encode($charts,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionKetetapanRetribusiKecamatan($tahun){
		$tahun = self::tahun($tahun);
		$type_pajak = KetetapanKecamatanSimpatda::TYPE_PAJAK_RETRIBUSI;
		
		$ketetapan   = KetetapanKecamatanSimpatda::get_ketetapan_tahunan_kecamatan_chart($tahun,$type_pajak);
		$kecamatan = KecamatanSimpatda::reArrangeKecamatan();
		$jenis_pajak = JenisObjekPajakSimpatda::reArrangeJenisPajak($type_pajak);
		$charts = KetetapanKecamatanSimpatda::chartKetetapanKecamatan("RETRIBUSI",$tahun,$jenis_pajak,$kecamatan,$ketetapan);
		echo CJSON::encode($charts,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionRealisasiPajakKecamatan($tahun){
		$tahun = self::tahun($tahun);
		$type_pajak = KetetapanKecamatanSimpatda::TYPE_PAJAK;
		$ketetapan   = RealisasiKecamatanSimpatda::get_realisasi_tahunan_kecamatan_chart($tahun,$type_pajak);
		$kecamatan = KecamatanSimpatda::reArrangeKecamatan();
		$jenis_pajak = JenisObjekPajakSimpatda::reArrangeJenisPajak($type_pajak);
		$charts = RealisasiKecamatanSimpatda::chartRealisasiKecamatan("PAJAK",$tahun,$jenis_pajak,$kecamatan,$ketetapan);
		echo CJSON::encode($charts,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionRealisasiRetribusiKecamatan($tahun){
		$tahun = self::tahun($tahun);
		$type_pajak = KetetapanKecamatanSimpatda::TYPE_PAJAK_RETRIBUSI;
		
		$ketetapan   = RealisasiKecamatanSimpatda::get_realisasi_tahunan_kecamatan_chart($tahun,$type_pajak);
		$kecamatan = KecamatanSimpatda::reArrangeKecamatan();
		$jenis_pajak = JenisObjekPajakSimpatda::reArrangeJenisPajak($type_pajak);
		$charts = RealisasiKecamatanSimpatda::chartRealisasiKecamatan("RETRIBUSI",$tahun,$jenis_pajak,$kecamatan,$ketetapan);
		echo CJSON::encode($charts,JSON_NUMERIC_CHECK);
		return;
	}
}
