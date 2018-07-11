<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $nik;
	public $kata_sandi;
	public $rememberMe;
	public $key_number;
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('nik, kata_sandi', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('kata_sandi', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 * @param string $attribute the name of the attribute to be validated.
	 * @param array $params additional parameters passed with rule when being executed.
	 */
	public function authenticate($attribute,$params)
	{
		$this->_identity=new UserIdentity($this->nik,$this->kata_sandi);
		//echo $this->_identity->authenticate();
		
		$useridentity = $this->_identity->authenticate();
		if($useridentity == '1' || $useridentity == '2'){
			$this->addError('kata_sandi','NIP atau Kata sandi tidak ditemukan');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login($from = "")
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->nik,$this->kata_sandi);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			if( $from == ""){
				$from = LoginActivity::login_pc;
			}
			if( $from != LoginActivity::login_not_record){
				$model1 = LoginActivity::model()->updateAll(array('status_login'=>LoginActivity::not_login),'nip=:user_id and from_pc_mobile=:from_pc_mobile',array(':user_id'=>$this->nik,':from_pc_mobile'=>$from));
				$random = Yii::app()->pembayaran->getRandomString(30);
				$LoginActivity = new LoginActivity;
				$LoginActivity->nip = $this->nik;
				$LoginActivity->status_login = LoginActivity::is_login;
				$LoginActivity->from_pc_mobile = $from;
				$LoginActivity->kode_login = $random;
				$LoginActivity->ipaddress = Yii::app()->report->getRealIp();
				$LoginActivity->save();
				$this->key_number = $random;
			}
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
	
}
