<?php
/*

*/
class LaporanKecamatanController extends Controller
{
	public $layout='column2';
	public function actionLaporan(){
		$kecamatan = @$_GET['kecamatan'];
		$tahun = @$_GET['tahun'];
		if( (int) $kecamatan <=0 || (int)$tahun <=0){
			$this->render('laporanpilihtanggalkecamatan',[
				'kecamatan' => $kecamatan,
				'tahun' => $tahun
			]);
		}else{
			
			$this->render('laporanutama',[
				'kecamatan' => $kecamatan,
				'tahun' => $tahun
			]);
		}
	}
	public function actionKetetapankelurahan($tahun,$kecamatan){
		//$tahunini = self::tahunini();
		$tahunini = $tahun;
		$laporan = TotalTargetPajakKelurahan::getlaporankelurahantahun($tahunini,$kecamatan);
		$kelurahan = Yii::app()->report->kelurahan($kecamatan);
		
		$categories = Yii::app()->report->loopKelurahanCategories($kelurahan);
		
		$cat = $categories['cat'];
		$nilai = [];//$categories['nilai'];
		$total_objek = [];//$categories['nilai'];
		$_cate = [];
		if( !empty( $laporan) ){
			foreach( $laporan as $p ){
				if(isset($cat[$p['kd_kecamatan'].$p['kd_kelurahan']])){
					$nilai[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($p['ketetapan']);
					$total_objek[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($p['total_objek']);
					$_cate[$p['kd_kecamatan'].$p['kd_kelurahan']] = $cat[$p['kd_kecamatan'].$p['kd_kelurahan']];
				}
			}
		}
		if( count($_cate) < count($cat) ){
			foreach( $cat as $p => $name){
				if( !isset($_cate[$p])){
					$_cate[$p] = $name;
					$total_objek[$p] = 0;
					$nilai[$p] = 0;
				}
			}
		}
		$response = [
			"status"=>'ok',
			"title" => "Data Ketetapan dan Objek Pajak",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "Tahun ".$tahunini." (Total Kelurahan : ".count($kelurahan).")",
			"categories"=>array_values($_cate),
			"series"=> array(
						array(
								'name'	=>'Ketetapan',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'	=>array_values($nilai),
								'dataLabels'=> array(
									'enabled'=> true
								)
						),
						array(
								'name'=>'Total Objek',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($total_objek),
								'dataLabels'=> array(
									'enabled'=> true
								)
						)

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionRealisasikelurahantahunini($tahun,$kecamatan){
		$data = TotalPembayaranPiutang::getPersentasiRealisasiKlurahan($tahun,['kecamatan'=>$kecamatan]);
		$kelurahan = Yii::app()->report->kelurahan();
		$categories = Yii::app()->report->loopKelurahanCategories($kelurahan);
		
		$kecamatan = Yii::app()->report->kecamatan();
		$keccategories = Yii::app()->report->loopKecamatanCategories($kecamatan);
		$keccategories = $keccategories['cat'];
		
		$cat = $categories['cat'];
		$persentase = [];//$categories['nilai'];
		$minimalketetapan = [];//$categories['nilai'];
		$ketetapan = [];
		$realisasi = [];
		$categ = [];
		if( !empty( $data) ){
			foreach( $data as $p ){
				if(isset($cat[$p['kd_kecamatan'].$p['kd_kelurahan']])){
					$persentase[$p['kd_kecamatan'].$p['kd_kelurahan']] =  (float) number_format($p['percentages'],2,'.','.');//(floor) number_format($p['percentages'],2,'.','.');
					//$minimalketetapan[$p['kd_kecamatan'].$p['kd_kelurahan']] = (float) $p['ketetapan'];
					$ketetapan[$p['kd_kecamatan'].$p['kd_kelurahan']] = round( $p['ketetapan']);
					$realisasi[$p['kd_kecamatan'].$p['kd_kelurahan']] =round ($p['jumlah_bayar']);
					$categ[$p['kd_kecamatan'].$p['kd_kelurahan']] = $cat[$p['kd_kecamatan'].$p['kd_kelurahan']];
				}
			}
		}
		//print_r(array_values($persentase));
		$response = [
			"status"=>'ok',
			"title" => "Realisasi Kelurahan",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "Tahun ".$tahun,
			"categories"=>array_values($categ),
			"series"=> array(
						array(
								'name'	=>'Persentase',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'	=>array_values($persentase),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Ketetapan',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($ketetapan),
								//'tooltip' => ['valueSuffix'=>'Objek'],
								'dataLabels'=> array(
									'enabled'=> true
								)
						),
						array(
								'name'=>'Realisasi',
								'type' 	=>'line',
								'yAxis'=> 2,
								'data'=>array_values($realisasi),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Objek']
						)

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionPerubahanketetapan($kecamatan){
		//$data = TotalTargetPajakKabupaten::model()->findAll();
		$data = TotalTargetPajakKabupaten::getlaporantahunan($kecamatan);
		
		$defdata = Yii::app()->report->getalltahun();
		$tahun = $defdata['tahun'];
		$nilai = $defdata['nilai'];
		$objek = $defdata['objek'];

		if( !empty( $data) ){
			foreach( $data as $p ){
				if(isset($nilai[$p['tahun_pajak_sppt']])){
					$nilai[$p['tahun_pajak_sppt']] = round($p['ketetapan']);
					$objek[$p['tahun_pajak_sppt']] = round($p['total_objek']);
				}
			}
		}
		$response = [
					"status"=>'ok',
					"title" => "Data Ketetapan dan Objek Pajak",
					"text" => "Jumlah Ketetapan (Rp.)",
					"subtitle" => "",//"Tahun ".Yii::app()->report->tahun_mulai()." Sampai dengan ".Yii::app()->report->tahun_akhir(),
					"categories"=>$tahun,
					"series"=> array(
									array(
											'name'	=>'Ketetapan',
											'type' 	=>'area',
											'yAxis'=> 0,
											'data'	=>array_values($nilai),
											'dataLabels'=> array(
												'enabled'=> true
											)
									),
									array(
											'name'=>'Total Objek',
											'type' 	=>'area',
											'yAxis'=> 1,
											'data'=>array_values($objek),
											'dataLabels'=> array(
												'enabled'=> true
											)
									)

						)
				];
				echo CJSON::encode($response,JSON_NUMERIC_CHECK);
				return;
	}
	public function actionRealisasitahunan($kecamatan){
		//$data = TotalRealisasiPajakKabupaten::model()->findAll();
		$data = TotalPembayaranPiutang::getRealisasiTahunan(['kecamatan'=>$kecamatan]);
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		
		$defdata = Yii::app()->report->getalltahun();
		$tahun = $defdata['tahun'];
		$nilai = $defdata['nilai']; // jumlah_bayar
		$denda = $defdata['objek']; // DENDA
		
		$pembayaran_piutang = $defdata['nilai']; // jumlah_bayar
		$denda_piutang = $defdata['objek']; // DENDA
		
		if( !empty( $data) ){
			foreach( $data as $p ){
				if(isset($nilai[$p['tahun_pajak_sppt']])){
					if($p['status_bayar'] == 'realisasi'){
						$nilai[$p['tahun_bayar']] = round($p['pembayaran_pokok']);
						$denda[$p['tahun_bayar']] = round($p['pembayaran_denda']);
					}else{
						$pembayaran_piutang[$p['tahun_bayar']] = round($p['pembayaran_pokok']);
						$denda_piutang[$p['tahun_bayar']] = round($p['pembayaran_denda']);
					}
				}
			}
		}
		$response = [
			"status"=>'ok',
			"title" => "Pembayaran Tahunan",
			"text" => "Jumlah Realisasi (Rp.)",
			"subtitle" => "",//"Tahun ".self::tahun_mulai()." Sampai dengan ".self::tahun_akhir(),
			"categories"=>$tahun,
			"series"=> array(
					array(
							'name'	=>'Realisasi',
							'type' 	=>'area',
							'yAxis'=> 0,
							'data'	=>array_values($nilai),
							'dataLabels'=> array(
								'enabled'=> true
							)
					),
					array(
							'name'=>'Denda Realisasi',
							'type' 	=>'area',
							'yAxis'=> 1,
							'data'=>array_values($denda),
							'dataLabels'=> array(
								'enabled'=> true
							)
					),
					array(
							'name'	=>'Piutang Realisasi',
							'type' 	=>'area',
							'yAxis'=> 2,
							'data'	=>array_values($pembayaran_piutang),
							'dataLabels'=> array(
								'enabled'=> true
							)
					),
					array(
							'name'=>'Piutang Denda',
							'type' 	=>'area',
							'yAxis'=> 3,
							'data'=>array_values($denda_piutang),
							'dataLabels'=> array(
								'enabled'=> true
							)
					)

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionPembayaranpiutang($tahun,$kecamatan){
		$defdata = Yii::app()->report->getalltahun( $tahun - 1 );
		//$defdata = self::getalltahun( $tahun - 1);
		$tahuns = $defdata['tahun'];
		$pembayaran = $defdata['nilai'];
		$denda = $defdata['nilai'];
		$objek = $defdata['objek'];
		$data_pembayaran = [];
		$data = TotalPembayaranPiutang::getPembayaran_piutang($tahun,['kecamatan'=>$kecamatan]);
		if( !empty( $data) ){
			foreach( $data as $p ){
				if(isset($pembayaran[$p['tahun_pajak']])){
					$pembayaran[$p['tahun_pajak']] = (int) $p['pembayaran_pokok'];
					$denda[$p['tahun_pajak']] = (int) $p['pembayaran_denda'];
					$objek[$p['tahun_pajak']] = (int) $p['total_objek'];
					$data_pembayaran[] = ['tahun_pajak'=>$p['tahun_pajak'],'pembayaran_denda'=>(int) $p['pembayaran_denda'],'total_objek'=>(int) $p['total_objek'],'pembayaran_pokok'=>(int) $p['pembayaran_pokok']];
				}
			}
		}
		
		$response = [
			"status"=>'ok',
			"title" => "",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "",//"Tahun ".self::tahun_mulai()." Sampai dengan ".self::tahun_akhir(),
			"categories"=>$tahuns,
			'data_pembayaran' => $data_pembayaran,
			"series"=> array(
							array(
									'name'	=>'Piutang Pokok',
									'type' 	=>'column',
									'yAxis'=> 0,
									'data'	=>array_values($pembayaran),
									'dataLabels'=> array(
										'enabled'=> true
									)
							),
							array(
									'name'=>'Denda',
									'type' 	=>'line',
									'yAxis'=> 1,
									'data'=>array_values($denda),
									'dataLabels'=> array(
										'enabled'=> true
									)
							),
							array(
									'name'=>'Objek Pajak',
									'type' 	=>'line',
									'yAxis'=> 2,
									'data'=>array_values($objek),
									'dataLabels'=> array(
										'enabled'=> true
									)
							)

				)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	
	}
	public function actionLuasbumidanbangunan($kecamatan){
		$data = TotalTargetPajakKabupaten::getlaporantahunan($kecamatan);
		$defdata = Yii::app()->report->getalltahun();
		$tahun = $defdata['tahun'];
		$luas_bumi = $defdata['nilai'];
		$luas_bangunan = $defdata['objek'];

		if( !empty( $data) ){
			foreach( $data as $p ){
				if(isset($luas_bumi[$p['tahun_pajak_sppt']])){
					$luas_bumi[$p['tahun_pajak_sppt']] = round($p['luas_bumi']);
					$luas_bangunan[$p['tahun_pajak_sppt']] = round($p['luas_bangunan']);
				}
			}
		}
		$response = [
					"status"=>'ok',
					"title" => "Luas objek pajak Bumi Vs Tanah",
					"text" => "Jumlah Ketetapan (Rp.)",
					"subtitle" => "Tahun ".Yii::app()->report->tahun_mulai()." Sampai dengan ".Yii::app()->report->tahun_akhir(),
					"categories"=>$tahun,
					"series"=> array(
									array(
											'name'	=>'Bumi',
											'type' 	=>'area',
											'yAxis'=> 0,
											'data'	=>array_values($luas_bumi),
											'dataLabels'=> array(
												'enabled'=> true
											)
									),
									array(
											'name'=>'Bangunan',
											'type' 	=>'area',
											'yAxis'=> 1,
											'data'=>array_values($luas_bangunan),
											'dataLabels'=> array(
												'enabled'=> true
											)
									)

						)
				];
				echo CJSON::encode($response,JSON_NUMERIC_CHECK);
				return;
	}

	//Mencari ketetapan berdasarkan tahun berjalan
	public function actionKetetapan_tahunini($tahun,$kecamatan){
		$tahunini = $tahun;
		$Ketetapan_tahunini = TotalTargetPajakKabupaten::getlaporanKecketetapantahun($tahunini);
		//$this->renderPartial('_infochartahunini', array('Ketetapantahunini' => $Ketetapantahunini));
	}

	//Mencari Realisasi berdasarkan tahun berjalan
	public function actionRealisasi_tahunini($tahun,$kecamatan){
		$tahunini = $tahun;
		$Realisasi_tahunini = TotalRealisasiPajakKabupaten::getlaporanKecrealisasitahun($tahunini);
	}

	//Mencari Realisasi Objek berdasarkan tahun berjalan
	public function actionRealisasiobjektahunini($tahun,$kecamatan){
		$tahunini = $tahun;
		$Realisasiobjek_tahunini = TotalRealisasiPajakKabupaten::getlaporanKecrealisasiobjekpajaktahun($tahunini);
	}

	//Mencari Realisasi Pembayaran Denda berdasarkan tahun berjalan
	public function actionPiutang($tahun,$kecamatan){
		$tahunini = $tahun;
		$Piutang = TotalPembayaranPiutang::getlaporanKecpiutang($tahunini);
	}

	//Mencari total target pajak bumi berdasarkan tahun berjalan
	public function actionBumi_tahunini($tahun,$kecamatan){
		$tahunini = $tahun;
		$Bumi_tahunini = TotalTargetPajakKabupaten::getlaporanKecbumitahun($tahunini);
	}

	//Mencari total target pajak bangunan berdasarkan tahun berjalan
	public function actionBangunan_tahunini($tahun,$kecamatan){
		$tahunini = $tahun;
		$Bangunan_tahunini = TotalTargetPajakKabupaten::getlaporanKecbangunantahun($tahunini);
	}

	//Mencari total objek berdasarkan tahun berjalan
	public function actionObjekpajak_tahunini($tahun,$kecamatan){
		$tahunini = $tahun;
		$Objekpajak_tahunini = TotalTargetPajakKabupaten::getlaporanKecobjekpajaktahun($tahunini);
	}
}
