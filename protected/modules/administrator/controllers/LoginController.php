<?php

class LoginController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/login_layout';

	/**
	 * @return array action filters
	 */
	

	public function actionIndex()
	{
		$this->layout = 'login_page';
		$model=new LoginForm;
		if(isset($_POST['LoginForm']))
		{
			
			$model->attributes=$_POST['LoginForm'];
			
			if($model->validate() && $model->login()){
				/*echo @Yii::app()->user->roles;
				print_r(Yii::app()->session);
				print_r(Yii::app()->user);*/
				$homeurl = @Yii::app()->user->homeurl;
				$response = ["status"=>'ok','msg'=>'Login Sukses','homeurl'=> Yii::app()->createAbsoluteUrl($homeurl)];
				echo CJSON::encode($response);
				return;
			}else{
				//Login Fail
				$errors = "";
				$error = $model->getErrors();
				foreach( $error as $p ){
					$errors .= $p[0];
				}
				$response = ["status"=>'error','msg'=>$errors];
				echo CJSON::encode($response);
				
			}
				//$this->redirect(Yii::app()->user->returnUrl);
			return;
		}
		$this->render('index',['model'=>$model]);
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
