<?php

/**
 * This is the model class for table "produk".
 *
 * The followings are the available columns in table 'produk':
 * @property integer $id_produk
 * @property string $nama_produk
 * @property string $harga
 * @property string $deskripsi
 * @property string $tgl_produk_masuk
 * @property string $kategori_id
 * @property integer $id_brand
 * @property string $image
 */
class Produk extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'produk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_produk, harga, deskripsi, tgl_produk_masuk, kategori_id, id_brand, image', 'required'),
			array('id_brand', 'numerical', 'integerOnly'=>true),
			array('nama_produk, harga', 'length', 'max'=>33),
			array('deskripsi, image', 'length', 'max'=>333),
			array('kategori_id', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_produk, nama_produk, harga, deskripsi, tgl_produk_masuk, kategori_id, id_brand, image', 'safe', 'on'=>'search'),
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
			'id_produk' => 'Id Produk',
			'nama_produk' => 'Nama Produk',
			'harga' => 'Harga',
			'deskripsi' => 'Deskripsi',
			'tgl_produk_masuk' => 'Tgl Produk Masuk',
			'kategori_id' => 'Kategori',
			'id_brand' => 'Id Brand',
			'image' => 'Image',
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

		$criteria->compare('id_produk',$this->id_produk);
		$criteria->compare('nama_produk',$this->nama_produk,true);
		$criteria->compare('harga',$this->harga,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('tgl_produk_masuk',$this->tgl_produk_masuk,true);
		$criteria->compare('kategori_id',$this->kategori_id,true);
		$criteria->compare('id_brand',$this->id_brand);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Produk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
