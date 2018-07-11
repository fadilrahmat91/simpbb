<?php

class KontenController extends Controller
{
	public function actionIndex()
	{
	
  	$sql=KontenDetail::getkontendetail();

    $this->render('index', array(
   	 'sql' => $sql
         
    ));
		
	}
	public function actionBulan(){
		//echo Yii::app()->request->getParams('id');

		$url = Yii::app()->request->url;
		$params=end(explode("/", $url));
		$model= KontenDetail::getbulan($params);
		$this->render('bulan',array(
			'model'=>$model
		));


	}
	public function actionView(){

		$url = Yii::app()->request->url;
		$params=end(explode("/", $url));
		$model= KontenDetail::getslug($params);
		$this->render('view',array(
			'model'=>$model
		));
	}

}