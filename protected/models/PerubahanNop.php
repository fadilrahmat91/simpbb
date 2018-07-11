<?php
class PerubahanNop extends CFormModel {

    public $kd_propinsi;
	public $kd_dati2;
	public $kecamatan;
	public $kelurahan;
	public $blok;
	public $nomor_urut;
	public $kd_jenis_op;
	public $is_pagination = 10;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('kd_propinsi,kd_dati2,kecamatan,kelurahan,blok,nomor_urut,kd_jenis_op', 'safe'),
        );
    }
	public function attributeLabels()
	{
		return array(
			'kd_propinsi' => 'Kode Propinsi',
		);
	}
    public function search() {
		$sql = "  select 
					KD_PROPINSI||'.'||KD_DATI2||'.'||KD_KECAMATAN||'.'||KD_KELURAHAN||'.'||KD_BLOK||'-'||NO_URUT||'.'||KD_JNS_OP NOP,
					STATUS_PERUBAHAN_NOP,
					TGL_PERUBAHAN_NOP
					from PERUBAHAN_NOP WHERE 1 = 1 ";
		
		if(  !empty($this->kd_propinsi) ){
			$sql .= " AND KD_PROPINSI_ASAL = '".$this->kd_propinsi."' ";
		}
		if( !empty($this->kd_dati2 ) ){
			$sql .= " AND KD_DATI2_ASAL = '".$this->kd_dati2."' ";
		}
		if( !empty($this->kecamatan ) ){
			$sql .= " AND KD_KECAMATAN_ASAL = '".$this->kecamatan."' ";
		}
		if( !empty($this->kelurahan ) ){
			$sql .= " AND KD_KELURAHAN_ASAL = '".$this->kelurahan."' ";
		}
		if( !empty($this->blok ) ){
			$sql .= " AND KD_BLOK_ASAL = '".$this->blok."' ";
		}
		if( !empty($this->nomor_urut)){
			$sql .= " AND NO_URUT_ASAL = '".$this->nomor_urut."' ";
		}
		if( !empty($this->kd_jenis_op ) ){
			$sql .= " AND KD_JNS_OP_ASAL = '".$this->kd_jenis_op."' ";
		}
		//$sql .= " ORDER BY B.KD_KECAMATAN(+) ";
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		$sql .= " AND ROWNUM <= $count ";
		
		//t_order.tanggal between '$awal' and '$akhir'
	   return new CSqlDataProvider($sql, array(
				'db' => Yii::app()->dbOracle,
				'keyField' => 'NOP',
				'totalItemCount' => $count,
				'sort' => array(
					'attributes' => array(
						'NOP', 'count'
					),
					'defaultOrder'=>'TGL_PERUBAHAN_NOP DESC',
				),
				'pagination'=>$this->is_pagination,
			)
        );
	}

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
