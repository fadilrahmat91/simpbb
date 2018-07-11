<?php

/**
 * This is the model class for table "{{hubungikami}}".
 *
 * The followings are the available columns in table '{{hubungikami}}':
 * @property string $id
 * @property string $nama
 * @property string $email
 * @property string $no_telp
 * @property string $pertanyaan
 * @property string $jawaban
 * @property string $status_jawab
 * @property string $tanggal_jawab
 * @property string $dijawab_oleh
 * @property string $tanggal_kirim
 */
class Hubungikami extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{hubungikami}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama,email,no_telp,status_jawab', 'required'),
			array('nama', 'length', 'max'=>255),
			array('email', 'length', 'max'=>200),
			array('no_telp, dijawab_oleh', 'length', 'max'=>20),
			array('status_jawab', 'length', 'max'=>1),
			array('pertanyaan, jawaban, tanggal_jawab', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, email, no_telp, pertanyaan, jawaban, status_jawab, tanggal_jawab, dijawab_oleh, tanggal_kirim', 'safe', 'on'=>'search'),
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
			'nama' => 'Nama',
			'email' => 'Email',
			'no_telp' => 'No Telp',
			'pertanyaan' => 'Pertanyaan',
			'jawaban' => 'Jawaban',
			'status_jawab' => 'Status Jawab',
			'tanggal_jawab' => 'Tanggal Jawab',
			'dijawab_oleh' => 'Dijawab Oleh',
			'tanggal_kirim' => 'Tanggal Kirim',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('no_telp',$this->no_telp,true);
		$criteria->compare('pertanyaan',$this->pertanyaan,true);
		$criteria->compare('jawaban',$this->jawaban,true);
		$criteria->compare('status_jawab',$this->status_jawab,true);
		$criteria->compare('tanggal_jawab',$this->tanggal_jawab,true);
		$criteria->compare('dijawab_oleh',$this->dijawab_oleh,true);
		$criteria->compare('tanggal_kirim',$this->tanggal_kirim,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function status( $status = "" )
	{
		$_status = [];
		$_status[0] = 'Belum Di Jawab';
		$_status[1] = 'Sudah Di Jawab';
		if( $status != "" ){
			return $_status[$status];
		}
		return $_status;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Hubungikami the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
