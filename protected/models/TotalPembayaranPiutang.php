<?php

/**
 * This is the model class for table "{{total_pembayaran_piutang}}".
 *
 * The followings are the available columns in table '{{total_pembayaran_piutang}}':
 * @property string $id
 * @property string $kabupaten_id
 * @property string $kecamatan_id
 * @property string $kelurahan_id
 * @property string $tahun_bayar
 * @property string $pembayaran_denda
 * @property string $pembayaran_pokok
 */
class TotalPembayaranPiutang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{total_pembayaran_piutang}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kabupaten_id, kecamatan_id, kelurahan_id', 'length', 'max'=>5),
			array('tahun_bayar,tahun_pajak', 'length', 'max'=>4),
			array('pembayaran_denda, pembayaran_pokok,total_objek', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kabupaten_id, kecamatan_id, kelurahan_id, total_objek,tahun_bayar,tahun_pajak, pembayaran_denda, pembayaran_pokok', 'safe', 'on'=>'search'),
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
			'kecamatan_id' => 'Kecamatan',
			'kelurahan_id' => 'Kelurahan',
			'tahun_bayar' => 'Tahun Bayar',
			'tahun_pajak' => 'Tahun Pajak',
			'pembayaran_denda' => 'Pembayaran Denda',
			'pembayaran_pokok' => 'Pembayaran Pokok',
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
		$criteria->compare('kecamatan_id',$this->kecamatan_id,true);
		$criteria->compare('kelurahan_id',$this->kelurahan_id,true);
		$criteria->compare('tahun_bayar',$this->tahun_bayar,true);
		$criteria->compare('tahun_pajak',$this->tahun_pajak,true);
		$criteria->compare('pembayaran_denda',$this->pembayaran_denda,true);
		$criteria->compare('pembayaran_pokok',$this->pembayaran_pokok,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TotalPembayaranPiutang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	//Mendapatkan jumlah realisasi Pembayaran Denda tahun berjalan
	public function getlaporanpiutang($tahun,$param =[]){
		$sql = "SELECT SUM(pembayaran_pokok ) as pembayaran_pokok, SUM(pembayaran_denda) AS pembayaran_denda FROM t_total_pembayaran_piutang WHERE tahun_bayar != tahun_pajak AND tahun_bayar='".$tahun."'";
		if( isset($param['kecamatan'])){
			$kecamatan = $param['kecamatan'];
			$sql .= " AND kecamatan_id = '$kecamatan'";
		}
		if( isset($param['kelurahan'])){
			$kelurahan = $param['kelurahan'];
			$sql .= " AND kelurahan_id = '$kelurahan'";
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}
	
	//Mendapatkan jumlah realisasi Pembayaran Denda tahun berjalan
	public function getlaporanKecpiutang($tahun,$kecamatan){
		$sql = "SELECT SUM(pembayaran_denda + pembayaran_pokok) as piutang FROM t_total_pembayaran_piutang WHERE tahun_bayar='".$tahun."' AND kecamatan_id='".$kecamatan."'";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}
	
	//Mendapatkan jumlah realisasi Pembayaran Denda tahun berjalan
	public function getlaporanKelpiutang($tahun,$param = []){
		$sql = "SELECT SUM(pembayaran_denda + pembayaran_pokok) as piutang FROM t_total_pembayaran_piutang WHERE tahun_bayar='".$tahun."'";
		
		if( isset($param['kecamatan'])){
			$kecamatan = $param['kecamatan'];
			$sql .= " AND kecamatan_id = '$kecamatan'";
		}
		if( isset($param['kelurahan'])){
			$kelurahan = $param['kelurahan'];
			$sql .= " AND kelurahan_id = '$kelurahan'";
		}
		
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}
	public function getPembayaran_piutang($tahun, $param = []){
		$sql = "SELECT tahun_pajak, SUM(pembayaran_pokok) as pembayaran_pokok , SUM(pembayaran_denda) as pembayaran_denda,sum(total_objek ) as total_objek  FROM t_total_pembayaran_piutang WHERE tahun_bayar != tahun_pajak AND tahun_bayar='$tahun' ";
		if( isset($param['kecamatan'])){
			$kecamatan = $param['kecamatan'];
			$sql .= " AND kecamatan_id = '$kecamatan'";
		}
		if( isset($param['kelurahan'])){
			$kelurahan = $param['kelurahan'];
			$sql .= " AND kelurahan_id = '$kelurahan'";
		}
		$sql .= " group by tahun_pajak ";
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}
	public function getRealisasiInfo($tahun, $param = [] ){
		$sql = "SELECT SUM(pembayaran_pokok) as pembayaran_pokok , SUM(pembayaran_denda) as pembayaran_denda,sum(total_objek ) as total_objek  FROM t_total_pembayaran_piutang WHERE tahun_bayar = tahun_pajak AND tahun_bayar='$tahun' ";
		if( isset($param['kecamatan'])){
			$kecamatan = $param['kecamatan'];
			$sql .= " AND kecamatan_id = '$kecamatan'";
		}
		if( isset($param['kelurahan'])){
			$kelurahan = $param['kelurahan'];
			$sql .= " AND kelurahan_id = '$kelurahan'";
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();	
	}
	public function getRealisasiGroup($tahun){
		/*$sql = "SELECT 
					kecamatan_id AS kd_kecamatan, 
					SUM(pembayaran_pokok) as pembayaran_pokok, 
					SUM(pembayaran_denda) as pembayaran_denda,
					sum(total_objek ) as total_objek 
				FROM t_total_pembayaran_piutang 
					WHERE tahun_bayar = tahun_pajak AND tahun_bayar='$tahun' ";
		*/
		$sql = "select 
					kecamatan_id AS kd_kecamatan,
					pembayaran_pokok,
					pembayaran_denda,
					(CASE WHEN tahun_pajak != tahun_bayar THEN 'piutang' ELSE 'realisasi' END) AS status_bayar,
					total_objek from t_total_pembayaran_piutang ";
		$sql .= " WHERE  tahun_bayar='$tahun'";
		
		//$sql .= " group by kecamatan_id ";
		$sqlx = "	select 
						kd_kecamatan,
						SUM(pembayaran_pokok) as pembayaran_pokok,
						SUM(pembayaran_denda) as pembayaran_denda,
						SUM(total_objek) as total_objek,
						status_bayar
						from ( $sql) b group by status_bayar, kd_kecamatan order by SUM(pembayaran_pokok) DESC ";
			
			
		$command = Yii::app()->db->createCommand($sqlx);
		return $dataReader = $command->queryAll();
				
	}
	public function getRealisasiTahunan($param = []){
		$kecamatan = false;
		$kelurahan = false;
		$sql = "select 
					tahun_bayar,
					tahun_pajak as tahun_pajak_sppt,
					pembayaran_pokok,
					pembayaran_denda,
					(CASE WHEN tahun_pajak != tahun_bayar THEN 'piutang' ELSE 'realisasi' END) AS status_bayar,
					total_objek from t_total_pembayaran_piutang";
		$sql .= " where 1 = 1 ";
		if( isset($param['kecamatan']) && $param['kecamatan'] != "" ){
			$kecamatan = $param['kecamatan'];
			$sql .= " AND kecamatan_id = :kecamatan ";
		}
		if( isset($param['kelurahan']) && $param['kelurahan'] != "" ){
			$kelurahan = $param['kelurahan'];
			$sql .= " AND kelurahan_id = :kelurahan ";
		}
		
		
		//$sql .= " group by tahun_bayar,(CASE WHEN tahun_pajak = tahun_bayar THEN 'realisasi' ELSE 'piutang' END)";
		$sqlx = "select tahun_bayar,tahun_pajak_sppt,status_bayar,
						sum(pembayaran_pokok) as pembayaran_pokok,
						sum(pembayaran_denda) as pembayaran_denda
						from ($sql) as b group by tahun_bayar, status_bayar";
		$command = Yii::app()->db->createCommand($sqlx);
		if( $kecamatan ){
			$command->bindParam(":kecamatan", $kecamatan, PDO::PARAM_STR);
		}
		if($kelurahan){
			$command->bindParam(":kelurahan", $kelurahan, PDO::PARAM_STR);
		}
		return $dataReader = $command->queryAll();
	}
	public function getRealisasiKelurahanGroup($tahun,$param = []){
		$sql = "SELECT kecamatan_id AS kd_kecamatan, SUM(pembayaran_pokok) as pembayaran_pokok , SUM(pembayaran_denda) as pembayaran_denda,sum(total_objek ) as total_objek  FROM t_total_pembayaran_piutang WHERE tahun_bayar = tahun_pajak AND tahun_bayar='$tahun' ";
		
		if( isset($param['kecamatan'])){
			$kecamatan = $param['kecamatan'];
			$sql .= " AND kecamatan_id = '$kecamatan'";
		}
		
		$sql .= " group by kecamatan_id ";
		$sqlx = "select * from ( $sql) b order by b.pembayaran_pokok DESC ";
			
			
		$command = Yii::app()->db->createCommand($sqlx);
		return $dataReader = $command->queryAll();
				
	}
	public function getPersentasiRealisasi($tahun,$param = []){
		$sql = "select *,((jumlah_bayar*100)/ketetapan) as percentages from (select trealisasi.kecamatan_id as kd_kecamatan, sum(pembayaran_pokok) as jumlah_bayar,
			(select SUM(minimal_ketetapan) as ketetapan from t_total_target_pajak_kabupaten where tahun_pajak_sppt = '$tahun' and kd_kecamatan = trealisasi.kecamatan_id) as ketetapan
			 from t_total_pembayaran_piutang trealisasi where trealisasi.tahun_bayar = trealisasi.tahun_pajak  and tahun_pajak = '$tahun' group by kecamatan_id
			) as b ";
		
		$sql = "select * from ($sql) as b order by percentages desc";
		if( isset( $param['limit']) ){
			$sql .= " limit ".$param['limit'];
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	public function getPersentasiRealisasiKlurahan($tahun,$param = []){
		$sql = "select *,((jumlah_bayar*100)/ketetapan) as percentages from (select trealisasi.kecamatan_id as kd_kecamatan,trealisasi.kelurahan_id as kd_kelurahan, sum(pembayaran_pokok) as jumlah_bayar,
			(select SUM(minimal_ketetapan) as ketetapan from t_total_target_pajak_kelurahan where tahun_pajak_sppt = '$tahun' and kd_kecamatan = trealisasi.kecamatan_id AND kd_kelurahan = trealisasi.kelurahan_id) as ketetapan
			 from t_total_pembayaran_piutang trealisasi where trealisasi.tahun_bayar = trealisasi.tahun_pajak  and tahun_pajak = '$tahun' group by kecamatan_id,kelurahan_id
			) as b WHERE 1 = 1 ";
		if( isset( $param['kecamatan']) ){
			$kecamatan = $param['kecamatan'];
			$sql .= " AND kd_kecamatan =  '$kecamatan'";
		}
		$sql = "select * from ($sql) as b order by percentages desc";
		if( isset( $param['limit']) ){
			$sql .= " limit ".$param['limit'];
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	public function getKetetapanKelurahan($tahun,$param = []){
		$sql = "select *,((realisasi*100)/ketetapan) as percentages from (select sum(ttarget.minimal_ketetapan) as ketetapan,ttarget.kd_kecamatan,ttarget.kd_kelurahan,
				(select sum(pembayaran_pokok) as pembayaran_pokok from t_total_pembayaran_piutang trealisasi where trealisasi.kecamatan_id = ttarget.kd_kecamatan and trealisasi.kelurahan_id = ttarget.kd_kelurahan and trealisasi.tahun_pajak = '$tahun' and trealisasi.tahun_bayar = trealisasi.tahun_pajak limit 1) as realisasi
				 from t_total_target_pajak_kelurahan ttarget where tahun_pajak_sppt = '$tahun' group by kd_kecamatan, kd_kelurahan
				) as b";
		
		$sql = "select * from ($sql) as b order by ketetapan desc";
		if( isset( $param['limit']) ){
			$sql .= " limit ".$param['limit'];
		}
		$command = Yii::app()->db->createCommand($sql);
		return $dataReader = $command->queryAll();
	}
	
}
