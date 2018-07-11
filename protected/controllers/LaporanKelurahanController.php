<?php
/*

*/
class LaporanKelurahanController extends Controller
{
	public $layout='column2';
	public function actionLaporan(){
		$kecamatan = @$_GET['kecamatan'];
		$tahun = @$_GET['tahun'];
		$kelurahan = @$_GET['kelurahan'];
		$keloption = "<option>Pilih Kecamatan</option>";
		if( (int)$kelurahan > 0 && (int)$kecamatan > 0){
			$keloption = Yii::app()->report->kelurahanOption($kecamatan,$kelurahan);
		}
		if( (int) $kecamatan <=0 || (int)$tahun <=0 || (int)$kelurahan <=0){
			$this->render('laporanpilihtanggalkecamatan',[
				'kecamatan' => $kecamatan,
				'tahun' => $tahun,
				'kelurahan' => $kelurahan,
				'keloption' => $keloption
			]);
		}else{
			
			$this->render('laporanutama',[
				'kecamatan' => $kecamatan,
				'tahun' => $tahun,
				'kelurahan' => $kelurahan,
				'keloption' => $keloption
			]);
		}
	}
	public function actionGetKelurahanbykecamatan(){
		$kecamatan = @$_GET['kecamatan'];
		$allow_empty = @$_GET['allowempty'];
		if( (int)$kecamatan > 0 ){
			$kel = "";
			if( $allow_empty == 1 ){
				$kel = "<option>Pilih Kelurahan</option>";
			}
			$kel .= Yii::app()->report->kelurahanOption($kecamatan);
			echo CJSON::encode(['html'=>$kel]);
			return;
		}
		echo CJSON::encode(['html'=>"<option>Pilih Kecamatan</option>"]);
	}
	public function actionKetetapankelurahan($tahun,$kecamatan){
		//$tahunini = self::tahunini();
		$tahunini = $tahun;
		$laporan = TotalTargetPajakKelurahan::getlaporankelurahantahun($tahunini,$kecamatan);
		$kelurahan = Yii::app()->report->kelurahan();
		
		$categories = Yii::app()->report->loopKelurahanCategories($kelurahan);
		
		$cat = $categories['cat'];
		$nilai = $categories['nilai'];
		$total_objek = $categories['nilai'];
		if( !empty( $laporan) ){
			foreach( $laporan as $p ){
				if(isset($cat[$p['kd_kecamatan'].$p['kd_kelurahan']])){
					$nilai[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($p['ketetapan']);
					$total_objek[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($p['total_objek']);
				}
			}
		}
		
		$response = [
			"status"=>'ok',
			"title" => "Data Ketetapan dan Objek Pajak Kelurahan",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "Tahun ".$tahunini." (Total Kelurahan : ".count($kelurahan).")",
			"categories"=>array_values($cat),
			"series"=> array(
						array(
								'name'	=>'Ketetapan',
								'type' 	=>'line',
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
		//$tahunini = self::tahunini();
		$tahunini = $tahun;
		$realisasi = TotalRealisasiPajakKelurahan::getlaporankelurahantahun($tahunini,$kecamatan);
		$kelurahan = Yii::app()->report->kelurahan();
		$categories = Yii::app()->report->loopKelurahanCategories($kelurahan);
		$cat = $categories['cat'];
		$jumlahbayar = $categories['nilai'];
		$denda = $categories['nilai'];
		if( !empty( $realisasi) ){
			foreach( $realisasi as $p ){
				if(isset($cat[$p['kd_kecamatan'].$p['kd_kelurahan']])){
					$jumlahbayar[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($p['jumlah_bayar']);
					$denda[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($p['denda']);
				}
			}
		}
		
		$response = [
			"status"=>'ok',
			"title" => "Data Realisasi & Denda",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "Tahun ".$tahunini." (Total Kelurahan : ".count($kelurahan).")",
			"categories"=>array_values($cat),
			"series"=> array(
						array(
								'name'	=>'Realisasi',
								'type' 	=>'line',
								'yAxis'=> 0,
								'data'	=>array_values($jumlahbayar),
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
						)

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionPerubahanketetapan($kecamatan,$kelurahan){
		//$data = TotalTargetPajakKabupaten::model()->findAll();
		$data = TotalTargetPajakKelurahan::getlaporantahunan($kecamatan,$kelurahan);
		
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
					"title" => "",//"Data Ketetapan dan Objek Pajak",
					"text" => "Jumlah Ketetapan (Rp.)",
					"subtitle" => "",//"Tahun ".Yii::app()->report->tahun_mulai()." Sampai dengan ".Yii::app()->report->tahun_akhir(),
					"categories"=>$tahun,
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
	public function actionPembayaranpiutang($tahun,$kecamatan,$kelurahan){
		$defdata = Yii::app()->report->getalltahun( $tahun - 1 );
		//$defdata = self::getalltahun( $tahun - 1);
		$tahuns = $defdata['tahun'];
		$pembayaran = $defdata['nilai'];
		$denda = $defdata['nilai'];
		$objek = $defdata['objek'];
		$data_pembayaran = [];
		$data = TotalPembayaranPiutang::getPembayaran_piutang($tahun,['kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]);
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
	public function actionRealisasitahunan($kecamatan,$kelurahan){
		//$data = TotalRealisasiPajakKabupaten::model()->findAll();
		$data = TotalPembayaranPiutang::getRealisasiTahunan(['kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]);
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
			"title" => "",
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
	public function actionLuasbumidanbangunan($kecamatan,$kelurahan){
		$data = TotalTargetPajakKelurahan::getlaporantahunan($kecamatan,$kelurahan);
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
					"title" => "",//"Luas objek pajak Bumi Vs Tanah",
					"text" => "Jumlah Ketetapan (Rp.)",
					"subtitle" => "",
					"categories"=>$tahun,
					"series"=> array(
									array(
											'name'	=>'Bumi',
											'type' 	=>'line',
											'yAxis'=> 0,
											'data'	=>array_values($luas_bumi),
											'dataLabels'=> array(
												'enabled'=> true
											)
									),
									array(
											'name'=>'Bangunan',
											'type' 	=>'line',
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
	public function actionKetetapan_tahunini($tahun,$kecamatan,$kelurahan){
		$tahunini = $tahun;
		$Ketetapan_tahunini = TotalTargetPajakKelurahan::getlaporanKelketetapantahun($tahunini);
		//$this->renderPartial('_infochartahunini', array('Ketetapantahunini' => $Ketetapantahunini));
	}

	//Mencari Realisasi berdasarkan tahun berjalan
	public function actionRealisasi_tahunini($tahun,$kecamatan,$kelurahan){
		$tahunini = $tahun;
		$Realisasi_tahunini = TotalRealisasiPajakKelurahan::getlaporanKelrealisasitahun($tahunini);
	}

	//Mencari Realisasi Objek berdasarkan tahun berjalan
	public function actionRealisasiobjektahunini($tahun,$kecamatan,$kelurahan){
		$tahunini = $tahun;
		$Realisasiobjek_tahunini = TotalRealisasiPajakKelurahan::getlaporanKelrealisasiobjekpajaktahun($tahunini);
	}

	//Mencari Realisasi Pembayaran Denda berdasarkan tahun berjalan
	public function actionPiutang($tahun,$kecamatan){
		$tahunini = $tahun;
		$Piutang = TotalPembayaranPiutang::getlaporanKelpiutang($tahunini);
	}

	//Mencari total target pajak bumi berdasarkan tahun berjalan
	public function actionBumi_tahunini($tahun,$kecamatan,$kelurahan){
		$tahunini = $tahun;
		$Bumi_tahunini = TotalTargetPajakKelurahan::getlaporanKelbumitahun($tahunini);
	}

	//Mencari total target pajak bangunan berdasarkan tahun berjalan
	public function actionBangunan_tahunini($tahun,$kecamatan,$kelurahan){
		$tahunini = $tahun;
		$Bangunan_tahunini = TotalTargetPajakKelurahan::getlaporanKelbangunantahun($tahunini);
	}

	//Mencari total objek berdasarkan tahun berjalan
	public function actionObjekpajak_tahunini($tahun,$kecamatan,$kelurahan){
		$tahunini = $tahun;
		$Objekpajak_tahunini = TotalTargetPajakKelurahan::getlaporanKelobjekpajaktahun($tahunini);
	}
}
