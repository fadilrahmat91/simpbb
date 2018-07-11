<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $userlevel
 * @property string $nik
 * @property string $nama_lengkap
 * @property string $tanggal_daftar
 * @property string $tanggal_ubah
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tanggal_daftar,username,nik,nama_lengkap,password', 'required'),
			array('username, nik, nama_lengkap', 'length', 'max'=>255),
			array('userlevel', 'length', 'max'=>5),
			array('tanggal_ubah', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, userlevel, nik, nama_lengkap, tanggal_daftar, tanggal_ubah', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'userlevel' => 'Userlevel',
			'nik' => 'NIK',
			'password' => 'Kata Sandi',
			'nama_lengkap' => 'Nama Lengkap',
			'tanggal_daftar' => 'Tanggal Daftar',
			'tanggal_ubah' => 'Tanggal Ubah',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('userlevel',$this->userlevel,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('nama_lengkap',$this->nama_lengkap,true);
		$criteria->compare('tanggal_daftar',$this->tanggal_daftar,true);
		$criteria->compare('tanggal_ubah',$this->tanggal_ubah,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function validatePassword($pass) {
        return $pass === $this->password;
    }
    public function get_user_by_id($id,$need){
    	//$data["dijawab_oleh"])
    	$user = User::model()->findByAttributes(array("id"=>$id));
    		if( !empty($user)){
    			return $user[$need];
    		}else{
    			return "";
    		}
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
