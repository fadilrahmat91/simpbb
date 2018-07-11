<?php

/**
 * This is the model class for table "{{realisasi_tahunan_simpatda}}".
 *
 * The followings are the available columns in table '{{realisasi_tahunan_simpatda}}':
 * @property string $id
 * @property integer $kodejenispajak
 * @property string $tahun
 * @property string $pajakterutang
 * @property string $denda
 * @property string $sanksi_adm
 */
class RealisasiTahunanSimpatda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{realisasi_tahunan_simpatda}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kodejenispajak', 'numerical', 'integerOnly'=>true),
			array('tahun', 'length', 'max'=>4),
			array('pajakterutang, denda, sanksi_adm', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kodejenispajak, tahun, pajakterutang, denda, sanksi_adm', 'safe', 'on'=>'search'),
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
			'kodejenispajak' => 'Kodejenispajak',
			'tahun' => 'Tahun',
			'pajakterutang' => 'Pajakterutang',
			'denda' => 'Denda',
			'sanksi_adm' => 'Sanksi Adm',
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
		$criteria->compare('kodejenispajak',$this->kodejenispajak);
		$criteria->compare('tahun',$this->tahun,true);
		$criteria->compare('pajakterutang',$this->pajakterutang,true);
		$criteria->compare('denda',$this->denda,true);
		$criteria->compare('sanksi_adm',$this->sanksi_adm,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RealisasiTahunanSimpatda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
