<?php
	class EvaluasiNopDouble extends CFormModel {

	    public $tahun;
		public $is_pagination = 10;
	    /**
	     * @return array validation rules for model attributes.
	     */
	    public function rules() {
	        // NOTE: you should only define rules for those attributes that
	        // will receive user inputs.
	        return array(
	            array('tahun', 'safe'),
	        );
	    }
		
		public function searchRekapitulasi() {
			$tahun = $this->tahun;
			$sql = "SELECT 
						XPERUBAHAN.KD_PROPINSI||'.'||XPERUBAHAN.KD_DATI2||'.'||XPERUBAHAN.KD_KECAMATAN||'.'||XPERUBAHAN.KD_KELURAHAN||'.'||XPERUBAHAN.KD_BLOK||'.'||XPERUBAHAN.NO_URUT||'.'||XPERUBAHAN.KD_JNS_OP NOP_ASAL,
						DECODE(XSPPT.STATUS_PEMBAYARAN_SPPT,'0','BELUM BAYAR','1','BAYAR') AS STATUS_NOP_ASAL,
						XPERUBAHAN.KD_PROPINSI_PERUBAHAN||'.'||XPERUBAHAN.KD_DATI2_PERUBAHAN||'.'||XPERUBAHAN.KD_KECAMATAN_PERUBAHAN||'.'||XPERUBAHAN.KD_KELURAHAN_PERUBAHAN||'.'||XPERUBAHAN.KD_BLOK_PERUBAHAN||'.'||XPERUBAHAN.NO_URUT_PERUBAHAN||'.'||XPERUBAHAN.KD_JNS_OP_PERUBAHAN NOP_PERUBAHAN,
						DECODE(XPERUBAHAN.STATUS_PEMBAYARAN_SPPT,'0','BELUM BAYAR','1','BAYAR') AS STATUS_NOP_PERUBAHAN,
						XSPPT.THN_PAJAK_SPPT AS THN_PAJAK_SPPT
					 FROM (
						SELECT 
							X.KD_PROPINSI,
							X.KD_DATI2,
							X.KD_KECAMATAN,
							X.KD_KELURAHAN,
							X.KD_BLOK,
							X.NO_URUT,
							X.KD_JNS_OP,
							X.THN_PAJAK_SPPT,
							X.STATUS_PEMBAYARAN_SPPT,
							DOP.TOTAL_LUAS_BNG,
							DOB.JNS_BUMI
						FROM SPPT X join DAT_OBJEK_PAJAK DOP
						on 
							X.KD_PROPINSI = DOP.KD_PROPINSI AND
							X.KD_DATI2 = DOP.KD_DATI2 AND 
							X.KD_KECAMATAN = DOP.KD_KECAMATAN AND
							X.KD_KELURAHAN = DOP.KD_KELURAHAN AND
							X.KD_BLOK = DOP.KD_BLOK AND
							X.NO_URUT = DOP.NO_URUT AND
							X.KD_JNS_OP = DOP.KD_JNS_OP
						left join DAT_OP_BUMI DOB 
							on 
							X.KD_PROPINSI = DOB.KD_PROPINSI AND
							X.KD_DATI2 = DOB.KD_DATI2 AND 
							X.KD_KECAMATAN = DOB.KD_KECAMATAN AND
							X.KD_KELURAHAN = DOB.KD_KELURAHAN AND
							X.KD_BLOK = DOB.KD_BLOK AND
							X.NO_URUT = DOB.NO_URUT AND
							X.KD_JNS_OP = DOB.KD_JNS_OP AND
							
							DOP.KD_PROPINSI = DOB.KD_PROPINSI AND
							DOP.KD_DATI2 = DOB.KD_DATI2 AND 
							DOP.KD_KECAMATAN = DOB.KD_KECAMATAN AND
							DOP.KD_KELURAHAN = DOB.KD_KELURAHAN AND
							DOP.KD_BLOK = DOB.KD_BLOK AND
							DOP.NO_URUT = DOB.NO_URUT AND
							DOP.KD_JNS_OP = DOB.KD_JNS_OP
						

						WHERE X.THN_PAJAK_SPPT = '$tahun'
					) XSPPT JOIN (
						SELECT 
							B.KD_PROPINSI,
							B.KD_DATI2,
							B.KD_KECAMATAN,
							B.KD_KELURAHAN,
							B.KD_BLOK,
							B.NO_URUT,
							B.KD_JNS_OP,
							B.STATUS_PEMBAYARAN_SPPT,
							A.KD_PROPINSI AS KD_PROPINSI_PERUBAHAN,
							A.KD_DATI2 AS KD_DATI2_PERUBAHAN,
							A.KD_KECAMATAN AS KD_KECAMATAN_PERUBAHAN,
							A.KD_KELURAHAN AS KD_KELURAHAN_PERUBAHAN,
							A.KD_BLOK AS KD_BLOK_PERUBAHAN,
							A.NO_URUT AS NO_URUT_PERUBAHAN,
							A.KD_JNS_OP AS KD_JNS_OP_PERUBAHAN
							
						FROM SPPT B, PERUBAHAN_NOP A 
						WHERE 
							B.KD_PROPINSI = A.KD_PROPINSI_ASAL AND 
							B.KD_DATI2 = A.KD_DATI2_ASAL AND 
							B.KD_KECAMATAN = A.KD_KECAMATAN_ASAL AND
							B.KD_KELURAHAN = A.KD_KELURAHAN_ASAL AND
							B.KD_BLOK = A.KD_BLOK_ASAL AND 
							B.NO_URUT = A.NO_URUT_ASAL AND
							B.KD_JNS_OP = A.KD_JNS_OP_ASAL AND 
							B.THN_PAJAK_SPPT = '$tahun'
					) XPERUBAHAN 
					ON 
						XSPPT.KD_PROPINSI 	= XPERUBAHAN.KD_PROPINSI_PERUBAHAN AND 
						XSPPT.KD_DATI2 		= XPERUBAHAN.KD_DATI2_PERUBAHAN AND 
						XSPPT.KD_KECAMATAN 	= XPERUBAHAN.KD_KECAMATAN_PERUBAHAN AND
						XSPPT.KD_KELURAHAN 	= XPERUBAHAN.KD_KELURAHAN_PERUBAHAN AND
						XSPPT.KD_BLOK 		= XPERUBAHAN.KD_BLOK_PERUBAHAN AND 
						XSPPT.NO_URUT 		= XPERUBAHAN.NO_URUT_PERUBAHAN AND
						XSPPT.KD_JNS_OP 	= XPERUBAHAN.KD_JNS_OP_PERUBAHAN
					WHERE 1 = 1 ORDER BY XPERUBAHAN.KD_KECAMATAN DESC
					";
			
			$count = Yii::app()->dbOracle->createCommand("select count(*) from (
				$sql
				) a")->queryScalar();
			//$sql .= " AND ROWNUM <= $count ";
			return new CSqlDataProvider($sql, array(
				'db' => Yii::app()->dbOracle,
	            'keyField' => 'NOP_ASAL',
	            'totalItemCount' => $count,
	            'sort' => array(
	                'attributes' => array(
	                    'NOP_ASAL', 'count'
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
				'tahun' => 'Tahun'
			);
		}
	}
