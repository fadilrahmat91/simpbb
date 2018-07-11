<?php

class PiutangTahunanController extends Controller
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
		return RolesMenu::actionRule('piutangTahunan'); 
	}
	public function actionIndex(){
		
		$model=new LaporanPiutang;
		$model->unsetAttributes();  // clear any default values
		$model->tahun = date("Y");
		$model->is_pagination = array( 'pageSize'=>10);
		$model->group_by = LaporanKetetapan::ORDER_TAHUN;
		$keloption = "<option>Pilih Kelurahan</option>";
		
		if(isset($_GET['LaporanPiutang'])){ 
			$model->attributes = $_GET['LaporanPiutang'];
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
		
		$model=new LaporanPiutang;
		$model->unsetAttributes();
		$model->tahun = @$_GET['tahun'];
		$model->kecamatan = @$_GET['kecamatan'];
		$model->kelurahan = @$_GET['kelurahan'];
		$model->periode = @$_GET['periode'];
		$model->group_by = @$_GET['group_by'];
		$model->tanggal_terbit_sppt = @$_GET['tanggal_terbit_sppt'];
		$data = $model->searchRekapitulasi()->getData();
		
		//$model->status = $_GET['status'];
		$filename = 'PIUTANG ('.$model->tahun.')';
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
            'title'=>'PIUTANG ('.$model->tahun.')',
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>LaporanPiutang::_order($model->group_by,'rGrid')
        ));
        $widget->init();
        $widget->run();
	}
}
