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
class ReportPembayaran extends CFormModel {

    public $tanggalawalSearch;
    public $tanggalakhirSearch;

	public $status;
    public $memberSearch;
    public $email;

    const STATUS_PENDING = 0;
    const STATUS_RUNING = 1;

    /**
     * @return array validation rules for model attributes.
     */
	public function getDbConnection()
    {
            self::$db = Yii::app()->dbOracle;
            return self::$db;
    }
	
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tanggalawalSearch, tanggalakhirSearch, memberSearch, status', 'safe'),
        );
    }
	
    public function search() {
        $awal = $this->tanggalawalSearch;
        $akhir = $this->tanggalakhirSearch;

        $status = ' AND t_order.status= 5';

        $count = Yii::app()->db->createCommand("select count(*) from (
                        select 1
                                from t_order, t_order_detail
                                where t_order.id = t_order_detail.idorder
                                and t_order.tanggal between '$awal' and '$akhir' $status
                                order by t_order.id
                        ) a")->queryScalar();

        $sql = " select t_order.tanggal, t_order.id, t_order_detail.idproduk, t_produk.id as idproduk, t_produk_info.nama, t_user.perusahaan, t_order_detail.qty, t_order_detail.harga,  (t_order_detail.qty *  t_order_detail.harga) as total
                                from t_order, t_order_detail, t_produk, t_produk_info, t_user
                                where
                                        t_order.id = t_order_detail.idorder and
                                        t_order_detail.idproduk = t_produk.id and
                                        t_produk_info.idproduk = t_produk.id and
                                                        t_produk_info.idbahasa = 2 and
                                        t_produk.idmerchant = t_user.id and
                                                t_order.tanggal between '$awal' and '$akhir' $status
                                                        order by t_order.id, t_produk.id";

        return new CSqlDataProvider($sql, array(
            'keyField' => 'idproduk',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'tanggal', 'count'
                ),
            ),
            'pagination' => false
                )
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
