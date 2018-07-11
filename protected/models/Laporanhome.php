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
class Laporanhome extends CFormModel {

    public $tanggalawalSearch;
    public $tanggalakhirSearch;
    public $kategori;
    public $email;
	public $is_pagination;
    const STATUS_PENDING = 0;
    const STATUS_RUNING = 1;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tanggalawalSearch, tanggalakhirSearch, kategori', 'safe'),
        );
    }
    public function search() {
        $awal = $this->tanggalawalSearch.' 00:00';
        $akhir = $this->tanggalakhirSearch.' 23:59';
		$kategory = $this->kategori;
		$and_kategory = "";
		
		$sql = " select * from SPPT ";
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		  
		//t_order.tanggal between '$awal' and '$akhir'
	   return new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'id',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'tanggal', 'count'
                ),
            ),
            'pagination'=>$this->is_pagination,
                )
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
