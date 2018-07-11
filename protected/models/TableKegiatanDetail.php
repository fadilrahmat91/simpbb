<?php

/**
 * This is the model class for table "{{table_kegiatan_detail}}".
 *
 * The followings are the available columns in table '{{table_kegiatan_detail}}':
 * @property string $id
 * @property string $kegiatan_id
 * @property string $gambar
 * @property integer $no_urut
 * @property string $tanggal_upload
 */
class TableKegiatanDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{table_kegiatan_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tanggal_upload', 'required'),
			array('no_urut', 'numerical', 'integerOnly'=>true),
			array('kegiatan_id, gambar','length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kegiatan_id, gambar, no_urut, tanggal_upload', 'safe', 'on'=>'search'),
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
			'kegiatan_id' => 'Kegiatan',
			'gambar' => 'Gambar',
			'no_urut' => 'No Urut',
			'tanggal_upload' => 'Tanggal Upload',
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
		$criteria->compare('kegiatan_id',$this->kegiatan_id,true);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('no_urut',$this->no_urut);
		$criteria->compare('tanggal_upload',$this->tanggal_upload,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TableKegiatanDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getKegiatanDetail($id){
		//$oci = Yii::app()->db;
		$sql = "SELECT A.id, A.nama_kegiatan, A.keterangan_kegiatan, A.tanggal_kegiatan, 
				B.kegiatan_id, B.gambar, B.no_urut, 
				C.tanggal_upload, C.nama_file 
				FROM t_table_kegiatan A, t_table_kegiatan_detail B, t_file_lokasi C 
				WHERE B.kegiatan_id=$id  AND A.id=$id
				AND B.gambar = C.id GROUP BY B.id";
		$command = Yii::app()->db->createCommand($sql);
		//$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}	
}
