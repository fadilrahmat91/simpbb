<?php

class CrontabController extends Controller
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
		if(Yii::app()->user->roles == 'itpro'){
			return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('index','view'),
					'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('create','update','history'),
					'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('admin','delete','create','update','manageAction','saverole'),
					'users'=>array('@'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
		return array( 
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Crontab;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Crontab']))
		{

			$model->attributes=$_POST['Crontab'];
			if(!$model->validate()){
				$error = CJSON::decode(CActiveForm::validate($model));
				$msg = "";
				foreach( $error as $p ){
					$msg .= $p[0]."\n";
				}
				$response = ["status"=>'error','msg'=>$msg];
				echo CJSON::encode($response);exit;
				Yii::app()->end();
				return;				
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Crontab']))
		{
			$model->attributes=$_POST['Crontab'];
			if($model->save())
				if($model->save()){
				$response = ["status"=>'ok-update','msg'=>'Ubah User Berhasil'];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;
			}
				$this->redirect(array('view','id'=>$model->id));
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
	public function actionDelete($id,$code)
	{
		$this->loadModel($id)->delete();
		$model=CrontabHistory::model()->deleteAll("code='$code'");
		

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Crontab');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new Crontab('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Crontab']))
			$model->attributes=$_GET['Crontab'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionHistory($code)
	{
		$model=new CrontabHistory('search');
		// $var=CrontabHistory::model()->findAllByAttributes(array('code'=>$code));
		// print_r($var);exit;
		$model->unsetAttributes(); 
		if(isset($_GET['CrontabHistory']))
			$model->attributes=$_GET['CrontabHistory'];

			$model->code=$code;
		$this->render('history',array(
			'model'=>$model,
			
		));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Crontab the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Crontab::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	/**
	 * Performs the AJAX validation.
	 * @param Crontab $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='crontab-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
