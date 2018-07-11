<?php

class PembayaranController extends Controller
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
		return RolesMenu::actionRule('pembayaran'); 
	}
	public function actionIndex(){
		
		$model=new PembayaranForm;
		$this->render('create',array(
			'model'=>$model
		));
	}
	public function actionAdmin(){
		
		$model=new LaporanPembayaranNik('search');
		$model->unsetAttributes();  // clear any default values
		$keloption = "<option>Pilih Kelurahan</option>";
		$model->nip_perekam = Yii::app()->user->nik;
		//$model->tanggal_bayar = date('m').'-01-'.date('Y').' - '.date('m').'-'.date('d').'-'.date('Y');
		$model->tanggal_bayar = date('m').'-'.date('d').'-'.date('Y');
		$model->is_pagination = array( 'pageSize'=>10);
		if(isset($_GET['LaporanPembayaranNik'])){ 
			$model->attributes = $_GET['LaporanPembayaranNik'];
			$model->nip_perekam = Yii::app()->user->nik;
			if( (int)$model->kelurahan > 0 && (int)$model->kecamatan > 0){
				$keloption .= Yii::app()->report->kelurahanOption($model->kecamatan,$model->kelurahan);
			}
		}
		$this->render('admin',array(
			'model'=>$model,
			'keloption' => $keloption
		));
	}
	public function actionExportPdf(){
		
		$model=new LaporanPembayaranNik('search');
		$model->unsetAttributes();
		$model->nip_perekam = Yii::app()->user->nik;
		$model->tanggal_bayar = date('m').'-'.date('d').'-'.date('Y');
		
		$filename = 'Pembayaran';
		
		$model->kecamatan = $_GET['kecamatan'];
		$model->kelurahan = $_GET['kelurahan'];
		$model->is_pagination = false;
		if( isset($_GET['tanggal_bayar']) && !empty($_GET['tanggal_bayar'])){
			$model->tanggal_bayar = $_GET['tanggal_bayar'];
			$filename = 'Pembayaran '.$model->tanggal_bayar;
		}
		
		
		if( $model->kecamatan != '' ){
			$kecamatan = Yii::app()->report->kecamatan($model->kecamatan);
			$kecname = "";
			foreach( $kecamatan as $p ){
				$kecname = $p['NM_KECAMATAN'];
			}
			
			$filename .= '-Kecamatan '.$kecname;
		}
		$data = $model->search()->getData();
        $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'legal', 'fr');
		//$html2pdf->SetDisplayMode('fullpage');
        $html2pdf->WriteHTML($this->renderPartial('_exportPdf', array('data'=>$data,'tanggal_bayar'=>$model->tanggal_bayar,'nip_perekam'=>$model->nip_perekam), true));
		//$html2pdf->WriteHTML("coba");
        $html2pdf->Output();
	}
	public function actionExport(){
		$model=new LaporanPembayaranNik('search');
		$model->unsetAttributes();
		$model->nip_perekam = Yii::app()->user->nik;
		$model->tanggal_bayar = date('m').'-01-'.date('Y').' - '.date('m').'-'.date('d').'-'.date('Y');
		
		$filename = 'Pembayaran';
		
		$model->kecamatan = $_GET['kecamatan'];
		$model->kelurahan = $_GET['kelurahan'];
		if( isset($_GET['tanggal_bayar']) && !empty($_GET['tanggal_bayar'])){
			$model->tanggal_bayar = $_GET['tanggal_bayar'];
			$filename = 'Pembayaran '.$model->tanggal_bayar;
		}
		
		
		if( $model->kecamatan != '' ){
			$kecamatan = Yii::app()->report->kecamatan($model->kecamatan);
			$kecname = "";
			foreach( $kecamatan as $p ){
				$kecname = $p['NM_KECAMATAN'];
			}
			
			$filename .= '-Kecamatan '.$kecname;
		}
		$factory = new CWidgetFactory();    
        $widget = $factory->createWidget($this, 'ext.EExcelView', array(
            'dataProvider'=>$model->search(),
            'grid_mode'=>'export',
            'title'=>$filename,
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>array(
							array(
								'name'=>'NOP',
								'header'=>'NOP',
							),
							array(
								'name'=>'NM_WP',
								'header'=>'NAMA WP',
								'value' => 'Yii::app()->report->get_nama_alamat($data["NOMOR_ID"],"NM_WP")',
							),	
						    array(
								'name' => 'KETETAPAN',
								'header'=>'KETETAPAN',
								'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
							),
							array(
								'name' => 'PEMBAYARAN_DENDA',
								'header'=>'PEMBAYARAN DENDA',
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_DENDA"])',
							), 			
							array(
								'name' => 'PEMBAYARAN_POKOK',                     
								'header'=>'PEMBAYARAN POKOK',
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_POKOK"])',
							),
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),			
							array(
								'name' => 'TGL_BAYAR',                     
								'header'=>'TGL BAYAR'
							)
						),
        ));
        $widget->init();
        $widget->run();
	}
	public function actionSearchpajak(){
		$nop =  Yii::app()->request->getPost('nop');
		$nops = $nop;
		if( $nop == "" ){
			return;
		}
		$nop = Yii::app()->pembayaran->explodeNope($nop);
		if( $nop['status'] == false ){
			return;
		}
		$nop = $nop['data'];
		$kd_propinsi 	= $nop[0];
		$kd_dati2 		= $nop[1];
		$kd_kecamatan 	= $nop[2];
		$kd_kelurahan 	= $nop[3];
		$kd_blok 		= $nop[4];
		$nomor_urut 	= $nop[5];
		$kd_jenis 		= $nop[6];
		// check terlebih dahulu sudah fasum atau belum
		// check terlebih dahulu apakaj NOP SUDAH BERUBAH ? lanjutkan : buat pesan nop sudah berubah
		// CHEK NOP di table subjek pajak
		// tampilkan semua history ketetapan yang status belum bayar
		$isFasum = Yii::app()->objekPajak->isFasum( $kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis );
		if( $isFasum == true ){
			echo CJSON::encode([
					'status' => 'info',
					'msg'   => "N.O.P <b>".$nops."</b> Status Adalah 'FASUM', Hubungi Administrator untuk info lengkap",
				]);
			return;
		}
		
		$perubahanNop = new PerubahanNop;
		$perubahanNop->kd_propinsi = $kd_propinsi;
		$perubahanNop->kd_dati2 = $kd_dati2;
		$perubahanNop->kecamatan = $kd_kecamatan;
		$perubahanNop->kelurahan = $kd_kelurahan;
		$perubahanNop->nomor_urut = $nomor_urut;
		$perubahanNop->blok = $kd_blok;
		$perubahanNop->kd_jenis_op = $kd_jenis;
		$perubahanNop->is_pagination = false;
		
		$perubahanNop = $perubahanNop->search();
		$data = $perubahanNop->getData();
		if( count($data) > 0 ){
			echo CJSON::encode(['status'=>'nop_berubah','nop'=>$data[0]['NOP'],'tanggal'=>$data[0]['TGL_PERUBAHAN_NOP']]);
			return;
		}
		
		$sppt = new LaporanKetetapan;
		$sppt->propinsi = $kd_propinsi;
		$sppt->dati2 = $kd_dati2;
		$sppt->kecamatan = $kd_kecamatan;
		$sppt->kelurahan = $kd_kelurahan;
		$sppt->blok = $kd_blok;
		$sppt->no_urut = $nomor_urut;
		
		$sppt->kd_jenis_op = $kd_jenis;
		$sppt->status_bayar = '0';
		$sppt->is_pagination = false;
		$sppt->sortby = " THN_PAJAK_SPPT DESC";
		//$sppt->limit_date = Yii::app()->pembayaran->limit_date_pembayaran();
		$sppt = $sppt->search();
		$data = $sppt->getData();
		//print_r($data);
		if( count($data) > 0 ){
			$data_op = Yii::app()->objekPajak->getObjekPajak($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis);
			//print_r($data);
			echo CJSON::encode([
					'status' => 'ok',
					'infoop'   => $this->renderPartial('_infoop',['data'=>$data_op],true),
					'html'   => $this->renderPartial('_list_sppt',['data'=>$data],true)
				]);
			return;
		}else{
			echo CJSON::encode([
					'status' => 'info',
					'msg'   => "Tidak ada Piutang untuk N.O.P <b>".$nops."</b>",
				]);
		}
	}
	public function actionDobayar(){
		
		$nop =  Yii::app()->request->getPost('nop');
		$tahun =  Yii::app()->request->getPost('tahun');
		$total_bayar =  Yii::app()->request->getPost('total_bayar');
		$total_tagihan = round(Yii::app()->request->getPost('total_tagihan'));
		if( $nop == "" ){
			return;
		}
		
		$_tahuns = [];
		foreach( $tahun as $p => $val ){
			$_tahuns[$val] = $val;
		}
		$nop = Yii::app()->pembayaran->explodeNope($nop);
		if( $nop['status'] == false ){
			echo CJSON::encode(['status'=>'error','msg'=>$nop['msg']]);
			return;
		}
		
		$nop = $nop['data'];
		$kd_propinsi 	= $nop[0];
		$kd_dati2 		= $nop[1];
		$kd_kecamatan 	= $nop[2];
		$kd_kelurahan 	= $nop[3];
		$kd_blok 		= $nop[4];
		$nomor_urut 	= $nop[5];
		$kd_jenis 		= $nop[6];
		
		// check terlebih dahulu apakaj NOP SUDAH BERUBAH ? lanjutkan : buat pesan nop sudah berubah
		// CHEK NOP di table subjek pajak
		// tampilkan semua history ketetapan yang status belum bayar
		
		$perubahanNop = new PerubahanNop;
		$perubahanNop->kd_propinsi = $kd_propinsi;
		$perubahanNop->kd_dati2 = $kd_dati2;
		$perubahanNop->kecamatan = $kd_kecamatan;
		$perubahanNop->kelurahan = $kd_kelurahan;
		$perubahanNop->nomor_urut = $nomor_urut;
		$perubahanNop->blok = $kd_blok;
		$perubahanNop->kd_jenis_op = $kd_jenis;
		$perubahanNop->is_pagination = false;
		
		$perubahanNop = $perubahanNop->search();
		$data = $perubahanNop->getData();
		if( count($data) > 0 ){
			echo CJSON::encode(['status'=>'nop_berubah','nop'=>$data[0]['NOP'],'tanggal'=>$data[0]['TGL_PERUBAHAN_NOP']]);
			return;
		}
		
		$sppt = new LaporanKetetapan;
		$sppt->propinsi = $kd_propinsi;
		$sppt->dati2 = $kd_dati2;
		$sppt->kecamatan = $kd_kecamatan;
		$sppt->kelurahan = $kd_kelurahan;
		$sppt->blok = $kd_blok;
		$sppt->no_urut = $nomor_urut;
		
		$sppt->kd_jenis_op = $kd_jenis;
		$sppt->status_bayar = '0';
		$sppt->is_pagination = false;
		$sppt->sortby = " THN_PAJAK_SPPT DESC";
		$sppt->limit_date = Yii::app()->pembayaran->limit_date_pembayaran();
		$sppt = $sppt->search();
		$data = $sppt->getData();
		$tahuns = [];
		$total_ketetapan = 0;
		$total_denda = 0;
		$Rtotal_ketetapan = 0;
		$Rtotal_denda = 0;
		$bayar = [];
		if( count($data) > 0 ){
			foreach( $data as $p ){
				$ketetapan = Yii::app()->report->minimalketetapan($p['KETETAPAN'],$p['TAHUN']);
				$is_denda = Yii::app()->report->isDenda($p['TGL_JTH_TEMPO'],date("m/d/y"));
				
				$denda = ( $is_denda['status'] == true ? 0 : Yii::app()->report->getTotalDenda($ketetapan,$is_denda['denda_bulan']));
				
				$tahuns[] = $p['TAHUN'];
				$bayar[$p['TAHUN']] = [
					'tahun' => $p['TAHUN'],
					'ketetapan' => round($ketetapan),
					'denda' => round($denda),
					'KD_KANWIL' => $p['KD_KANWIL'],
					'KD_KANTOR' => $p['KD_KANTOR'],
					'KD_TP' => $p['KD_TP']
				];
			}
		}
		
		$check = Yii::app()->pembayaran->checkifSmallerExist($_tahuns,$tahuns);
		if( $check['status'] == false ){
			echo CJSON::encode(['status'=>'error','msg'=>$check['msg']]);
			return;
		}
		$tahun_bayar =  $check['msg'];
		$b_bayar = [];
		foreach( $tahun_bayar as $p => $val ){
			if(isset($bayar[$val])){
				$b_bayar[] = $bayar[$val];
				$total_ketetapan += round($bayar[$val]['ketetapan']);
				$total_denda += round($bayar[$val]['denda']);
			}
		}
		
		$Rtotal_k_denda = $total_ketetapan + $total_denda;
		//echo $Rtotal_k_denda ." ". $total_tagihan;
		//return;
		//1
		$temp_bayar_selisih = $Rtotal_k_denda - $total_tagihan;
		//if( $temp_bayar_selisih > 100 && $temp_bayar_selisih < 100 ){
		if ( !in_array($temp_bayar_selisih, range(-100,100)) ) {
			echo CJSON::encode(['status'=>'info','msg'=>"Ada Perubahan Pembayaran, Silahkan refresh data anda"]);
			return;
		}
		
		if( $Rtotal_k_denda > $total_bayar ){
			echo CJSON::encode(['status'=>'error','msg'=>"Total Bayar anda tidak mencukupi"]);
			return;
		}
		$simpan = Yii::app()->pembayaran->simpan_pembayaran($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis,$b_bayar,$total_ketetapan,$total_denda);
		if( $simpan['status'] == true ){
			echo CJSON::encode(['status'=>'info','msg'=>'<p>Pembayaran Berhasil dilakukan</p><p>Tunggu, Anda akan diarahkan kehalaman Print</p>','url'=>Yii::app()->createAbsoluteUrl('administrator/pembayaran/printinvoice/nopembayaran/'.$simpan['NOMOR_PEMBAYARAN'])]);
		}else{
			echo CJSON::encode(['status'=>'error','msg'=>'<p>Pembayaran Gagal dilakukan</p><p>Hubungi Administrator</p>']);
		}
	}
	public function actionPrintinvoice($nopembayaran){
		$dataPembayaran = Yii::app()->pembayaran->getPembayaranByNopem($nopembayaran);
		if( count($dataPembayaran) > 0 ){
			$data_op = Yii::app()->objekPajak->getObjekPajak($dataPembayaran[0]['KD_PROPINSI'],$dataPembayaran[0]['KD_DATI2'],$dataPembayaran[0]['KD_KECAMATAN'],$dataPembayaran[0]['KD_KELURAHAN'],$dataPembayaran[0]['KD_BLOK'],$dataPembayaran[0]['NO_URUT'],$dataPembayaran[0]['KD_JNS_OP']);
			
			$data = Yii::app()->pembayaran->getPrintData($nopembayaran);
			$this->render('printinvoice',array(
				'data'=>$data,
				'data_op' => $data_op,
				'dataPembayaran'=>$dataPembayaran
			));
		}
		
	}
		public function actionsalinanpembayaran()
	{		


		    $model=new PembayaranForm;
		    $model->unsetAttributes(); 

			if(isset($_GET['PembayaranForm'])){ 

		      $model->attributes = $_GET['PembayaranForm'];



		      if(!$model->validate()){
				$error = CJSON::decode(CActiveForm::validate($model));
				$msg = "";
				foreach( $error as $p ){
					$msg .= $p[0]."\n";
				}
				$response = ["status"=>'error','msg'=>$msg];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;				
			}
			
			  $nop= $_GET['PembayaranForm']['nop'];


					
					$data = Yii::app()->pembayaran->getPrintData2($nop);
					$dataPembayaran = Yii::app()->pembayaran->getPembayaranByNonop($nop);
					
					
					if( count($dataPembayaran) > 0 ){
						
						$url=Yii::app()->createUrl('administrator/pembayaran/lihatpembayaran',array(
							'nop'=>$nop,
							
						));

						$response = ["status"=>'ok-update','msg'=>'Data Ditemukan','url'=>$url];
						echo CJSON::encode($response);
						Yii::app()->end();
						return;
				}
						$response = ["status"=>'error','msg'=>'Data Tidak Ada'];
						echo CJSON::encode($response);
						Yii::app()->end();
						return;
					
		    }else{
				    	$this->render('_search2',array(
						'model'=>$model
					));
		    }
		   
	}

	public function actionlihatpembayaran($nop)
	{

			$dataPembayaran = Yii::app()->pembayaran->getPembayaranByNonop($nop);
			$data_op = Yii::app()->objekPajak->getObjekPajak($dataPembayaran[0]['KD_PROPINSI'],$dataPembayaran[0]['KD_DATI2'],$dataPembayaran[0]['KD_KECAMATAN'],$dataPembayaran[0]['KD_KELURAHAN'],$dataPembayaran[0]['KD_BLOK'],$dataPembayaran[0]['NO_URUT'],$dataPembayaran[0]['KD_JNS_OP']);
					
			$data = Yii::app()->pembayaran->getPrintData2($nop);

			$this->render('printinvoicesalinan',array(

				'data'=>$data,
				'data_op' => $data_op,
				'dataPembayaran'=>$dataPembayaran
			));
	}
}