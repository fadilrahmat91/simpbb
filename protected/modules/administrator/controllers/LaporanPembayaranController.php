<?php

class LaporanPembayaranController extends Controller
{
	public $layout='//layouts/column2'; // 
	private function tgl_bayar(){
		return "01-01-".date('Y')." - ".date('m-d-Y');
	}
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request edit
		);
	}
	public function accessRules()
	{
		return RolesMenu::actionRule('laporanPembayaran'); 
	}
	public function actionIndex(){
		
		$model=new LaporanPembayaran('search');
		$model->unsetAttributes();  // clear any default values
		$keloption = "<option>Pilih Kelurahan</option>";
		$model->tanggal_bayar = self::tgl_bayar();
		$model->is_pagination = array( 'pageSize'=>10);
		if(isset($_GET['LaporanPembayaran'])){ 
			$model->attributes = $_GET['LaporanPembayaran'];
			if( $model->tanggal_bayar == "" ){
				$model->tanggal_bayar = self::tgl_bayar(); 
			}
			
		}
		if( Yii::app()->request->isAjaxRequest ){
			$this->renderPartial('_rgridview', array('model'=>$model),false,true);
		}else{
			if(isset($_GET['LaporanPembayaran'])){ 
				if( (int)$model->kelurahan > 0 && (int)$model->kecamatan > 0){
					$keloption .= Yii::app()->report->kelurahanOption($model->kecamatan,$model->kelurahan);
				}
			}
			$this->render('admin',array(
				'model'=>$model,
				'keloption' => $keloption
			));
		}
		
	}
	public function actionExport(){
		$model=new LaporanPembayaran('search');
		$model->unsetAttributes();
		$model->tahun = @$_GET['tahun'];
		$model->kecamatan = @$_GET['kecamatan'];
		$model->kelurahan = @$_GET['kelurahan'];
		$model->tanggal_bayar = @$_GET['tanggal_bayar'];
		$model->nip_perekam = @$_GET['nip_perekam'];
		$model->tanggal_terbit_sppt = @$_GET['tanggal_terbit_sppt'];
		$filename = 'Pembayaran';
		if( !empty($model->tahun)){
			if( is_array($model->tahun)){
				$filename = 'Pembayaran '.implode("-",$model->tahun);
			}
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
                	//'promotioncode',
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
								'name'=>'JALAN_WP',
								'header'=>'ALAMAT WP',
								'value' =>'Yii::app()->report->get_nama_alamat($data["NOMOR_ID"],"JALAN_WP")',
							),
							
							array(
								'header'=>'KECAMATAN',
								'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
							),
							array(
								'name' => 'KETETAPAN',
								'header'=>'KETETAPAN',				
							),
							 			
							array(
								'name' => 'PEMBAYARAN_POKOK',                     
								'header'=>'PEMBAYARAN POKOK'
							),
							array(
								'name' => 'PEMBAYARAN_DENDA',
								'header'=>'PEMBAYARAN DENDA',				
							),
							array(
								'name' => 'LEBIH_BAYAR',
								'header'=>'LEBIH BAYAR',				
							),
							array(
								'name' => 'KURANG_BAYAR',
								'header'=>'KURANG BAYAR',				
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
}