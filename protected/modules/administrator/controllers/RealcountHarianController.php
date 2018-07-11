<?php

class RealcountHarianController extends Controller
{
	public $layout='//layouts/column2';
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return RolesMenu::actionRule('realcountHarian'); 
	}
	public function actionIndex(){
		$_c_date = Yii::app()->realcount->c_day();
		$this->render('index',array(
			'c_date'=>$_c_date
		));
	}
	public function actionDatamaps(){
		$tanggal = @$_GET['tanggal'];
		if( $tanggal == "" ){
			$tanggal = Yii::app()->realcount->c_day();
		}
		list( $bulan, $hari, $tahun ) = explode("/",$tanggal); 
		$ketetapan = Yii::app()->realcount->get_data_dayKetetapan($tanggal);
		$_ketetapan = 0;
		$_objek_pajak = 0;
		$_kecamatan = [];
		$return = [];
		// get data kecamatan
		
		
		$categories = Yii::app()->report->loopKecamatanCategories(Yii::app()->report->kecamatan());
		$cat = $categories['cat'];
		
		$_data_ketetapan = [];
		$_data_objek = [];
		$_data_categ = [];
		
		
		if( count($ketetapan) > 0 ){
			foreach( $ketetapan as $p ){
				$_ketetapan = $_ketetapan + $p['KETETAPAN'];
				$_objek_pajak = $_objek_pajak + $p['JUM_OBJEK_PAJAK'];
				if(isset($cat[$p['KD_KECAMATAN']])){
					$_data_ketetapan[$p['KD_KECAMATAN']] = round($p['KETETAPAN']);
					$_data_objek[$p['KD_KECAMATAN']] = round($p['JUM_OBJEK_PAJAK']);
					$_data_categ[$p['KD_KECAMATAN']] = $cat[$p['KD_KECAMATAN']];
				}
				
			}
		}
		$response = [
			"status"=>'ok',
			"title" => "Ketetapan dan Objek Pajak",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "",
			"categories"=>array_values($_data_categ),
			"series"=> array(
						array(
								'name'	=>'Ketetapan',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'	=>array_values($_data_ketetapan),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Total Objek',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($_data_objek),
								'dataLabels'=> array(
									'enabled'=> true
								)
						)

			)
		];
		$return['ketetapan'] = $_ketetapan;
		$return['objek_pajak'] = $_objek_pajak;
		$return['response'] = $response;
		$realisasi = Yii::app()->realcount->get_data_dayRealisasi($tanggal);
		/*echo "<pre>";
		print_r($realisasi);
		echo "</pre>";
		*/
		$kecamatan = [];
		$total_objek_pajak = 0;
		$total_objek_pajak_piutang = 0;
		$total_pembayaran_pokok = 0;
		$total_pembayaran_denda = 0;
		$total_piutang = 0;
		$total_piutang_denda = 0;
		$kec_realisasi_data = [];
		
		$total_ketetapan_realisasi = [];
		$realisasi_objek_pajak = [];
		$_data_categ_realisasi =[];
		$_data_categ_piutang =[];
		$pembayaran_piutang_denda = [];
		$pembayaran_piutang_total_objek = [];
		// get data realisasi-denda & pembayaran piutang - denda
		if( count( $realisasi) > 0 ){
			foreach( $realisasi as $p ){
				$kecamatan[] = $p['KD_KECAMATAN'];
				if( $p['THN_PAJAK_SPPT'] == $tahun){
					if(isset($cat[$p['KD_KECAMATAN']])){
						$realisasi_objek_pajak[$p['KD_KECAMATAN']] = (isset($realisasi_objek_pajak[$p['KD_KECAMATAN']]) ? round($p['TOTAL_OBJEK_PAJAK']) + $realisasi_objek_pajak[$p['KD_KECAMATAN']] : round($p['TOTAL_OBJEK_PAJAK']));
						$jum = round($p['PEMBAYARAN_POKOK']);
						$total_ketetapan_realisasi[$p['KD_KECAMATAN']] = ( isset( $total_ketetapan_realisasi[$p['KD_KECAMATAN']]) ? $total_ketetapan_realisasi[$p['KD_KECAMATAN']] + $jum : $jum) ;
						$_data_categ_realisasi[$p['KD_KECAMATAN']] = $cat[$p['KD_KECAMATAN']];
						//$total = round(p['PEMBAYARAN_POKOK'] + $p['PEMBAYARAN_DENDA']);
						$total_pembayaran_pokok = $total_pembayaran_pokok + ($p['PEMBAYARAN_POKOK']- $p['PEMBAYARAN_DENDA']);
						$total_objek_pajak = $total_objek_pajak + $p['TOTAL_OBJEK_PAJAK'];
					}
					
				}else{
					if(isset($cat[$p['KD_KECAMATAN']])){
						$jum = round( $p['PEMBAYARAN_POKOK']);
						$pembayaran_piutang_denda[$p['KD_KECAMATAN']] = ( isset($pembayaran_piutang_denda[$p['KD_KECAMATAN']]) ? $pembayaran_piutang_denda[$p['KD_KECAMATAN']] + $jum : $jum);
						$pembayaran_piutang_total_objek[$p['KD_KECAMATAN']] = (isset($pembayaran_piutang_total_objek[$p['KD_KECAMATAN']]) ? $pembayaran_piutang_total_objek[$p['KD_KECAMATAN']] + round($p['TOTAL_OBJEK_PAJAK']) : round($p['TOTAL_OBJEK_PAJAK']));
						$_data_categ_piutang[$p['KD_KECAMATAN']] = $cat[$p['KD_KECAMATAN']];
						$total_piutang_denda = $total_piutang_denda + $p['PEMBAYARAN_DENDA'];
						$total_piutang = $total_piutang + ($p['PEMBAYARAN_POKOK']-$p['PEMBAYARAN_DENDA']);
						$total_objek_pajak_piutang = $total_objek_pajak_piutang + $p['TOTAL_OBJEK_PAJAK'];
					}
				}
			}
		}
		
		$response_realisasi = [
			"status"=>'ok',
			"title" => "Realisasi, Denda & Objek Pajak",
			"text" => "",
			"subtitle" => "",
			"categories"=>array_values($_data_categ_realisasi),
			"series"=> array(
						array(
								'name'	=>'Realisasi',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'	=>array_values($total_ketetapan_realisasi),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Total Objek',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($realisasi_objek_pajak),
								'dataLabels'=> array(
									'enabled'=> true
								)
						)

			)
		];
		$response_piutang = [
			"status"=>'ok',
			"title" => "Pembayaran Piutang & Objek Pajak",
			"text" => "",
			"subtitle" => "",
			"categories"=>array_values($_data_categ_piutang),
			"series"=> array(
						array(
								'name'	=>'Pembayaran Piutang',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'	=>array_values($pembayaran_piutang_denda),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Total Objek',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($pembayaran_piutang_total_objek),
								'dataLabels'=> array(
									'enabled'=> true
								)
						)

			)
		];
		$return['total_objek_pajak_piutang'] = $total_objek_pajak_piutang;
		$return['total_objek_pajak'] = $total_objek_pajak;
		$return['pembayaran_piutang'] = $response_piutang;
		$return['pembayaran_pokok'] = $total_pembayaran_pokok;
		$return['pembayaran_denda'] = $total_pembayaran_denda;
		$return['piutang_pokok'] = $total_piutang;
		$return['piutang_denda'] = $total_piutang_denda;
		$return['realisasi'] = $response_realisasi;
		
		/*echo "<pre>";
		print_r($kec_realisasi_data);
		echo "</pre>";
		echo "<pre>";
		print_r($kec_piutang_realisasi);
		echo "</pre>";*/
		echo CJSON::encode($return,JSON_NUMERIC_CHECK);
	}
}