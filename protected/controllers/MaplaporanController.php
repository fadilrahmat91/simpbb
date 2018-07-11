<?php
/*

*/
class MaplaporanController extends Controller
{
	public $layout='column2';
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionIndex(){
		$date = date('Y');
		$this->render('laporanutama',[
			'tahun' => $date
		]);
	}
	public function actionLaporantahunan($tahun = 2018){
		$this->render('laporantahunan',[
			'tahun' => $tahun
		]);
	}
	private function tahun_mulai(){
		return Yii::app()->report->tahun_mulai();
		//return  date('Y') - 10;
	}
	private function tahun_akhir(){
		$date = Yii::app()->report->tahun_akhir();
		return $date - 1;
	}
	private function tahunini(){
		return date('Y');
	}
	private function getalltahun( $tahun = "" ){
		return Yii::app()->report->getalltahun( $tahun );
	}
	public function actionRealisasitahunini($tahun){
		//$tahunini = self::tahunini();
		$tahunini = $tahun;
		//$realisasi = TotalRealisasiPajakKabupaten::getlaporankecamatantahun($tahunini);
		$realisasi = TotalPembayaranPiutang::getRealisasiGroup( $tahunini);
		$kecamatan = Yii::app()->report->kecamatan();
		$categories = Yii::app()->report->loopKecamatanCategories($kecamatan);
		$cat = $categories['cat'];
		$jumlahbayar = [];//$categories['nilai'];
		$denda = [];//$categories['nilai'];
		$categ = [];
		$jumlahbayar_piutang = [];
		$jumlah_denda_piutang = [];
		$objek_pajak = [];
		if( !empty( $realisasi) ){
			foreach( $realisasi as $p ){
				if(isset($cat[$p['kd_kecamatan']])){
					if( $p['status_bayar'] == 'realisasi'){
						$jumlahbayar[$p['kd_kecamatan']] = round($p['pembayaran_pokok']);
						$denda[$p['kd_kecamatan']] = round($p['pembayaran_denda']);
					}else{
						$jumlahbayar_piutang[$p['kd_kecamatan']] = round($p['pembayaran_pokok']);
						$jumlah_denda_piutang[$p['kd_kecamatan']] = round($p['pembayaran_denda']);
					}
					$objek_pajak[$p['kd_kecamatan']] = round($p['total_objek']);
					$categ[$p['kd_kecamatan']] = $cat[$p['kd_kecamatan']];
				}
			}
		}
		
		if( count($categ) < count($cat) ){
			foreach( $cat as $p => $name){
				if( !isset($categ[$p])){
					$categ[$p] = $name;
					$denda[$p] = 0;
					$jumlahbayar[$p] = 0;
					$objek_pajak[$p] = 0;
					$jumlahbayar_piutang[$p] = 0;
					$jumlah_denda_piutang[$p] = 0;
				}
			}
		}
		$response = [
			"status"=>'ok',
			"title" => "Data Realisasi & Denda",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "Tahun ".$tahunini,
			"categories"=>array_values($categ),
			"series"=> array(
						array(
								'name'	=>'Realisasi',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'	=>array_values($jumlahbayar),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Denda',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($denda),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Objek']
						),
						array(
								'name'	=>'Realisasi Piutang',
								'type' 	=>'line',
								'yAxis'=> 2,
								'data'	=>array_values($jumlahbayar_piutang),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Realisasi Piutang Denda',
								'type' 	=>'line',
								'yAxis'=> 3,
								'data'=>array_values($jumlah_denda_piutang),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Objek']
						)
						
						/*array(
								'name'=>'Objek Pajak',
								'type' 	=>'line',
								'yAxis'=> 2,
								'data'=>array_values($objek_pajak),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Objek']
						)*/

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}

	
	public function actionRealisasipersentaseKelurahantahunini($tahun,$limit){
		//$data = TotalRealisasiPajakKelurahan::getPersentasiRealisasi($tahun,['limit'=>$limit]);
		$data = TotalPembayaranPiutang::getPersentasiRealisasiKlurahan($tahun,['limit'=>$limit]);
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
					$minimalketetapan[$p['kd_kecamatan'].$p['kd_kelurahan']] = (float) $p['ketetapan'];
					$ketetapan[$p['kd_kecamatan'].$p['kd_kelurahan']] = (float) $p['ketetapan'];
					$realisasi[$p['kd_kecamatan'].$p['kd_kelurahan']] =(float) $p['jumlah_bayar'];
					$categ[$p['kd_kecamatan'].$p['kd_kelurahan']] = $keccategories[$p['kd_kecamatan']].'-'.$cat[$p['kd_kecamatan'].$p['kd_kelurahan']];
				}
			}
		}
		//print_r(array_values($persentase));
		$response = [
			"status"=>'ok',
			"title" => "10 Kelurahan dengan persentase realisasi Tertinggi (%)",
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
								'data'=>array_values($minimalketetapan),
								//'tooltip' => ['valueSuffix'=>'Objek'],
								'dataLabels'=> array(
									'enabled'=> true
								)
						),
						/*array(
								'name'=>'Ketetapan TANPA MINIMUM',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($ketetapan),
								//'tooltip' => ['valueSuffix'=>'Objek'],
								'dataLabels'=> array(
									'enabled'=> true
								)
						),*/
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
	public function actionRealisasipersentaseKecamatantahunini($tahun,$limit){
		$data = TotalPembayaranPiutang::getPersentasiRealisasi($tahun,['limit'=>$limit]);
		
		$kecamatan = Yii::app()->report->kecamatan();
		$categories = Yii::app()->report->loopKecamatanCategories($kecamatan);
		$cat = $categories['cat'];
		$persentase = [];//$categories['nilai'];
		$ketetapan = [];//$categories['nilai'];
		$realisasi = [];
		$categ = [];
		if( !empty( $data) ){
			foreach( $data as $p ){
				if(isset($cat[$p['kd_kecamatan']])){
					$persentase[$p['kd_kecamatan']] =   (float) number_format($p['percentages'],2,'.','.');
					$ketetapan[$p['kd_kecamatan']] = (float) $p['ketetapan'];
					$realisasi[$p['kd_kecamatan']] =(float) $p['jumlah_bayar'];
					$categ[$p['kd_kecamatan']] = $cat[$p['kd_kecamatan']];
				}
			}
		}
		
		$response = [
			"status"=>'ok',
			"title" => "10 Kecamatan dengan persentase realisasi Tertinggi (%)",
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

	public function actionKelurahanrealisasiterbesar($tahun,$limit){
		$realisasi = TotalRealisasiPajakKelurahan::getlaporankelurahantahunorderketetapan($tahun,
			['limit'=>$limit]
		);
		$targetpajak = TotalTargetPajakKelurahan::getlaporankelurahantahun($tahun);
		$target = [];
		foreach( $targetpajak as $px ){
			$target[$px['kd_kecamatan'].$px['kd_kelurahan']] = $px['ketetapan'];
		}
		$kelurahan = Yii::app()->report->kelurahan();

		$categories = Yii::app()->report->loopKelurahanCategories($kelurahan);
		
		$kecamatan = Yii::app()->report->kecamatan();
		$keccategories = Yii::app()->report->loopKecamatanCategories($kecamatan);
		$keccategories = $keccategories['cat'];
		


		$categories = Yii::app()->report->loopKelurahanCategories($kelurahan);


		$cat = $categories['cat'];
		$_cat = [];
		$nilai = [];
		$total_objek = [];
		$denda = [];

		$s_ketetapan = [];
		if( !empty( $realisasi) ){
			foreach( $realisasi as $p ){
				if(isset($cat[$p['kd_kecamatan'].$p['kd_kelurahan']])){
					$nilai[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($p['jumlah_bayar']);
					$total_objek[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($p['total_objek']);
					$_cat[] = $keccategories[$p['kd_kecamatan']]."-".$cat[$p['kd_kecamatan'].$p['kd_kelurahan']];
					$denda[] = round($p['denda']);

					if( isset( $target[$p['kd_kecamatan'].$p['kd_kelurahan']])){
						$s_ketetapan[$p['kd_kecamatan'].$p['kd_kelurahan']] = round($target[$p['kd_kecamatan'].$p['kd_kelurahan']]);
					}else{
						$s_ketetapan[$p['kd_kecamatan'].$p['kd_kelurahan']] = 0;
					}
				}
			}
		}
		/*echo "<pre>";
		print_r(array_values($s_realisasi));
		echo "</pre>";*/
		$response = [
			"status"=>'ok',
			"title" => "10 Urutan Kelurahan Berdasarkan Jumlah Realisasi Terbesar",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "Tahun ".$tahun,
			"categories"=>array_values($_cat),
			"series"=> array(
						array(
								'name'	=>'Realisasi',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'	=>array_values($nilai),
								'dataLabels'=> array(
								'enabled'=> true
							)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Total Objek',
								'type' 	=>'line',
								'yAxis'=> 2,
								'data'=>array_values($total_objek),
								'dataLabels'=> array(
									'enabled'=> true
								)
						),
						array(
								'name'=>'Ketetapan',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($s_ketetapan),
								'dataLabels'=> array(
									'enabled'=> true
								)
						)

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionKelurahanketetapanterbesar($tahun,$limit){
		//$data = TotalRealisasiPajakKelurahan::getPersentasiRealisasi($tahun,['limit'=>$limit]);
		$data = TotalPembayaranPiutang::getKetetapanKelurahan($tahun,['limit'=>$limit]);
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
					$minimalketetapan[$p['kd_kecamatan'].$p['kd_kelurahan']] = (float) $p['ketetapan'];
					$ketetapan[$p['kd_kecamatan'].$p['kd_kelurahan']] = (float) $p['ketetapan'];
					$realisasi[$p['kd_kecamatan'].$p['kd_kelurahan']] =(float) $p['realisasi'];
					$categ[$p['kd_kecamatan'].$p['kd_kelurahan']] = $keccategories[$p['kd_kecamatan']].'-'.$cat[$p['kd_kecamatan'].$p['kd_kelurahan']];
				}
			}
		}
		//print_r(array_values($persentase));
		$response = [
			"status"=>'ok',
			"title" => "10 Kelurahan dengan Ketetapan Terbesar",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "Tahun ".$tahun,
			"categories"=>array_values($categ),
			"series"=> array(
						array(
								'name'=>'Ketetapan',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'=>array_values($minimalketetapan),
								//'tooltip' => ['valueSuffix'=>'Objek'],
								'dataLabels'=> array(
									'enabled'=> true
								)
						),
						array(
								'name'=>'Realisasi',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($realisasi),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Objek']
						),
						array(
								'name'	=>'Persentase',
								'type' 	=>'line',
								'yAxis'=> 2,
								'data'	=>array_values($persentase),
								'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	
	/*public function actionRealisasikelurahantahunini($tahun){
		//$tahunini = self::tahunini();
		$tahunini = $tahun;
		$realisasi = TotalRealisasiPajakKelurahan::getlaporankelurahantahun($tahunini);
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
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Denda',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($denda),
								//'tooltip' => ['valueSuffix'=>'Objek']
						)

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	*/
	public function actionKetetapankelurahan($tahun){
		//$tahunini = self::tahunini();
		$tahunini = $tahun;
		$laporan = TotalTargetPajakKelurahan::getlaporankelurahantahun($tahunini);
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
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Total Objek',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($total_objek),
								//'tooltip' => ['valueSuffix'=>'Objek']
						)

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	
	public function actionKetetapankecamatan($tahun){
		//$tahunini = self::tahunini();
		$tahunini = $tahun;
		$laporan = TotalTargetPajakKabupaten::getlaporankecamatantahun($tahunini);


		$categories = Yii::app()->report->loopKecamatanCategories(Yii::app()->report->kecamatan());
		
		$cat = $categories['cat'];
		$nilai = $categories['nilai'];
		$total_objek = $categories['nilai'];
		$nilai = [];
		$total_objek = [];
		$categ = [];
		if( !empty( $laporan) ){
			foreach( $laporan as $p ){
				if(isset($cat[$p['kd_kecamatan']])){
					$nilai[$p['kd_kecamatan']] = round($p['ketetapan']);
					$total_objek[$p['kd_kecamatan']] = round($p['total_objek']);
					$categ[$p['kd_kecamatan']] = $cat[$p['kd_kecamatan']];
				}
			}
		}
		if( count($categ) < count($cat) ){
			foreach( $cat as $p => $name){
				if( !isset($categ[$p])){
					$categ[$p] = $name;
					$nilai[$p] = 0;
					$total_objek[$p] = 0;
				}
			}
		}
		$response = [
			"status"=>'ok',
			"title" => "Data Ketetapan dan Objek Pajak",
			"text" => "Jumlah Ketetapan (Rp.)",
			"subtitle" => "Tahun ".$tahunini,
			"categories"=>array_values($categ),
			"series"=> array(
						array(
								'name'	=>'Ketetapan',
								'type' 	=>'column',
								'yAxis'=> 0,
								'data'	=>array_values($nilai),
									'dataLabels'=> array(
									'enabled'=> true
								)
								//'tooltip' => ['valueSuffix'=>'Rp.']
						),
						array(
								'name'=>'Total Objek',
								'type' 	=>'line',
								'yAxis'=> 1,
								'data'=>array_values($total_objek),
								//'tooltip' => ['valueSuffix'=>'Objek']
						)

			)
		];
		echo CJSON::encode($response,JSON_NUMERIC_CHECK);
		return;
	}
	public function actionLuasbumidanbangunan(){
		$data = TotalTargetPajakKabupaten::getlaporantahunan();
		$defdata = self::getalltahun();
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
					"subtitle" => "",//"Tahun ".self::tahun_mulai()." Sampai dengan ".self::tahun_akhir(),
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
	public function actionPembayaranpiutang($tahun){
		$defdata = self::getalltahun( $tahun - 1);
		$tahuns = $defdata['tahun'];
		$pembayaran = $defdata['nilai'];
		$denda = $defdata['nilai'];
		$objek = $defdata['objek'];
		$data_pembayaran = [];
		$data = TotalPembayaranPiutang::getPembayaran_piutang($tahun);
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
	public function actionPerubahanketetapan(){
		//$data = TotalTargetPajakKabupaten::model()->findAll();
		$data = TotalTargetPajakKabupaten::getlaporantahunan();

		$defdata = self::getalltahun();
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
					"subtitle" => "",//"Tahun ".self::tahun_mulai()." Sampai dengan ".self::tahun_akhir(),
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
	public function actionRealisasitahunan(){
		//$data = TotalRealisasiPajakKabupaten::model()->findAll();
		$data = TotalPembayaranPiutang::getRealisasiTahunan();
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		$defdata = self::getalltahun();
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

	//Mencari ketetapan berdasarkan tahun berjalan
	public function actionKetetapan_tahunini($tahun){
		$tahunini = $tahun;
		$Ketetapan_tahunini = TotalTargetPajakKabupaten::getlaporanketetapantahun($tahunini);
		//$this->renderPartial('_infochartahunini', array('Ketetapantahunini' => $Ketetapantahunini));
	}

	//Mencari Realisasi berdasarkan tahun berjalan
	public function actionRealisasi_tahunini($tahun){
		$tahunini = $tahun;
		$Realisasi_tahunini = TotalRealisasiPajakKabupaten::getlaporanrealisasitahun($tahunini);
	}

	//Mencari Realisasi Objek berdasarkan tahun berjalan
	public function actionRealisasiobjektahunini($tahun){
		$tahunini = $tahun;
		$Realisasiobjek_tahunini = TotalRealisasiPajakKabupaten::getlaporanrealisasiobjekpajaktahun($tahunini);
	}

	//Mencari Realisasi Pembayaran Denda berdasarkan tahun berjalan
	public function actionRealisasiPD_tahunini($tahun){
		$tahunini = $tahun;
		$actionRealisasiPD_tahunini = TotalRealisasiPajakKabupaten::getlaporanrealisasiPDtahun($tahunini);
	}

	//Mencari Realisasi Pembayaran Pokok Objek berdasarkan tahun berjalan
	public function actionRealisasiPP_tahunini($tahun){
		$tahunini = $tahun;
		$actionRealisasiPP_tahunini = TotalRealisasiPajakKabupaten::getlaporanrealisasiPPtahun($tahunini);
	}

	//Mencari total target pajak bumi berdasarkan tahun berjalan
	public function actionBumi_tahunini($tahun){
		$tahunini = $tahun;
		$Bumi_tahunini = TotalTargetPajakKabupaten::getlaporanbumitahun($tahunini);
	}

	//Mencari total target pajak bangunan berdasarkan tahun berjalan
	public function actionBangunan_tahunini($tahun){
		$tahunini = $tahun;
		$Bangunan_tahunini = TotalTargetPajakKabupaten::getlaporanbangunantahun($tahunini);
	}

	//Mencari total objek berdasarkan tahun berjalan
	public function actionObjekpajak_tahunini($tahun){
		$tahunini = $tahun;
		$Objekpajak_tahunini = TotalTargetPajakKabupaten::getlaporanobjekpajaktahun($tahunini);
	}
}
