<?php

class PendataanObjekPajakController extends Controller
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
		return RolesMenu::actionRule('pendataanObjekPajak'); 
	}
	public function actionIndex(){
		$model = new PendataanObjekPajak;
		$this->render('create', ['model'=>$model]);
	}
	public function actionHandling_page2($jenis_formulir){
		if( $jenis_formulir == PendataanObjekPajak::J_TANAH ){
			echo CJSON::encode([
					'status' => 'ok',
					'page2'   => $this->renderPartial('_spop_tanah',[],true)
				]);
			return;
		}
	}
	public function actionDatasubjekpajak(){
		
		$ktp =  Yii::app()->request->getPost('no_ktp');
		 $data = Yii::app()->objekPajak->getktp('120701000400501520');
		 // print_r($data);
		
		 $this->renderPartial('data_subjek_pajak',array(
			'data'=>$data));
	}
}
