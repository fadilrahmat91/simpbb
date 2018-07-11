<?php

/**
 * This is the model class for table "{{kecamatan_simpatda}}".
 *
 * The followings are the available columns in table '{{kecamatan_simpatda}}':
 * @property integer $kdkecamatan
 * @property string $nama_kecamatan
 */
class KecamatanSimpatda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{kecamatan_simpatda}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kdkecamatan', 'required'),
			array('kdkecamatan', 'numerical', 'integerOnly'=>true),
			array('nama_kecamatan', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('kdkecamatan, nama_kecamatan', 'safe', 'on'=>'search'),
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
			'kdkecamatan' => 'Kdkecamatan',
			'nama_kecamatan' => 'Nama Kecamatan',
		);
	}
	public function reArrangeKecamatan(){
		$jenis_pajak = KecamatanSimpatda::model()->findAll();
		$arrays = [];
		$values = [];
		if( !empty($jenis_pajak)){
			foreach( $jenis_pajak as $p ){
				$arrays[$p['kdkecamatan']] = $p['nama_kecamatan'];
				$values[$p['kdkecamatan']] = 0;
			}
			return ['kecamatan'=>$arrays,'values'=>$values];
		}
		return '';
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

		$criteria->compare('kdkecamatan',$this->kdkecamatan);
		$criteria->compare('nama_kecamatan',$this->nama_kecamatan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KecamatanSimpatda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
