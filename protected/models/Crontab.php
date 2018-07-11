<?php

/**
 * This is the model class for table "{{crontab}}".
 *
 * The followings are the available columns in table '{{crontab}}':
 * @property string $id
 * @property string $code
 * @property string $nama_crontab
 * @property string $url
 * @property string $last_running
 */
class Crontab extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	const RUNTARGETKABUPATEN 	= 'runtargetkabupaten';
	const RUNREALISASIKABUPATEN = 'runrealisasikabupaten';
	const RUNREALISASIKELURAHAN = 'runrealisasikelurahan';
	const RUNTARGETKELURAHAN 	= 'runtargetkelurahan';
	const RUNPEMBAYARANPIUTANG 	= 'runpembayaranpiutang';
	const RUNJENISPAJAKSIMPATDA 	= 'rungetjenisOpSimalungun';
	const RUNREALISASIPAJAKSIMPATDA 	= 'getdatapajak';
	const RUNKECAMATANSIMPATDA 	= 'getdatakecamatan';
	const RUNREALISASIKECAMATANSIMPATDA = 'getDataPajakKecamatan';
	const KETETAPANPAJAKKECAMATAN = 'runKetetapanKecamatanSimalungun';
	const KETETAPANPAJAKRETRIBUSIKECAMATAN = 'runKetetapanRetribusiKecamatanSimalungun';
	public function tableName()
	{
		return '{{crontab}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, nama_crontab', 'length', 'max'=>255),
			array('url, last_running', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, nama_crontab, url, last_running', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'nama_crontab' => 'Nama Crontab',
			'url' => 'Url',
			'last_running' => 'Last Running',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('nama_crontab',$this->nama_crontab,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('last_running',$this->last_running,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function run_crontab($kode){
		$model=Crontab::model()->updateAll(array(
            'last_running'=> new CDbExpression('NOW()'),
            ),
            "code='$kode' "
        );
		$mcrontHistory = new CrontabHistory;
		$mcrontHistory->code = $kode;
		$mcrontHistory->tanggal_running = new CDbExpression('NOW()');
		$mcrontHistory->save();
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Crontab the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
