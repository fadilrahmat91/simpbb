<?php

class ProsesAbsenController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionCreate()
	{
		// $data= LaporanEvaluasi::SiswabyJurusan(2);
		// print_r($data);exit;
		 $model=new ProsesAbsen;
	    $model->unsetAttributes(); 
	   
	   
	    $nop="";
	    if(isset($_POST['jurusan'])){
	    $jrs = $_POST['jurusan'];

	      $model->jurusan= $jrs;
	      
	       $this->render('index',array(
	        'model'=>$model
	      ));
	       return;

	     }
	      

	      $this->render('index',array(
	        'model'=>$model
	      ));
	}


	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}