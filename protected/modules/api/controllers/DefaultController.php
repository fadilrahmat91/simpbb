<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	echo CJSON::encode(['status'=>'error-system','msg'=>$error['message']]);
	    }
	}
}