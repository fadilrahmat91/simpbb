<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $nip_user;
	//public function getnipUser(){}
	public $breadcrumbs=array();
	
	public function addCustomComponent()
	{
		Yii::app()->setComponent('report', array(
			'class' => 'application.components.CReport'
		));
		Yii::app()->setComponent('autodata', array(
			'class' => 'application.components.CAutodata'
		));
		Yii::app()->setComponent('pembayaran', array(
			'class' => 'application.components.CPembayaran'
		));
		Yii::app()->setComponent('objekPajak', array(
			'class' => 'application.components.CobjekPajak'
		));
		Yii::app()->setComponent('realcount', array(
			'class' => 'application.components.CRealcount'
		));
		
		
	}
	function init()
    {
        parent::init();
        $this->addCustomComponent();
	}
	public function check_auth($keyNumber, $is_login = false ){
		$response = array();
		
		if(empty($keyNumber)){
			$x = ['code'=>'error','message'=>'Akun verifikasi gagal, silahkan Login Kembali'];
			array_push($response,$x);
			echo json_encode(
				$response
			);
			return false;
		}
		
		$check = LoginActivity::model()->findByAttributes(
				array('kode_login'=>$keyNumber,'status_login'=>LoginActivity::is_login,'from_pc_mobile'=>LoginActivity::login_mobile)
			);
			
		if(!empty($check)){
			if( $is_login == false ){
				return true;
			}
		}
		$getUser = User::model()->findByAttributes(
				array('nik'=>$check['nip'])
			);
		
		if( !empty($getUser) ){
			
			$model=new LoginForm;
			$model->nik = $getUser['nik'];
			$model->kata_sandi = $getUser['password'];
			
			if($model->validate() && $model->login(LoginActivity::login_not_record)){
				return true;
			}
			
		}
		
		$x = ['code'=>'error','message'=>'Akun verifikasi gagal, silahkan Login Kembali'];
			array_push($response,$x);
			echo json_encode(
				$response
			);
			return false;
	}
}