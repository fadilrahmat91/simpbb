<?php

class PetaSimalungunController extends Controller
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
		return RolesMenu::actionRule('petaSimalungun'); 
	}
	public function actionIndex(){
		
		$this->render('index',array(
		));
	}
	public function actionGetData(){
		$nop =  @$_GET['nop'];
		
		$nops = $nop;
		$params = [];
		if( isset($_GET['nop']) && $_GET['nop'] == "" ){
			return;
		}
		//echo $nop;
		if( $nop != "" ){
			
			$nop = Yii::app()->pembayaran->explodeNope($nop,false);
			
			$nop = $nop['data'];
			$params['kd_propinsi'] 	= $nop[0];
			$params['kd_dati2'] 	= $nop[1];
			$params['kd_kecamatan'] = $nop[2];
			$params['kd_kelurahan'] = $nop[3];
			$params['kd_blok'] 		= $nop[4];
			$params['nomor_urut'] 	= $nop[5];
			$params['kd_jenis'] 	= $nop[6];
		
		}
		$data = Yii::app()->objekPajak->getObjekPajakMarker( $params );
		
		//if( count($data) > 0 ){
			$return = array();
			$return['status'] = 'ok';
			$return['data'] = $data;
			$return['jumdata'] = count($data);
			echo CJSON::encode($return,JSON_NUMERIC_CHECK);
		//}
	}
	public function actionGetInfo(){
		
		$nop =  @$_GET['nop'];
		
		$nops = $nop;
		$params = [];
		if( isset($_GET['nop']) && $_GET['nop'] == "" ){
			return;
		}
	
		$nop = Yii::app()->pembayaran->explodeNope($nop);
		
		$nop = $nop['data'];
		$params['kd_propinsi'] 	= $nop[0];
		$params['kd_dati2'] 	= $nop[1];
		$params['kd_kecamatan'] = $nop[2];
		$params['kd_kelurahan'] = $nop[3];
		$params['kd_blok'] 		= $nop[4];
		$params['nomor_urut'] 	= $nop[5];
		$params['kd_jenis'] 	= $nop[6];
		
		$model=new DataRingkasan('search');
		$model->unsetAttributes();  // clear any default values
		$model->is_pagination = false;
		$model->kecamatan = $params['kd_kecamatan'];
		$model->kelurahan = $params['kd_kelurahan'];
		$model->blok = $params['kd_blok'];
		$model->nomor_urut = $params['nomor_urut'];
		$model->kd_jenis = $params['kd_jenis'];
		
		$data = $model->search();
		$data = $data->getData();
		$return = array();
		$return['status'] = 'ok';
		$return['data'] = (isset($data[0]) ?$data[0] : []);
		echo CJSON::encode($return,JSON_NUMERIC_CHECK);
	}
}