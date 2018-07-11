<?php
	class EvaluasiBayarTidakSppt extends CFormModel {

	    public $tahun;
		public $is_pagination = 10;
		public $kecamatan;
		public $kelurahan;
		
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
			$sql = "SELECT 
						BPembayaran.KD_PROPINSI_P||'.'||BPembayaran.KD_DATI2_P||'.'||BPembayaran.KD_KECAMATAN_P||'.'||BPembayaran.KD_KELURAHAN_P||'.'||BPembayaran.KD_BLOK_P||'.'||BPembayaran.NO_URUT_P||'.'||BPembayaran.KD_JNS_OP_P  NOP,
						BPembayaran.KD_PROPINSI_P AS KD_PROPINSI,
						BPembayaran.KD_DATI2_P AS KD_DATI2,
						BPembayaran.KD_KECAMATAN_P AS KD_KECAMATAN,
						BPembayaran.KD_KELURAHAN_P AS KD_KELURAHAN,
						BPembayaran.KD_BLOK_P AS KD_BLOK,
						BPembayaran.NO_URUT_P AS NO_URUT,
						BPembayaran.KD_JNS_OP_P AS KD_JENIS_OP,
						BPembayaran.THN_PAJAK_SPPT AS THN_PAJAK_SPPT
						FROM 
							PEMBAYARAN_SPPT BPembayaran left JOIN SPPT BKetetapan 
						ON 
							BPembayaran.KD_PROPINSI_P = BKetetapan.KD_PROPINSI   AND 
							BPembayaran.KD_DATI2_P = BKetetapan.KD_DATI2   AND 
							BPembayaran.KD_KECAMATAN_P = BKetetapan.KD_KECAMATAN  AND 
							BPembayaran.KD_KELURAHAN_P = BKetetapan.KD_KELURAHAN  AND 
							BPembayaran.KD_BLOK_P = BKetetapan.KD_BLOK AND 
							BPembayaran.NO_URUT_P = BKetetapan.NO_URUT  AND
							BPembayaran.KD_JNS_OP_P = BKetetapan.KD_JNS_OP AND
							BPembayaran.THN_PAJAK_SPPT = BKetetapan.THN_PAJAK_SPPT 
						WHERE  BKetetapan.KD_PROPINSI IS NULL AND BPembayaran.THN_PAJAK_SPPT = '$tahun'
						
					";
					if( (int) $kecamatan > 0 ){
						$sql .= " AND BPembayaran.KD_KECAMATAN_P = '".$kecamatan."' ";
					}
					if( (int) $kelurahan > 0 ){
						$sql .= " AND BPembayaran.KD_KELURAHAN_P = '".$kelurahan."' ";
					}

					$sql .= " ORDER BY BPembayaran.KD_KECAMATAN DESC";
			
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
