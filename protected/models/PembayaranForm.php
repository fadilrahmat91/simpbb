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
class PembayaranForm extends CFormModel {

    public $nop;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nop', 'safe'),
        );
    }
	public function attributeLabels()
	{
		return array(
			'nop' => 'Masukkan NOP',
		);
	}
    public function search() {
		
	}

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
