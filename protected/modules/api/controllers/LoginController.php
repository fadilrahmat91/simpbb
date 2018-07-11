<?php

class LoginController extends Controller
{
	public function actionLogin()
	{
		$nip = @$_POST['nip'];
		$password = @$_POST['password'];
		
		$model=new LoginForm;
		$model->nik = $nip;
		$model->kata_sandi = $password;
		$response = array();
		if($model->validate() && $model->login(LoginActivity::login_mobile)){
			$x = ["status"=>'ok','message'=>'Login Sukses','nama'=> @Yii::app()->user->nama_lengkap,'keyNumber'=>$model->key_number];
			array_push($response,$x);
			echo CJSON::encode($response);
			return;
		}else{
			//Login Fail
			$errors = "";
			$error = $model->getErrors();
			foreach( $error as $p ){
				$errors .= $p[0];
			}
			$x = ["status"=>'error','message'=>$errors];
			array_push($response,$x);
			echo CJSON::encode($response);
			return;
			
		}
	}
}