<?php
	class EvaluasiRekapBayarTahunan extends CFormModel {

	    public $tahun;
		public $is_pagination = 10;
		public $kecamatan;
		public $kelurahan;
	    /**
	     * @return array validation rules for model attributes.
	     */
	    public function rules() {
	        // NOTE: you should only define rules for those attributes that
	        // will receive user inputs.
	        return array(
	            array('tahun, kecamatan, kelurahan', 'safe'),
	        );
	    }
		
		public function searchRekapitulasi() {
			$tahun = $this->tahun;
			$kecamatan = $this->kecamatan;
			$kelurahan = $this->kelurahan;
			$sql = "SELECT A.KD_PROPINSI_P||'.'||A.KD_DATI2_P||'.'||A.KD_KECAMATAN_P||'.'||A.KD_KELURAHAN_P||'.'||A.KD_BLOK_P||'.'||A.NO_URUT_P||'.'||A.KD_JNS_OP_P AS NOP,
						A.KD_PROPINSI_P AS KD_PROPINSI, 
						A.KD_DATI2_P AS KD_DATI2 ,
						A.KD_KECAMATAN_P AS KD_KECAMATAN, 
						A.KD_KELURAHAN_P AS KD_KELURAHAN,
						A.THN_PAJAK_SPPT AS THN_PAJAK_SPPT,
						B.NM_WP_SPPT AS NM_WP
						FROM PEMBAYARAN_SPPT A, SPPT B 
							WHERE  A.KD_PROPINSI_P=B.KD_PROPINSI 
							AND A. KD_DATI2_P=B.KD_DATI2 
							AND A. KD_KECAMATAN_P=B.KD_KECAMATAN 
							AND A. KD_KELURAHAN_P=B.KD_KELURAHAN 
							AND A. KD_BLOK_P=B.KD_BLOK 
							AND A. NO_URUT_P=B.NO_URUT 
							AND A. KD_JNS_OP_P=B.KD_JNS_OP 
							AND A. THN_PAJAK_SPPT = B. THN_PAJAK_SPPT 
							AND B.STATUS_PEMBAYARAN_SPPT = '0' 
							AND B.THN_PAJAK_SPPT = '$tahun'
					";
					if( (int) $kecamatan > 0 ){
						$sql .= " AND A.KD_KECAMATAN_P = '".$kecamatan."' ";
					}
					if( (int) $kelurahan > 0 ){
						$sql .= " AND A.KD_KELURAHAN_P = '".$kelurahan."' ";
					}
					$sql .= " ORDER BY A.KD_KECAMATAN_P DESC";
			
			$count = Yii::app()->dbOracle->createCommand("select count(*) from (
				$sql
				) a")->queryScalar();
			//$sql .= " AND ROWNUM <= $count ";
			return new CSqlDataProvider($sql, array(
				'db' => Yii::app()->dbOracle,
	            'keyField' => 'NOP',
	            'totalItemCount' => $count,
	            'sort' => array(
	                'attributes' => array(
	                    'NOP', 'count'
	                ),
	            ),
	            'pagination'=>$this->is_pagination,
	                )
	        );
	    }

	    public static function model($className = __CLASS__) {
	        return parent::model($className);
	    }
		public function attributeLabels()
		{
			return array(
				'tahun' => 'Tahun',
				'kecamatan' => 'Kecamatan',
				'kelurahan' => 'Kelurahan'
			);
		}
	}
