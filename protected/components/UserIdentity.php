<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	
	public function authenticate()
	{
		$user=User::model()->find('LOWER(nik)=?',array(strtolower($this->username)));
		
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->setState('id', trim($user->id));
			$this->setState('nik', trim($user->nik));
			$this->setState('roles', trim($user->userlevel));
			$this->setState('nama_lengkap', $user->nama_lengkap);
			$this->_id=$user->id;
			$this->username=$user->username;
			
			//get user role url;
			$UserRole = UserRole::model()->find('kode=:p1',array(
						':p1'=> $user->userlevel
			));
			//echo $UserRole->alamat_utama;
			//$userRole = UserRole::model()->find();
			$this->setState('homeurl', $UserRole->alamat_utama);
			$this->errorCode=self::ERROR_NONE;
		}
		//echo $this->errorCode;
		//return $this->errorCode==self::ERROR_NONE;
		return $this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}