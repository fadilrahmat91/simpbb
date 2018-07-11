<?php

class RealisasiTahunanController extends Controller
{
	public $layout='//layouts/column2';
	private function tgl_bayar(){
		return "01-01-".date('Y')." - ".date('m-d-Y');
	}
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return RolesMenu::actionRule('realisasiTahunan'); 
	}
	public function actionIndex(){
		
		// $data = RealisasiTahunan::_order('1','group');
		// echo $data;exit;
		$model=new RealisasiTahunan;
		$model->unsetAttributes();  // clear any default values
		$keloption = "<option>Pilih Kelurahan</option>";
		//$model->tahun = [date('Y')];
		$model->tanggal_bayar = self::tgl_bayar();
		$model->group_by = RealisasiTahunan::ORDER_TAHUN;
		$model->is_pagination = array( 'pageSize'=>10);
		if(isset($_GET['RealisasiTahunan'])){ 
			// print_r($_GET['RealisasiTahunan']);exit;
			$model->attributes = $_GET['RealisasiTahunan'];
		}
		if( Yii::app()->request->isAjaxRequest ){
			$this->renderPartial('_rGridView', array('model'=>$model),false,true);
		}else{
			if(isset($_GET['RealisasiTahunan'])){ 
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
		$model=new RealisasiTahunan('search');
		$model->unsetAttributes();
		$model->tahun = @$_GET['tahun'];
		$model->kecamatan = @$_GET['kecamatan'];
		$model->kelurahan = @$_GET['kelurahan'];
		$model->tanggal_bayar = @$_GET['tanggal_bayar'];
		$model->group_by = @$_GET['group_by'];
		$model->tanggal_terbit_sppt = @$_GET['tanggal_terbit_sppt'];
		//$model->status = $_GET['status'];
		$filename = 'Laporan Realisasi Tahunan ';
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
            'title'=>'Laporan Realisasi Tahunan ',
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>RealisasiTahunan::_order($model->group_by,'rGrid'),
        ));
        $widget->init();
        $widget->run();
	}
}