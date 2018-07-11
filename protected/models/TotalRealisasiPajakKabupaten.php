<?php

/**
 * This is the model class for table "{{total_realisasi_pajak_kabupaten}}".
 *
 * The followings are the available columns in table '{{total_realisasi_pajak_kabupaten}}':
 * @property string $id
 * @property string $kabupaten_id
 * @property string $tahun_pajak_sppt
 * @property integer $total_objek
 * @property string $ketetapan
 * @property string $denda
 * @property string $jumlah_bayar
 * @property string $luas_bumi
 * @property string $luas_bangunan
 * @property string $tgl_pembayaran
 */
class TotalRealisasiPajakKabupaten extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{total_realisasi_pajak_kabupaten}}';
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
			array('kabupaten_id,kd_kecamatan', 'length', 'max'=>5),
			array('tahun_pajak_sppt', 'length', 'max'=>4),
			array(' denda, jumlah_bayar', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kabupaten_id,kd_kecamatan,tahun_pajak_sppt, total_objek, denda, jumlah_bayar', 'safe', 'on'=>'search'),
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
			'kd_kecamatan' => 'Kecamatan',
			'denda' => 'Denda',
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
		$criteria->compare('denda',$this->denda,true);
		$criteria->compare('jumlah_bayar',$this->jumlah_bayar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TotalRealisasiPajakKabupaten the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getlaporantahunan($kecamatan=""){
		//$oci = Yii::app()->db;
		$sql = "select kabupaten_id,tahun_pajak_sppt,sum(jumlah_bayar) as jumlah_bayar,sum(denda) as denda from t_total_realisasi_pajak_kabupaten";
		$sql .= " where 1 = 1 "; 
		if( $kecamatan != "" ){
			$sql .= " and kd_kecamatan = '".$kecamatan."' ";
		}
		$sql .= " group by tahun_pajak_sppt";
		if( $kecamatan != "" ){
			$sql .= " ,kd_kecamatan ";
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	public function getlaporankecamatantahun($tahun){
		//$oci = Yii::app()->db;
		//$sql = "select kabupaten_id,kd_kecamatan,tahun_pajak_sppt,sum(ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_target_pajak_kabupaten where tahun_pajak_sppt = '".$tahun."' group by kd_kecamatan";
		$sql = "select * from (select kabupaten_id,kd_kecamatan,tahun_pajak_sppt,sum(jumlah_bayar) as jumlah_bayar,sum(denda) as denda from t_total_realisasi_pajak_kabupaten where tahun_pajak_sppt = '".$tahun."' group by kd_kecamatan) b order by b.jumlah_bayar DESC";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	public function getPersentasiRealisasi($tahun,$param = []){
		$sql = "select * from (select 
					sum(ttarget.ketetapan) as ketetapan,
					sum(trealisasi.jumlah_bayar) as jumlah_bayar,
					SUM(trealisasi.jumlah_bayar) * 100 / (sum(ttarget.ketetapan)) AS percentages,
					trealisasi.kd_kecamatan
				from 
					t_total_realisasi_pajak_kabupaten trealisasi join t_total_target_pajak_kabupaten ttarget 
				on 
					trealisasi.tahun_pajak_sppt = ttarget.tahun_pajak_sppt
					and trealisasi.kabupaten_id = ttarget.kabupaten_id
					and trealisasi.kd_kecamatan = ttarget.kd_kecamatan
				where 
					trealisasi.tahun_pajak_sppt = '".$tahun."'
				group by trealisasi.kd_kecamatan, trealisasi.tahun_pajak_sppt) as b
				order by percentages desc";
		if( isset( $param['limit']) ){
			$sql .= " limit ".$param['limit'];
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	//--------Begin Kabupaten----------//

	//Mendapatkan jumlah realisasi tahun berjalan
	public function getlaporanrealisasitahun($tahun){
		$sql = "SELECT SUM(jumlah_bayar) as realisasitahun FROM t_total_realisasi_pajak_kabupaten WHERE tahun_pajak_sppt='".$tahun."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}

	//Mendapatkan jumlah realisasi objek pajak tahun berjalan
	public function getlaporanrealisasiobjekpajaktahun($tahun){
		$sql = "SELECT SUM(total_objek) as objekpajak FROM t_total_realisasi_pajak_kabupaten WHERE tahun_pajak_sppt='".$tahun."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}

	//--------End Kabupaten----------//

	//--------Begin Kecamatan----------//

	//Mendapatkan jumlah realisasi kecamatan tahun berjalan
	public function getlaporanKecrealisasitahun($tahun,$kecamatan){
		$sql = "SELECT SUM(jumlah_bayar) as realisasitahun FROM t_total_realisasi_pajak_kabupaten WHERE tahun_pajak_sppt='".$tahun."' AND kd_kecamatan='".$kecamatan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}

	//Mendapatkan jumlah realisasi objek pajak tahun berjalan
	public function getlaporanKecrealisasiobjekpajaktahun($tahun,$kecamatan){
		$sql = "SELECT SUM(total_objek) as objekpajak FROM t_total_realisasi_pajak_kabupaten WHERE tahun_pajak_sppt='".$tahun."' AND kd_kecamatan='".$kecamatan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}

	//--------End Kecamatan----------//
}
