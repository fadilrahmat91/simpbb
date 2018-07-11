<?php

/**
 * This is the model class for table "{{ketetapan_kecamatan_simpatda}}".
 *
 * The followings are the available columns in table '{{ketetapan_kecamatan_simpatda}}':
 * @property string $id
 * @property integer $kd_kecamatan
 * @property integer $kodejenispajak
 * @property integer $jumlah_objek
 * @property string $tahun
 * @property string $ketetapan
 * @property string $sanksi_adm
 */
class KetetapanKecamatanSimpatda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	const TYPE_PAJAK_RETRIBUSI = 'retribusi';
	const TYPE_PAJAK = 'pajak';
	public function tableName()
	{
		return '{{ketetapan_kecamatan_simpatda}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kd_kecamatan, kodejenispajak, jumlah_objek', 'numerical', 'integerOnly'=>true),
			array('tahun', 'length', 'max'=>4),
			array('ketetapan, sanksi_adm,type_pajak', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kd_kecamatan, kodejenispajak, jumlah_objek, tahun, ketetapan, sanksi_adm,type_pajak', 'safe', 'on'=>'search'),
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
			'kd_kecamatan' => 'Kd Kecamatan',
			'kodejenispajak' => 'Kodejenispajak',
			'jumlah_objek' => 'Jumlah Objek',
			'tahun' => 'Tahun',
			'ketetapan' => 'Ketetapan',
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
		$criteria->compare('kd_kecamatan',$this->kd_kecamatan);
		$criteria->compare('kodejenispajak',$this->kodejenispajak);
		$criteria->compare('jumlah_objek',$this->jumlah_objek);
		$criteria->compare('tahun',$this->tahun,true);
		$criteria->compare('ketetapan',$this->ketetapan,true);
		$criteria->compare('sanksi_adm',$this->sanksi_adm,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KetetapanKecamatanSimpatda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function get_ketetapan_tahunan($tahun,$type,$kecamatan=""){
		$sql = "select 
					sum(ketetapan) as ketetapan, 
					sum(sanksi_adm) as sanksi_adm,
					sum(jumlah_objek) as jumlah_objek
				from t_ketetapan_kecamatan_simpatda k where tahun = '$tahun' and type_pajak = '$type' ";
		if( $kecamatan != "" ){
			$sql .= " and kd_kecamatan = '$kecamatan'";
		}
		$sql .= " group by type_pajak ";
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		if(!empty($result)){
			return ['ketetapan' => $result[0]['ketetapan'],'sanksi_adm'=>$result[0]['sanksi_adm'],'jumlah_objek'=>$result[0]['jumlah_objek']];
		}
		return ['ketetapan' => 0,'sanksi_adm'=>0,'jumlah_objek'=>0];
	}
	public function get_ketetapan_tahunan_chart($tahun,$type,$kecamatan=""){
		$sql = "select 
					kodejenispajak,
					sum(ketetapan) as ketetapan, 
					sum(sanksi_adm) as sanksi_adm,
					sum(jumlah_objek) as jumlah_objek
				from t_ketetapan_kecamatan_simpatda k where tahun = '$tahun' and type_pajak = '$type' ";
		if( $kecamatan != "" ){
			$sql .= " and kd_kecamatan = '$kecamatan'";
		}
		$sql .= " group by kodejenispajak";
		$command = Yii::app()->db->createCommand($sql);
		return $command->queryAll();
	}
	public function get_ketetapan_tahunan_kecamatan_chart($tahun,$type){
		$sql = "select 
					kodejenispajak,
					kd_kecamatan,
					sum(ketetapan) as ketetapan, 
					sum(sanksi_adm) as sanksi_adm,
					sum(jumlah_objek) as jumlah_objek
				from t_ketetapan_kecamatan_simpatda k where tahun = '$tahun' and type_pajak = '$type' group by kodejenispajak,kd_kecamatan";
		$command = Yii::app()->db->createCommand($sql);
		return $command->queryAll();
	}
	public function chartKetetapan($judul,$tahun,$jenis_pajak,$dataketetapan){
		
		
		if( !empty($jenis_pajak)){
			$jPajak = $jenis_pajak['jenispajak'];
			$ketetapan = $jenis_pajak['values'];
			$sanksi_adm = $jenis_pajak['values'];
			$jumlah_objek = $jenis_pajak['values'];
			/*
			[kodejenispajak] => 1
            [ketetapan] => 8059647842.00
            [sanksi_adm] => 6706169.00
            [jumlah_objek] => 468
			*/
			if( !empty($dataketetapan)){
				foreach( $dataketetapan as $p ){
					$CJenisPajak = $p['kodejenispajak'];
					
					if( isset($jPajak[$CJenisPajak])){
						$ketetapan[$CJenisPajak] = round($p['ketetapan']);
						$sanksi_adm[$CJenisPajak] = round($p['sanksi_adm']);
						$jumlah_objek[$CJenisPajak] = round($p['jumlah_objek']);
					}
				}
			}
			$response = [
				"status"=>'ok',
				"title" => $judul,
				"text" => "",
				"subtitle" => "",
				"categories"=>array_values($jPajak),
				"series"=> array(
					array(
							'name'	=>'Ketetapan',
							'type' 	=>'column',
							'yAxis'=> 0,
							'data'	=>array_values($ketetapan),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Rp.']
					),
					array(
							'name'=>'Sanksi Administrasi',
							'type' 	=>'line',
							'yAxis'=> 1,
							'data'=>array_values($sanksi_adm),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Objek']
					),
					array(
							'name'	=>'Total Objek',
							'type' 	=>'line',
							'yAxis'=> 2,
							'data'	=>array_values($jumlah_objek),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Rp.']
					)

				)
			];
			return $response;
		}
		return ['status'=>'error'];
	}
	private function setValuedSerialize($kecamatan,$jenis_pajak){
		
		$jPajak = $jenis_pajak['jenispajak'];
		$series = [];
		foreach( $jPajak as $p => $jp ){
			$series[$p] = ['name'=>$jp,'data'=> $kecamatan['values']];
		}
		
		return $series;
	}
	public function chartKetetapanKecamatan($judul,$tahun,$jenis_pajak,$kecamatan,$dataketetapan){
		
		$dSerialize = self::setValuedSerialize($kecamatan,$jenis_pajak);
		
		
		if( !empty($kecamatan)){
			$kPajak = $kecamatan['kecamatan'];
			$ketetapan = $kecamatan['values'];
			$sanksi_adm = $kecamatan['values'];
			$jumlah_objek = $kecamatan['values'];
			
			$series = [];
			if( !empty($dataketetapan)){
				foreach( $dataketetapan as $p ){
					$CKecamatanPajak = $p['kd_kecamatan'];
					$jenisPajak = $p['kodejenispajak'];
					if( isset($dSerialize[$jenisPajak]['data'][$CKecamatanPajak])){
						$dSerialize[$jenisPajak]['data'][$CKecamatanPajak] = round($p['ketetapan'] + $p['sanksi_adm']);
						//$sanksi_adm[$CKecamatanPajak."-".$jenisPajak] = round($p['sanksi_adm']);
						if(isset($jumlah_objek[$CKecamatanPajak])){
							$jumlah_objek[$CKecamatanPajak] = $jumlah_objek[$CKecamatanPajak] + round($p['jumlah_objek']);
						}else{
							$jumlah_objek[$CKecamatanPajak] = round($p['jumlah_objek']);
						}
					}
				}
			}
			$sSerialize = [];
			foreach( $dSerialize as $p => $v ){
				$sSerialize[] = ['type'=>'column','name'=>$v['name'],'data'=>array_values($v['data'])];
			}
			$sSerialize[] = ['name'	=>'Total Objek',
							'type' 	=>'line',
							'yAxis'=> 1,
							'data'	=>array_values($jumlah_objek),
							'dataLabels'=> array(
								'enabled'=> true
							)];
			$response = [
				"status"=>'ok',
				"title" => $judul,
				"text" => "",
				"subtitle" => "",
				"categories"=>array_values($kPajak),
				"series"=> $sSerialize
			];
			return $response;
		}
		return ['status'=>'error'];
	}
}
