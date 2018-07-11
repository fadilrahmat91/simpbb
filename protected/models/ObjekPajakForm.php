<?php

/**
 * This is the model class for table "{{member_upgrade}}".
 *
 * The followings are the available columns in table '{{member_upgrade}}':
 * @property string $id
 * @property string $promotioncode
 * @property string $tanggal
 * @property integer $idmember
 * @property integer $idmemberplan
 * @property string $tanggal_start
 * @property string $tanggal_expired
 * @property string $price_idr
 * @property string $price_sgd
 * @property string $status
 * @property integer $usercreate
 * @property string $datecreate
 */
class ObjekPajakForm extends CFormModel {

    public $nop;
	public $lattitude;
	public $longitude;
	public $pencarian_lat;
	public $pencarian_lng;
	public $pencarian_nop;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
			array('nop,lattitude,longitude', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
            array('nop,lattitude,longitude,pencarian_lat,pencarian_lng,pencarian_nop', 'safe', 'on'=>'search'),
        );
    }
	public function attributeLabels()
	{
		return array(
			'nop' => 'Masukkan NOP',
			'lattitude' => 'Lattitude',
			'longitude' => 'Longitude',
			'pencarian_lat' => 'Masukkan Lattitude',
			'pencarian_lng' => 'Masukkan Longitude',
			'pencarian_nop' => 'Masukkan Nop'
		);
	}
    public function search() {
		
	}

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
