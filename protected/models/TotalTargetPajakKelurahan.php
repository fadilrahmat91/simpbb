<?php

/**
 * This is the model class for table "{{total_target_pajak_kelurahan}}".
 *
 * The followings are the available columns in table '{{total_target_pajak_kelurahan}}':
 * @property string $id
 * @property string $kabupaten_id
 * @property string $tahun_pajak_sppt
 * @property integer $total_objek
 * @property string $ketetapan
 * @property string $luas_bumi
 * @property string $luas_bangunan
 * @property string $kd_kecamatan
 * @property string $kd_kelurahan
 */
class TotalTargetPajakKelurahan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{total_target_pajak_kelurahan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('total_objek', 'numerical', 'integerOnly'=>true),
			array('kabupaten_id, kd_kecamatan', 'length', 'max'=>5),
			array('tahun_pajak_sppt', 'length', 'max'=>4),
			array('ketetapan,minimal_ketetapan, luas_bumi, luas_bangunan', 'length', 'max'=>50),
			array('kd_kelurahan', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kabupaten_id, tahun_pajak_sppt, total_objek, ketetapan,minimal_ketetapan, luas_bumi, luas_bangunan, kd_kecamatan, kd_kelurahan', 'safe', 'on'=>'search'),
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
			'total_objek' => 'Total Objek',
			'ketetapan' => 'Ketetapan',
			'luas_bumi' => 'Luas Bumi',
			'luas_bangunan' => 'Luas Bangunan',
			'kd_kecamatan' => 'Kd Kecamatan',
			'kd_kelurahan' => 'Kd Kelurahan',
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
		$criteria->compare('total_objek',$this->total_objek);
		$criteria->compare('ketetapan',$this->ketetapan,true);
		$criteria->compare('luas_bumi',$this->luas_bumi,true);
		$criteria->compare('luas_bangunan',$this->luas_bangunan,true);
		$criteria->compare('kd_kecamatan',$this->kd_kecamatan,true);
		$criteria->compare('kd_kelurahan',$this->kd_kelurahan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TotalTargetPajakKelurahan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getlaporantahunan($kecamatan,$kelurahan){
		//$oci = Yii::app()->db;
		$sql = "select kabupaten_id,tahun_pajak_sppt,sum(minimal_ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_target_pajak_kelurahan";
		$sql .= " where 1 = 1 ";
		$sql .= " and kd_kecamatan = '".$kecamatan."' ";
		$sql .= " and kd_kelurahan = '".$kelurahan."' ";
		$sql .= " group by tahun_pajak_sppt, kd_kecamatan, kd_kelurahan";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	public function getlaporankelurahantahun($tahun,$kecamatan = ""){
		//$oci = Yii::app()->db;
		//$sql = "select kabupaten_id,kd_kecamatan,kd_kelurahan,tahun_pajak_sppt,sum(ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_realisasi_pajak_kelurahan where tahun_pajak_sppt = '".$tahun."' group by kd_kecamatan,kd_kelurahan";
		$sql = "select kabupaten_id,kd_kecamatan,kd_kelurahan,tahun_pajak_sppt,sum(minimal_ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_target_pajak_kelurahan";
		$sql .= " where tahun_pajak_sppt = '".$tahun."' ";
		if( $kecamatan != "" ){
			$sql .= " and kd_kecamatan = '".$kecamatan."' ";
		}
		$sql .= " group by kd_kecamatan,kd_kelurahan";
		$sql .= " order by sum(ketetapan) DESC";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	public function getlaporankelurahantahunorderketetapan($tahun,$param = []){
		//$oci = Yii::app()->db;
		//$sql = "select kabupaten_id,kd_kecamatan,kd_kelurahan,tahun_pajak_sppt,sum(ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_realisasi_pajak_kelurahan where tahun_pajak_sppt = '".$tahun."' group by kd_kecamatan,kd_kelurahan";
		$sql = "select * from (";
		$sql .= "select kabupaten_id,kd_kecamatan,kd_kelurahan,tahun_pajak_sppt,sum(ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_target_pajak_kelurahan";
		$sql .= " where tahun_pajak_sppt = '".$tahun."' ";
		
		$sql .= " group by kd_kecamatan,kd_kelurahan";
		$sql .= " ) as b";
		$sql .= " order by b.ketetapan desc ";
		if( isset( $param['limit']) ){
			$sql .= " limit ".$param['limit'];
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	//--------Begin kelurahan----------//
	//Mendapatan jumlah ketetapan tahun berjalan
	public function getlaporanKelketetapantahun($tahun,$kecamatan,$kelurahan){
		$sql = "SELECT SUM(minimal_ketetapan) as ketetapan FROM t_total_target_pajak_kelurahan WHERE tahun_pajak_sppt='".$tahun."' AND kd_kecamatan='".$kecamatan."' AND kd_kelurahan='".$kelurahan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan total objek pajak tahun berjalan
	public function getlaporanKelobjekpajaktahun($tahun,$kecamatan,$kelurahan){
		$sql = "SELECT SUM(total_objek) as objekpajak FROM t_total_target_pajak_kelurahan WHERE tahun_pajak_sppt='".$tahun."' AND kd_kecamatan='".$kecamatan."' AND kd_kelurahan='".$kelurahan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan jumlah luas bumi tahun berjalan
	public function getlaporanKelbumitahun($tahun,$kecamatan,$kelurahan){
		$sql = "SELECT SUM(luas_bumi) as ketetapanbumi FROM t_total_target_pajak_kelurahan WHERE tahun_pajak_sppt='".$tahun."' AND kd_kecamatan='".$kecamatan."' AND kd_kelurahan='".$kelurahan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	//Mendapatan jumlah luas bangunan tahun berjalan
	public function getlaporanKelbangunantahun($tahun,$kecamatan,$kelurahan){
		$sql = "SELECT SUM(luas_bangunan) as ketetapanbangunan FROM t_total_target_pajak_kelurahan WHERE tahun_pajak_sppt='".$tahun."' AND kd_kecamatan='".$kecamatan."' AND kd_kelurahan='".$kelurahan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	//--------End kelurahan----------//
}
