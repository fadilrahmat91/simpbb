<?php

class DefaultController extends Controller
{
	public $layout='//layouts/column2';
	public function actionIndex()
	{
		if( !empty(Yii::app()->user->roles )){
			$url = Yii::app()->user->homeurl;
			$this->redirect(Yii::app()->createAbsoluteUrl($url));
		}else{
			$this->redirect('administrator/login');
		}
	}
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		//echo $error['message'];
				echo CJSON::encode(['status'=>'error-system','msg'=>$error['message']]);
	    	else
	        	$this->render('error', $error);
	    }
	}
}
