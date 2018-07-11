<?php

/**
 * This is the model class for table "{{total_realisasi_pajak_kelurahan}}".
 *
 * The followings are the available columns in table '{{total_realisasi_pajak_kelurahan}}':
 * @property string $id
 * @property string $kabupaten_id
 * @property string $tahun_pajak_sppt
 * @property integer $total_objek
 * @property string $denda
 * @property string $jumlah_bayar
 * @property string $kd_kecamatan
 * @property string $kd_kelurahan
 */
class TotalRealisasiPajakKelurahan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{total_realisasi_pajak_kelurahan}}';
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
			array('denda, jumlah_bayar', 'length', 'max'=>50),
			array('kd_kelurahan', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kabupaten_id, tahun_pajak_sppt, total_objek, denda, jumlah_bayar, kd_kecamatan, kd_kelurahan', 'safe', 'on'=>'search'),
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
			'denda' => 'Denda',
			'jumlah_bayar' => 'Jumlah Bayar',
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
		$criteria->compare('denda',$this->denda,true);
		$criteria->compare('jumlah_bayar',$this->jumlah_bayar,true);
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
	 * @return TotalRealisasiPajakKelurahan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function getlaporantahunan($kecamatan,$kelurahan){
		//$oci = Yii::app()->db;
		$sql = "select kabupaten_id,tahun_pajak_sppt,sum(jumlah_bayar) as jumlah_bayar,sum(denda) as denda from t_total_realisasi_pajak_kelurahan";
		$sql .= " where 1 = 1 "; 
		
		$sql .= " and kd_kecamatan = '".$kecamatan."' ";
		$sql .= " and kd_kelurahan = '".$kelurahan."' ";
		
		$sql .= " group by tahun_pajak_sppt,kd_kecamatan,kd_kelurahan";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	public function getlaporankelurahantahun($tahun,$kecamatan=""){
		//$oci = Yii::app()->db;
		//$sql = "select kabupaten_id,kd_kecamatan,tahun_pajak_sppt,sum(ketetapan) as ketetapan,sum(luas_bumi) as luas_bumi,sum(luas_bangunan) as luas_bangunan,sum(total_objek) as total_objek from t_total_target_pajak_kabupaten where tahun_pajak_sppt = '".$tahun."' group by kd_kecamatan";
		$sql = "select kabupaten_id,kd_kecamatan,kd_kelurahan,tahun_pajak_sppt,sum(jumlah_bayar) as jumlah_bayar,sum(denda) as denda from t_total_realisasi_pajak_kelurahan";
		$sql .= " where tahun_pajak_sppt = '".$tahun."'";
		if( $kecamatan != "" ){
			$sql .= " and kd_kecamatan = '".$kecamatan."'";
		}
		$sql .= " group by kd_kecamatan,kd_kelurahan";
		$sql .= " order by sum(jumlah_bayar) DESC ";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	public function getlaporankelurahantahunorderketetapan($tahun, $param = [] ){
		$sql = "select * from ( select kabupaten_id,kd_kecamatan,sum(total_objek) as total_objek,kd_kelurahan,tahun_pajak_sppt,sum(jumlah_bayar) as jumlah_bayar,sum(denda) as denda from t_total_realisasi_pajak_kelurahan";
		$sql .= " where tahun_pajak_sppt = '".$tahun."'";
		
		$sql .= " group by kd_kecamatan,kd_kelurahan ) as b";
		$sql .= " order by b.jumlah_bayar desc ";
		if( isset( $param['limit']) ){
			$sql .= " limit ".$param['limit'];
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	public function getPersentasiRealisasi($tahun,$param = []){
		$sql = "select * from (select 
					sum(ttarget.ketetapan) as ketetapan,
					sum(trealisasi.jumlah_bayar) as jumlah_bayar,
					sum(ttarget.minimal_ketetapan) as minimal_ketetapan,
					SUM(trealisasi.jumlah_bayar) * 100 / (sum(ttarget.minimal_ketetapan)) AS percentages,
					trealisasi.kd_kecamatan,
					trealisasi.kd_kelurahan
				from 
					t_total_realisasi_pajak_kelurahan trealisasi join t_total_target_pajak_kelurahan ttarget 
				on 
					trealisasi.tahun_pajak_sppt = ttarget.tahun_pajak_sppt
					and trealisasi.kabupaten_id = ttarget.kabupaten_id
					and trealisasi.kd_kecamatan = ttarget.kd_kecamatan
					and trealisasi.kd_kelurahan = ttarget.kd_kelurahan
				where 
					trealisasi.tahun_pajak_sppt = '".$tahun."'
				group by trealisasi.kd_kecamatan,trealisasi.kd_kelurahan, trealisasi.tahun_pajak_sppt) as b
				order by percentages desc";
		if( isset( $param['limit']) ){
			$sql .= " limit ".$param['limit'];
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}

	//--------Begin kelurahan----------//

	//Mendapatkan jumlah realisasi kecamatan tahun berjalan
	public function getlaporanKelrealisasitahun($tahun,$kecamatan,$kelurahan){
		$sql = "SELECT SUM(jumlah_bayar) as realisasitahun FROM t_total_realisasi_pajak_kelurahan WHERE tahun_pajak_sppt='".$tahun."' AND kd_kecamatan='".$kecamatan."' AND kd_kelurahan='".$kelurahan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}

	//Mendapatkan jumlah realisasi objek pajak tahun berjalan
	public function getlaporanKelrealisasiobjekpajaktahun($tahun,$kecamatan,$kelurahan){
		$sql = "SELECT SUM(total_objek) as objekpajak FROM t_total_realisasi_pajak_kelurahan WHERE tahun_pajak_sppt='".$tahun."' AND kd_kecamatan='".$kecamatan."' AND kd_kelurahan='".$kelurahan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}

	//--------End kelurahan----------//
}
