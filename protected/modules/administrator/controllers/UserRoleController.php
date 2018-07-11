<?php

class UserRoleController extends Controller
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
					'actions'=>array('create','update'),
					'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('admin','delete','create','update','menuAkses','saverole'),
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
	
	public function actionmenuAkses($id){
		// $id = id role
		//get role_name kode
		$roles = UserRole::model()->findByPk($id );
		
		if( !empty($roles)){
			
			$access = RolesMenu::roles_menu_action(RolesMenu::model()->findAll( 'role_kode=:role_kode', array(':role_kode'=>$roles->kode) ));
			$this->render('menuakses',array(
					'id' => $id,
					'access'=>$access
				));
		}
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionSaverole($id){
		$roles = UserRole::model()->findByPk($id );
		if( !empty($roles)){
			//if ( isset($_POST['c_nama_datas']) || isset($param['f_module'])){
			$data = @$_POST['c_nama_datas'];
			RolesMenu::model()->deleteAll(
				'role_kode = :role_kode',
				array(':role_kode' => $roles->kode)
			);
			$controllers_array = array();
			
			foreach( $data as $p ){
				list( $id_controller, $action_type ) = explode("-", $p);
				//if( !in_array($id_controller, $controllers_array)){
					$controllers_array[] = $id_controller;
					
					$role_menus = new RolesMenu;
					$role_menus->role_kode = $roles->kode;
					$role_menus->menu_id = $id_controller;
					$role_menus->action_type = $action_type;
					$role_menus->save();
				//}
			}
			echo CJSON::encode( array('status'=>'ok','msg'=>'Sukses Ubah data'));
			return;
		}
		echo CJSON::encode( array('status'=>'error','msg'=>'Gagal Ubah data'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserRole;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserRole']))
		{
			$model->attributes=$_POST['UserRole'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionView($id){
		
		 $this->redirect(array('admin','id'=>$id));
		

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
				$model=$this->loadModel($id);

		if(isset($_POST['UserRole']))
		{
			$model->attributes=$_POST['UserRole'];
			if($model->save())
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
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model = UserRole::model()->findAll();
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserRole the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserRole::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserRole $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-role-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
