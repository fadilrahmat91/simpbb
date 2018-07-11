<?php

/**
 * This is the model class for table "{{total_target_pajak_kabupaten}}".
 *
 * The followings are the available columns in table '{{total_target_pajak_kabupaten}}':
 * @property string $id
 * @property string $kabupaten_id
 * @property string $tahun_pajak_sppt
 * @property integer $ketetapan
 * @property integer $luas_bumi
 * @property integer $luas_bangunan
 */
class TotalTargetPajakKabupaten extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{total_target_pajak_kabupaten}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ketetapan, minimal_ketetapan,luas_bumi, luas_bangunan,total_objek', 'numerical', 'integerOnly'=>true),
			array('kabupaten_id', 'length', 'max'=>5),
			array('tahun_pajak_sppt', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kabupaten_id,kd_kecamatan, tahun_pajak_sppt, ketetapan,minimal_ketetapan, luas_bumi, luas_bangunan', 'safe', 'on'=>'search'),
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
			'kabupaten_id' => 'Kabupaten',
			'tahun_pajak_sppt' => 'Tahun Pajak Sppt',
			'ketetapan' => 'Ketetapan',
			'luas_bumi' => 'Luas Bumi',
			'luas_bangunan' => 'Luas Bangunan',
			'total_objek' => 'Total Objek'
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
		$criteria->compare('kabupaten_id',$this->kabupaten_id,true);
		$criteria->compare('tahun_pajak_sppt',$this->tahun_pajak_sppt,true);
		$criteria->compare('ketetapan',$this->ketetapan);
		$criteria->compare('luas_bumi',$this->luas_bumi);
		$criteria->compare('luas_bangunan',$this->luas_bangunan);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TotalTargetPajakKabupaten the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getlaporantahunan($kecamatan=""){
		//$oci = Yii::app()->db;
		$sql = "select kabupaten_id,tahun_pajak_sppt,sum(minimal_ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_target_pajak_kabupaten";
		$sql .= " where 1 = 1 ";
		if( $kecamatan != "" ){
			$sql .= " and kd_kecamatan =:kecamatan ";
		}
		
		$sql .= " group by tahun_pajak_sppt";
		if( $kecamatan != "" ){
			$sql .= " ,kd_kecamatan ";
		}
		$command = Yii::app()->db->createCommand($sql);
		if( $kecamatan != "" ){
			$command->bindParam(":kecamatan", $kecamatan, PDO::PARAM_STR);
		}
		return $dataReader = $command->queryAll();
	}
	public function getlaporankecamatantahun($tahun){
		//$oci = Yii::app()->db;
		$sql = "select * from (select kabupaten_id,kd_kecamatan,tahun_pajak_sppt,sum(ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_target_pajak_kabupaten where tahun_pajak_sppt =:tahun group by kd_kecamatan,tahun_pajak_sppt) as b order by b.ketetapan DESC";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	//--------Begin kabupaten----------//
	//Mendapatan jumlah ketetapan tahun berjalan
	public function getlaporanketetapantahun($tahun){
		$sql = "SELECT SUM(minimal_ketetapan) as ketetapan FROM t_total_target_pajak_kabupaten WHERE tahun_pajak_sppt=:tahun";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan total objek pajak tahun berjalan
	public function getlaporanobjekpajaktahun($tahun){
		$sql = "SELECT SUM(total_objek) as objekpajak FROM t_total_target_pajak_kabupaten WHERE tahun_pajak_sppt=:tahun";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan jumlah luas bumi tahun berjalan
	public function getlaporanbumitahun($tahun){
		$sql = "SELECT SUM(luas_bumi) as ketetapanbumi FROM t_total_target_pajak_kabupaten WHERE tahun_pajak_sppt=:tahun";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan jumlah luas bangunan tahun berjalan
	public function getlaporanbangunantahun($tahun){
		$sql = "SELECT SUM(luas_bangunan) as ketetapanbangunan FROM t_total_target_pajak_kabupaten WHERE tahun_pajak_sppt=:tahun";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	

	//--------End kabupaten----------//


	//--------Begin kecamatan----------//
	//Mendapatan jumlah ketetapan tahun berjalan
	public function getlaporanKecketetapantahun($tahun,$kecamatan){
		$sql = "SELECT SUM(minimal_ketetapan) as ketetapan FROM t_total_target_pajak_kabupaten WHERE tahun_pajak_sppt=:tahun AND kd_kecamatan=:kecamatan";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		$command->bindParam(":kecamatan", $kecamatan, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan total objek pajak tahun berjalan
	public function getlaporanKecobjekpajaktahun($tahun,$kecamatan){
		$sql = "SELECT SUM(total_objek) as objekpajak FROM t_total_target_pajak_kabupaten WHERE tahun_pajak_sppt=:tahun AND kd_kecamatan=:kecamatan";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		$command->bindParam(":kecamatan", $kecamatan, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan jumlah luas bumi tahun berjalan
	public function getlaporanKecbumitahun($tahun,$kecamatan){
		$sql = "SELECT SUM(luas_bumi) as ketetapanbumi FROM t_total_target_pajak_kabupaten WHERE tahun_pajak_sppt=:tahun AND kd_kecamatan=:kecamatan";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		$command->bindParam(":kecamatan", $kecamatan, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan jumlah luas bangunan tahun berjalan
	public function getlaporanKecbangunantahun($tahun,$kecamatan){
		$sql = "SELECT SUM(luas_bangunan) as ketetapanbangunan FROM t_total_target_pajak_kabupaten WHERE tahun_pajak_sppt=:tahun AND kd_kecamatan=:kecamatan";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":tahun", $tahun, PDO::PARAM_STR);
		$command->bindParam(":kecamatan", $kecamatan, PDO::PARAM_STR);
		return $dataReader = $command->queryAll();
	}
	//--------End kecamatan----------//

}
