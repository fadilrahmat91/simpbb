<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return RolesMenu::actionRule('user'); 
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			$model->username = $model->nik;
			$model->tanggal_daftar =  new CDbExpression('NOW()');
			if(!$model->validate()){
				$error = CJSON::decode(CActiveForm::validate($model));
				$msg = "";
				foreach( $error as $p ){
					$msg .= $p[0]."\n";
				}
				$response = ["status"=>'error-validation','msg'=>$msg];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;				
			}
			
			$checknik = User::model()->findAllByAttributes(array('nik'=>$model->nik));
			if( !empty($checknik)){
				$response = ["status"=>'error-validation','msg'=>'NIK Sudah ditemukan'];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;	
			}
			
			if($model->save()){
				$response = ["status"=>'ok','msg'=>'Penambahan User Berhasil'];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->username = $model->userlevel;
			$model->nik = $model->nik;
			$model->tanggal_ubah =  new CDbExpression('NOW()');
			if(!$model->validate()){
				$error = CJSON::decode(CActiveForm::validate($model));
				$msg = "";
				foreach( $error as $p ){
					$msg .= $p[0]."\n";
				}
				$response = ["status"=>'error-validation','msg'=>$msg];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;				
			}
			if($model->save()){
				$response = ["status"=>'ok-update','msg'=>'Ubah User Berhasil'];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
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
