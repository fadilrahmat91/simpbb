<?php

/**
 * This is the model class for table "{{login_activity}}".
 *
 * The followings are the available columns in table '{{login_activity}}':
 * @property string $id
 * @property string $user_id
 * @property string $ipaddress
 * @property string $kode_login
 * @property string $from_pc_mobile
 * @property string $tanggal_login
 */
class LoginActivity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	const is_login = 1;
	const not_login = 0;
	const login_pc = 1;
	const login_mobile = 2;
	const login_not_record = 3;
	public function tableName()
	{
		return '{{login_activity}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nip', 'length', 'max'=>50),
			array('ipaddress, kode_login', 'length', 'max'=>255),
			array('from_pc_mobile,status_login', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, ipaddress, kode_login, from_pc_mobile,status_login, tanggal_login', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'ipaddress' => 'Ipaddress',
			'kode_login' => 'Kode Login',
			'from_pc_mobile' => 'From Pc Mobile',
			'tanggal_login' => 'Tanggal Login',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('ipaddress',$this->ipaddress,true);
		$criteria->compare('kode_login',$this->kode_login,true);
		$criteria->compare('from_pc_mobile',$this->from_pc_mobile,true);
		$criteria->compare('tanggal_login',$this->tanggal_login,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LoginActivity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
