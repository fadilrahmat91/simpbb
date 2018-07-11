<?php

/**
 * This is the model class for table "{{realisasi_kecamatan_simpatda}}".
 *
 * The followings are the available columns in table '{{realisasi_kecamatan_simpatda}}':
 * @property string $id
 * @property integer $kd_kecamatan
 * @property integer $kodejenispajak
 * @property integer $jumlah_objek
 * @property string $tahun
 * @property string $ketetapan
 * @property string $jumlah_bayar
 * @property string $jumlah_denda
 * @property string $jumlah_sanksi_adm
 */
class RealisasiKecamatanSimpatda extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{realisasi_kecamatan_simpatda}}';
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
			array('ketetapan, jumlah_bayar, jumlah_denda, jumlah_sanksi_adm', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kd_kecamatan, kodejenispajak, jumlah_objek, tahun, ketetapan, jumlah_bayar, jumlah_denda, jumlah_sanksi_adm', 'safe', 'on'=>'search'),
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
			'jumlah_bayar' => 'Jumlah Bayar',
			'jumlah_denda' => 'Jumlah Denda',
			'jumlah_sanksi_adm' => 'Jumlah Sanksi Adm',
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
		$criteria->compare('jumlah_bayar',$this->jumlah_bayar,true);
		$criteria->compare('jumlah_denda',$this->jumlah_denda,true);
		$criteria->compare('jumlah_sanksi_adm',$this->jumlah_sanksi_adm,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RealisasiKecamatanSimpatda the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function get_realisasi_tahunan($tahun,$type, $kecamatan ="" ){
		$sql = "select
					sum(r.jumlah_objek) as jumlah_objek,
					sum(r.jumlah_bayar - r.jumlah_denda - r.jumlah_sanksi_adm) as jumlah_bayar, 
					sum(r.jumlah_denda) as jumlah_denda,
					sum(r.jumlah_sanksi_adm) as jumlah_sanksi_adm
					
				from t_realisasi_kecamatan_simpatda r join t_jenis_objek_pajak_simpatda jp on r.kodejenispajak = jp.kodejenispajak  where tahun = '$tahun' and jp.type_pajak = '$type'";
		if( $kecamatan != "" ){
			$sql .= " and r.kd_kecamatan = '$kecamatan'";
		}
		$sql .= " group by jp.type_pajak";
		
		$command = Yii::app()->db->createCommand($sql);
		$result = $command->queryAll();
		if(!empty($result)){
			return ['jumlah_bayar' => $result[0]['jumlah_bayar'],'jumlah_denda'=>$result[0]['jumlah_denda'],'jumlah_sanksi_adm'=>$result[0]['jumlah_sanksi_adm'],'jumlah_objek'=>$result[0]['jumlah_objek']];
		}
		return ['jumlah_bayar' => 0,'jumlah_denda'=>0,'jumlah_sanksi_adm'=>0,'jumlah_objek'=>0];
	}
	public function get_realisasi_tahunan_chart($tahun,$type, $kecamatan=""){
		$bykecamatan = "";
		if($kecamatan != "" ){
			$bykecamatan = " AND kd_kecamatan = '$kecamatan' ";
		}
		$sql = "select *, ((jumlah_bayar*100)/ketetapan) as percentages from (select
						r.kodejenispajak,
						sum(r.jumlah_objek) as jumlah_objek,
						sum(r.jumlah_bayar - r.jumlah_denda - r.jumlah_sanksi_adm) as jumlah_bayar, 
						sum(r.jumlah_denda) as jumlah_denda,
						sum(r.jumlah_sanksi_adm) as jumlah_sanksi_adm,
						(select SUM(ketetapan) as ketetapan from t_ketetapan_kecamatan_simpatda where tahun = '$tahun'  and kodejenispajak = r.kodejenispajak AND type_pajak = '$type' $bykecamatan ) as ketetapan
					from t_realisasi_kecamatan_simpatda r join t_jenis_objek_pajak_simpatda jp on r.kodejenispajak = jp.kodejenispajak  where tahun = '$tahun' and jp.type_pajak = '$type' $bykecamatan group by jp.kodejenispajak
					) as x ";
		$sql = "select * from ($sql) as b order by percentages desc";
		$command = Yii::app()->db->createCommand($sql);
		return $command->queryAll();
	}
	public function get_realisasi_tahunan_kecamatan_chart($tahun,$type){
		$sql = "select *, ((jumlah_bayar/ketetapan) *100 ) as percentages from (select
						r.kodejenispajak,
						r.kd_kecamatan,
						sum(r.jumlah_objek) as jumlah_objek,
						sum(r.jumlah_bayar) as jumlah_bayar,
						(select SUM(ketetapan) as ketetapan from t_ketetapan_kecamatan_simpatda where tahun = '$tahun'  and kodejenispajak = r.kodejenispajak AND type_pajak = '$type' ) as ketetapan
					from t_realisasi_kecamatan_simpatda r join t_jenis_objek_pajak_simpatda jp on r.kodejenispajak = jp.kodejenispajak  where tahun = '$tahun' and jp.type_pajak = '$type' group by jp.kodejenispajak,kd_kecamatan
					) as x ";
		$sql = "select * from ($sql) as b order by percentages desc";
		$command = Yii::app()->db->createCommand($sql);
		return $command->queryAll();
	}
	private function setValuedSerialize($kecamatan,$jenis_pajak){
		
		$jPajak = $jenis_pajak['jenispajak'];
		$series = [];
		foreach( $jPajak as $p => $jp ){
			$series[$p] = ['name'=>$jp,'data'=> $kecamatan['values']];
		}
		
		return $series;
	}
	public function chartRealisasi($judul,$tahun,$jenis_pajak,$datarealisasi){
		
		if( !empty($jenis_pajak)){
			$jPajak 		= $jenis_pajak['jenispajak'];
			$realisasi 		= [];//$jenis_pajak['values'];
			$sanksi_adm 	= [];//$jenis_pajak['values'];
			$jumlah_objek 	= [];//$jenis_pajak['values'];
			$persentase 	= [];//$jenis_pajak['values'];
			$jumlah_denda 	= [];//$jenis_pajak['values'];
			$category 		= [];
			/*
			[kodejenispajak] => 1
            [ketetapan] => 8059647842.00
            [sanksi_adm] => 6706169.00
            [jumlah_objek] => 468
			*/
			if( !empty($datarealisasi)){
				foreach( $datarealisasi as $p ){
					$CJenisPajak = $p['kodejenispajak'];
					
					if( isset($jPajak[$CJenisPajak])){
						$realisasi[$CJenisPajak] = round($p['jumlah_bayar']);
						$sanksi_adm[$CJenisPajak] = round($p['jumlah_sanksi_adm']);
						$jumlah_objek[$CJenisPajak] = round($p['jumlah_objek']);
						$jumlah_denda[$CJenisPajak] = round($p['jumlah_denda']);
						$persentase[$CJenisPajak] = (float) number_format($p['percentages'],2,'.','.');
						$category[$CJenisPajak] = $jPajak[$CJenisPajak];
					}
				}
			}
			$response = [
				"status"=>'ok',
				"title" => $judul,
				"text" => "",
				"subtitle" => "",
				"categories"=>array_values($category),
				"series"=> array(
					array(
							'name'	=>'Jumlah Bayar',
							'type' 	=>'column',
							
							'data'	=>array_values($realisasi),
							'stack' => 'realisasi',
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Rp.']
					),
					array(
							'name'=>'Sanksi Administrasi',
							'yAxis'=> 1,
							'data'=>array_values($sanksi_adm),
							
							//'tooltip' => ['valueSuffix'=>'Objek']
					),
					array(
							'name'	=>'Jumlah Denda',
							'yAxis'=> 1,
							'data'	=>array_values($jumlah_denda),
							
							//'tooltip' => ['valueSuffix'=>'Rp.']
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
					),
					array(
							'name'	=>'Persentase',
							'type' 	=>'line',
							'yAxis'=> 3,
							'data'	=>array_values($persentase),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Rp.']
					),
					
				)
			];
			return $response;
		}
		return ['status'=>'error'];
	}
	public function chartRealisasi_($judul,$tahun,$jenis_pajak,$datarealisasi){
		
		if( !empty($jenis_pajak)){
			$jPajak 		= $jenis_pajak['jenispajak'];
			$realisasi 		= [];//$jenis_pajak['values'];
			$sanksi_adm 	= [];//$jenis_pajak['values'];
			$jumlah_objek 	= [];//$jenis_pajak['values'];
			$persentase 	= [];//$jenis_pajak['values'];
			$jumlah_denda 	= [];//$jenis_pajak['values'];
			$category 		= [];
			/*
			[kodejenispajak] => 1
            [ketetapan] => 8059647842.00
            [sanksi_adm] => 6706169.00
            [jumlah_objek] => 468
			*/
			if( !empty($datarealisasi)){
				foreach( $datarealisasi as $p ){
					$CJenisPajak = $p['kodejenispajak'];
					
					if( isset($jPajak[$CJenisPajak])){
						$realisasi[$CJenisPajak] = round($p['jumlah_bayar']);
						$sanksi_adm[$CJenisPajak] = round($p['jumlah_sanksi_adm']);
						$jumlah_objek[$CJenisPajak] = round($p['jumlah_objek']);
						$jumlah_denda[$CJenisPajak] = round($p['jumlah_denda']);
						$persentase[$CJenisPajak] = (float) number_format($p['percentages'],2,'.','.');
						$category[$CJenisPajak] = $jPajak[$CJenisPajak];
					}
				}
			}
			$response = [
				"status"=>'ok',
				"title" => $judul,
				"text" => "",
				"subtitle" => "",
				"categories"=>array_values($category),
				"series"=> array(
					array(
							'name'=>'Sanksi Administrasi',
							'type' 	=>'column',
							'yAxis'=> 0,
							'data'=>array_values($sanksi_adm),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Objek']
					),
					array(
							'name'	=>'Jumlah Denda',
							'type' 	=>'column',
							'yAxis'=> 1,
							'data'	=>array_values($jumlah_denda),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Rp.']
					),
					array(
							'name'	=>'Jumlah Bayar',
							'type' 	=>'column',
							'yAxis'=> 2,
							'data'	=>array_values($realisasi),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Rp.']
					),
					array(
							'name'	=>'Total Objek',
							'type' 	=>'line',
							'yAxis'=> 3,
							'data'	=>array_values($jumlah_objek),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Rp.']
					),
					array(
							'name'	=>'Persentase',
							'type' 	=>'line',
							'yAxis'=> 4,
							'data'	=>array_values($persentase),
							'dataLabels'=> array(
								'enabled'=> true
							)
							//'tooltip' => ['valueSuffix'=>'Rp.']
					),
					
				)
			];
			return $response;
		}
		return ['status'=>'error'];
	}
	public function chartRealisasiKecamatan($judul,$tahun,$jenis_pajak,$kecamatan,$dataketetapan){
		
		$dSerialize = self::setValuedSerialize($kecamatan,$jenis_pajak);
		
		
		if( !empty($kecamatan)){
			$kPajak = $kecamatan['kecamatan'];
			
			$jumlah_objek = $kecamatan['values'];
			$persentase = $kecamatan['values'];
			$series = [];
			if( !empty($dataketetapan)){
				foreach( $dataketetapan as $p ){
					$CKecamatanPajak = $p['kd_kecamatan'];
					$jenisPajak = $p['kodejenispajak'];
					if( isset($dSerialize[$jenisPajak]['data'][$CKecamatanPajak])){
						$dSerialize[$jenisPajak]['data'][$CKecamatanPajak] = round($p['jumlah_bayar']);
						//$sanksi_adm[$CKecamatanPajak."-".$jenisPajak] = round($p['sanksi_adm']);
						if(isset($jumlah_objek[$CKecamatanPajak])){
							$jumlah_objek[$CKecamatanPajak] = $jumlah_objek[$CKecamatanPajak] + round($p['jumlah_objek']);
						}else{
							$jumlah_objek[$CKecamatanPajak] = round($p['jumlah_objek']);
						}
						if(isset($persentase[$CKecamatanPajak])){
							$persentase[$CKecamatanPajak] = ($persentase[$CKecamatanPajak] + round($p['percentages'])/count($persentase[$CKecamatanPajak]));
						}else{
							$persentase[$CKecamatanPajak] = round($p['percentages']);
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
							
			$sSerialize[] = ['name'	=>'Persentase',
							'type' 	=>'line',
							'yAxis'=> 2,
							'data'	=>array_values($persentase),
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
