<?php

class DataRingkasController extends Controller
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
		return RolesMenu::actionRule('dataRingkas'); 
	}
	public function actionIndex(){
		
		$model=new DataRingkasan('search');
		$model->unsetAttributes();  // clear any default values
		$model->is_pagination = array( 'pageSize'=>10);
		
		$keloption = "<option>Pilih Kecamatan</option>";
		
		
		if(isset($_GET['DataRingkasan'])){ 
			$model->attributes = $_GET['DataRingkasan'];
			if( (int)$model->kelurahan > 0 && (int)$model->kecamatan > 0){
				$keloption = Yii::app()->report->kelurahanOption($model->kecamatan,$model->kelurahan);
			}
		}
		if( Yii::app()->request->isAjaxRequest ){
			$this->renderPartial('_rgriddata', array('model'=>$model),false,true);
		}else{
			$this->render('admin',array(
				'model'=>$model,
				'keloption'=>$keloption
			));
		}
		
	}
}
