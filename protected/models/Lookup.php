<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $userlevel
 * @property string $nik
 * @property string $nama_lengkap
 * @property string $tanggal_daftar
 * @property string $tanggal_ubah
 */
class Lookup extends CFormModel{
	
	const STATUS_PEKERJAAN = '08';
	const KELAS_BINTANG = '05';
	
	public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('kd_lookup_group, nama_lookup_group,kd_lookup_item,nama_lookup_item', 'safe') 
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
	public function lookup_items($kd_group, $kd_items = ""){
		// cara panggil
		//$data = Lookup::lookup_items( Lookup::STATUS_PEKERJAAN);
		///
		
		$sql = "select NM_LOOKUP_ITEM from LOOKUP_ITEM WHERE KD_LOOKUP_GROUP = '$kd_group' ";
		if( $kd_items != ""){
			$sql .= " AND KD_LOOKUP_ITEM = '$kd_items' ";
		}
		
		$command = Yii::app()->dbOracle->createCommand($sql);
		$result = $command->queryAll();
		if( $kd_items != ""){
			if( count($result) > 0 ){
				return $result[0]['NM_LOOKUP_ITEM'];
			}
			return "-";
		}
		return $result;
	}
	
	
	public function status_pekerjaan_wp($kd_lookup_item ){
		$kd_lookup_item = self::kd_lookup_item($kd_lookup_item);
		$statname = "";
		foreach( $kd_lookup_item as $p ){
			$statname = $p['NM_LOOKUP_ITEM'];
		}
		return $statname;
	}

	public function kd_lookup_item($kd_lookup_item=""){
		$sql = "SELECT * FROM LOOKUP_ITEM";
		$sql .= " WHERE KD_LOOKUP_GROUP = '08' ";
		if( $kd_lookup_item != "" ){
			$sql .= " AND KD_LOOKUP_ITEM = '$kd_lookup_item' ";
		}
		$command = Yii::app()->dbOracle->createCommand($sql);       
		return $command->queryAll();
	}

	public function lookup_items_dropdown(){
		$sql = "select KD_LOOKUP_ITEM, NM_LOOKUP_ITEM from LOOKUP_ITEM WHERE KD_LOOKUP_GROUP = '08' ";
		$command = Yii::app()->dbOracle->createCommand($sql);
		$result = $command->queryAll();
		return $result;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'kd_lookup_group' => 'KD LOOKUP GROUP',
			'nama_lookup_group' => 'NM LOOKUP ITEM',
			'kd_lookup_item' => 'KD LOOKUP ITEM',
			'nama_lookup_item' => 'NM LOOKUP ITEM'
		);
	}

	public static function model($className = __CLASS__) {
        return parent::model($className);
    }
}
