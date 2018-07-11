<?php

/**
 * This is the model class for table "{{konten_detail}}".
 *
 * The followings are the available columns in table '{{konten_detail}}':
 * @property integer $id
 * @property integer $konten_id
 * @property string $judul
 * @property string $gambar
 * @property string $tgl_buat
 * @property string $isi_konten
 * @property string $sumber
 * @property string $slug
 * @property string $status
 */
class KontenDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{konten_detail}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('judul','required'),
			array('konten_id', 'numerical', 'integerOnly'=>true),
			array('gambar', 'length', 'max'=>11),
			array('judul', 'length', 'max'=>350),
			array('sumber', 'length', 'max'=>250),
			array('status', 'length', 'max'=>1),
			array('isi_konten', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, konten_id, judul, tgl_buat, isi_konten, sumber, status', 'safe', 'on'=>'search'),
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
			'konten_id' => 'Konten',
			'judul' => 'Judul',
			'gambar' => 'Gambar',
			'tgl_buat' => 'Tgl Buat',
			'isi_konten' => 'Isi Konten',
			'sumber' => 'Sumber',
			'status' => 'Status',
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
		$criteria->compare('konten_id',$this->konten_id);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('tgl_buat',$this->tgl_buat,true);
		$criteria->compare('isi_konten',$this->isi_konten,true);
		$criteria->compare('sumber',$this->sumber,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
		public function status( $status = "" )
	{
		$_status = [];
		$_status[0] = 'Tidak Aktif';
		$_status[1] = 'aktif';
		if( $status != "" ){
			return $_status[$status];
		}
		return $_status;
	}
	  public function id_terakhir(){
    	$sql= "SELECT MAX(id) as id_slug FROM t_konten_detail ";
    	$command= Yii::app()->db->createCommand($sql);
    	return $dataReader =$command->queryAll();
    }
    public function getkonten(){

		$sql = "SELECT * FROM t_konten_detail order by id desc limit 6";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	public function lastNew()
	{
		$sql='SELECT * FROM t_konten_detail order by id desc';
		$dataProvider=new CSqlDataProvider($sql,array(
										'keyField'=>'id',
										'pagination'=>array(
											'pageSize'=>6,
										),
							));
	}
	public function getkontendetail(){

		$sql = "SELECT * FROM t_konten_detail WHERE status=1 ";		
		return $sql;
	}
	public function getbulan($bulan){
    	$sql="SELECT * FROM `t_konten_detail` WHERE month(tgl_buat)=$bulan";
    	$command= Yii::app()->db->createCommand($sql);
    	return $dataReader =$command->queryAll();
    }
    public function getslug($slug){
    	$sql="SELECT * FROM t_konten_detail WHERE slug='$slug'";
    	$command= Yii::app()->db->createCommand($sql);
    	return $dataReader =$command->queryAll();
    }



	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KontenDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
