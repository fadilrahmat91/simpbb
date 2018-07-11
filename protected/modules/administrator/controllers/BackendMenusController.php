<?php

class BackendMenusController extends Controller
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
	/*public function accessRules()
	{
		return RolesMenu::actionRule('backendMenus'); 
	}
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
	public function actionmanageAction($id){
		$details = MenusAction::model()->findAllByAttributes(array('menu_id'=>$id));
		
		if( Yii::app()->request->isAjaxRequest ){
			
			if( isset($_POST['MenusAction']) ){
				$action =  (isset($_POST['MenusAction']['action_aksi']) ? $_POST['MenusAction']['action_aksi'] : '');
				if( $action == ""){
					return;
			
				}
				if( $_POST['id_action'] > 0 ){
					$model = MenusAction::model()->findByPk($_POST['id_action']);
				}
				else{
					$model = new MenusAction;
				}
				$model->attributes = $_POST['MenusAction'];
				$model->menu_id = $id;
				if($model->save()){
					if( $_POST['id_action'] > 0 ){
						// check jika aksi sudah terdaftar di dalam list akses user tujuannya untuk adminitssss
						/*$model_access = RolesMenu::model()->find('id_details_app=:id_details_app', array(':id_details_app'=>$_POST['id_details']));
						if( !empty($model_access)){
							$model_access->action = $model->action;
							$model_access->action_type = $model->action_type;
							$model_access->save();
						}*/
					}
					
					$details = MenusAction::model()->findAllByAttributes(array('menu_id'=>$id));
					$html = $this->renderPartial('_list_item',array(
						'details'=>$details,
					),true);
					$response = ["status"=>'ok','msg'=>"Pengaturan aksi berhasil",'html'=>$html];
					echo CJSON::encode($response);
					return;
				}
			}
			$response = ["status"=>'error','msg'=>"Update data error"];
			echo CJSON::encode($response);
			return;
			
		}else{
		
			$model = new MenusAction;
			$this->render('detail_action',array(
				'model'=>$model,'details'=>$details,'id'=>$id,
			));
		}
	}
	public function actionCreate()
	{
		$model=new BackendMenus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BackendMenus']))
		{
			$model->attributes=$_POST['BackendMenus'];
			
			if(!$model->validate()){
				$error = CJSON::decode(CActiveForm::validate($model));
				$msg = "";
				foreach( $error as $p ){
					$msg .= $p[0]."\n";
				}
				$response = ["status"=>'error','msg'=>$msg];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;				
			}
			
			if($model->save()){
				if( $model->parent_menu > 0 ){
					$allows_auto = BackendMenus::getAllowName();
					foreach( $allows_auto as $action => $action_type ){
						$MenusAction = new MenusAction;
						$MenusAction->action_name = $action;
						$MenusAction->action_aksi = $action_type;
						$MenusAction->menu_id = $model->id;
						$MenusAction->save();
					}
					$response = ["status"=>'ok-update','msg'=>'Pengaturan menu berhasil','redirect'=>Yii::app()->createAbsoluteUrl('administrator/backendMenus/manageAction/id/'.$model->id)];
					echo CJSON::encode($response);
					Yii::app()->end();
					return;
				}
				$response = ["status"=>'ok','msg'=>'Pengaturan menu Utama Berhasil'];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;
			}
			$response = ["status"=>'error','msg'=>'Pengaturan menu gagal'];
			echo CJSON::encode($response);
			Yii::app()->end();
			return;
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

		if(isset($_POST['BackendMenus']))
		{
			$model->attributes=$_POST['BackendMenus'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
		$model=new BackendMenus('search');
		$model->unsetAttributes();  // clear any default values
		
		
		if(isset($_GET['BackendMenus']))
			$model->attributes=$_GET['BackendMenus'];
		if( (int) $model->parent_menu <= 0 ){

			$model->parent_menu = ' > 0';
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BackendMenus the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BackendMenus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BackendMenus $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='backend-menus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
