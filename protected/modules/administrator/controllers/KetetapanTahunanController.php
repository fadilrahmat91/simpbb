<?php

class KetetapanTahunanController extends Controller
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
		return RolesMenu::actionRule('ketetapanTahunan'); 
	}
	public function actionIndex(){

		
		$model=new LaporanKetetapan;
		$model->unsetAttributes();  // clear any default values
		$model->tahun = date("Y");
		$model->is_pagination = array( 'pageSize'=>10);
		$model->group_by = LaporanKetetapan::ORDER_TAHUN;
		$keloption = "<option>Pilih Kelurahan</option>";
		
		if(isset($_GET['LaporanKetetapan'])){ 
			// print_r($_GET['LaporanKetetapan']);exit;
			$model->attributes = $_GET['LaporanKetetapan'];
			if( (int)$model->kelurahan > 0 && (int)$model->kecamatan > 0){
				$keloption .= Yii::app()->report->kelurahanOption($model->kecamatan,$model->kelurahan);
			}
		}
		if( Yii::app()->request->isAjaxRequest ){
			$this->renderPartial('_rgridview', array('model'=>$model),false,true);
		}else{
			$this->render('admin',array(
				'model'=>$model,
				'keloption' => $keloption
			));
		}
	}
	public function actionExport(){
		$model=new LaporanKetetapan;
		$model->unsetAttributes();
		$model->tahun = @$_GET['tahun'];
		$model->kecamatan = @$_GET['kecamatan'];
		$model->kelurahan = @$_GET['kelurahan'];
		$model->status_bayar = @$_GET['status_bayar'];
		$model->tanggal_terbit = @$_GET['tanggal_terbit'];
		$model->tanggal_jatuh_tempo = @$_GET['tanggal_jatuh_tempo'];
		$model->group_by = @$_GET['group_by'];
		//$model->status = $_GET['status'];
		$filename = 'Ketetapan ('.$model->tahun.')';
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
            'dataProvider'=>$model->searchRekapitulasi(),
            'grid_mode'=>'export',
            'title'=>'Ketetapan ('.$model->tahun.')',
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>LaporanKetetapan::_order($model->group_by,'rGrid'),
        ));
        $widget->init();
        $widget->run();
	}
}
