<?php
//Perbaikan tes coba
class AutolaporanController extends Controller
{
	public function actionRuntargetKabupaten(){
		
		//self::goSqlTargetKabupaten();
		//for( $x = 1994;$x<=2012;$x++ ){
			//Yii::app()->autodata->goSqlTargetKabupaten($x);
		//}
		Yii::app()->autodata->goSqlTargetKabupaten(date('Y'));
		//Yii::app()->autodata->goSqlTargetKabupaten(2017);
	}
	public function actionRunRealisasiKabupaten(){
		for( $x = 1994;$x<=2012;$x++ ){
			//Yii::app()->autodata->goSqlRealisasiKabupaten($x);
		}
		Yii::app()->autodata->goSqlRealisasiKabupaten(date('Y'));
	}
	public function actionRunRealisasiKelurahan(){
		for( $x = 1994;$x<=2012;$x++ ){
			//Yii::app()->autodata->goSqlRealisasiKelurahan($x);
		}
		Yii::app()->autodata->goSqlRealisasiKelurahan(date('Y'));
	}
	public function actionRunTargetKelurahan(){
		for( $x = 2017;$x<=2018;$x++ ){
			//Yii::app()->autodata->goSqlTargetKelurahan($x);
		}
		Yii::app()->autodata->goSqlTargetKelurahan(date('Y'));
	}
	public function actionRunPembayaranPiutang(){
		for( $x = 1994;$x<=date('Y');$x++ ){
			Yii::app()->autodata->goSqlPembayaranPiutang($x);
		}
		//Yii::app()->autodata->goSqlTargetKelurahan(date('Y'));
	}
	public function actionRungetjenisOpSimalungun(){
		$output = json_decode(Yii::app()->curl->get(Yii::app()->params['apiSimalungun']."laporanPajak/getJenisPajak", []));
		Yii::app()->autodata->savejenisPajakSimpatda($output);
	}
	public function actionRunKecamatanSimalungun(){
		$output = json_decode(Yii::app()->curl->get(Yii::app()->params['apiSimalungun']."laporanPajak/getKecamatan", []));
		Yii::app()->autodata->savekecamatanSimpatda($output);
	}
	public function actionRunRealisasiSimalungun(){
		for( $x = 2015;$x<=date('Y');$x++ ){
			$output = json_decode(Yii::app()->curl->get(Yii::app()->params['apiSimalungun']."laporanPajak/getdatapajak/tahun/".$x, []));
			Yii::app()->autodata->saveRealisasiSimpatda($x,$output);
		}
	}
	public function actionRunRealisasiKecamatanSimalungun(){
		for( $x = 2015;$x<=date('Y');$x++ ){
			$output = json_decode(Yii::app()->curl->get(Yii::app()->params['apiSimalungun']."laporanPajak/getDataPajakKecamatan/tahun/".$x, []));
			Yii::app()->autodata->saveRealisasiKecamatanSimpatda($x,$output);
		}
	}
	public function actionRunKetetapanKecamatanSimalungun(){
		for( $x = 2015;$x<=date('Y');$x++ ){
			$output = json_decode(Yii::app()->curl->get(Yii::app()->params['apiSimalungun']."laporanPajak/getDataKetetapanPajakKecamatan/tahun/".$x, []));
			Yii::app()->autodata->saveKetetapanKecamatanSimpatda($x,$output,KetetapanKecamatanSimpatda::TYPE_PAJAK);
		}
	}
	public function actionRunKetetapanRetribusiKecamatanSimalungun(){
		for( $x = 2015;$x<=date('Y');$x++ ){
			$output = json_decode(Yii::app()->curl->get(Yii::app()->params['apiSimalungun']."laporanPajak/getDataKetetapanPajakRetribusiKecamatan/tahun/".$x, []));
			Yii::app()->autodata->saveKetetapanKecamatanSimpatda($x,$output,KetetapanKecamatanSimpatda::TYPE_PAJAK_RETRIBUSI);
		}
	}
	
}
