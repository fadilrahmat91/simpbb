<?php
	class SubjekPajak extends CFormModel {
		public $subjek_pajak_id;
		public $nm_wp;
		public $jalan_wp;
		public $blok_kav_no_wp;
		public $rw_wp;
		public $rt_wp;
		public $kelurahan_wp;
		public $kota_wp;
		public $kd_pos_wp;
		public $telp_wp;
		public $npwp;
		public $status_pekerjaan_wp;
		public $email;
		public $password;
		public $is_pagination = 10;
		public $isNewRecord;
		
	    public function rules() {
	        // NOTE: you should only define rules for those attributes that
	        // will receive user inputs.
	        return array(
	        	array('subjek_pajak_id, nm_wp,jalan_wp, blok_kav_no_wp, rw_wp, rt_wp, kelurahan_wp, kota_wp, kd_pos_wp, kd_pos_wp, telp_wp, npwp, status_pekerjaan_wp', 'required'),
				array('email', 'length', 'max'=>50),
				array('password', 'length', 'max'=>255),

	            array('subjek_pajak_id, nm_wp,jalan_wp, blok_kav_no_wp, rw_wp, rt_wp, kelurahan_wp, kota_wp, kd_pos_wp, kd_pos_wp, telp_wp, npwp, status_pekerjaan_wp', 'safe'),
	        );
	    }
	    public function search(){
		    $subjek_pajak_id = $this->subjek_pajak_id;
		    $nm_wp = $this->nm_wp;
		    $jalan_wp = $this->jalan_wp;
		    $status_pekerjaan_wp = $this->status_pekerjaan_wp;
		    	$sql = "SELECT
			    			SUBJEK_PAJAK_ID, 
			    			NM_WP,
			    			JALAN_WP,
			    			BLOK_KAV_NO_WP,
			    			RW_WP,
			    			RT_WP,
			    			KELURAHAN_WP,
			    			KOTA_WP,
			    			KD_POS_WP,
			    			TELP_WP,
			    			NPWP,
			    			STATUS_PEKERJAAN_WP 
		    			FROM DAT_SUBJEK_PAJAK
		    			WHERE 1=1";

			if( $subjek_pajak_id != "" ){
			
				$sql .= " AND  ( REGEXP_LIKE (SUBJEK_PAJAK_ID, '".$subjek_pajak_id."') ";
				$subjek_pajak_id = explode(" ",$subjek_pajak_id);
				if( count($subjek_pajak_id) > 0 ){
					foreach( $subjek_pajak_id as $p ){
						//$sql .= " OR   REGEXP_LIKE (SP.NM_WP, '".$p."') ";
					}
				}
				$sql .= " ) ";
			}
			if( $nm_wp != "" ){
			
				$sql .= " AND  ( REGEXP_LIKE (NM_WP, '".$nm_wp."') ";
				$nm_wp = explode(" ",$nm_wp);
				if( count($nm_wp) > 0 ){
					foreach( $nm_wp as $p ){
						//$sql .= " OR   REGEXP_LIKE (SP.NM_WP, '".$p."') ";
					}
				}
				$sql .= " ) ";
			}
			if( $jalan_wp != "" ){
				
				$sql .= " AND  ( REGEXP_LIKE (JALAN_WP, '".$jalan_wp."') ";
				$jalan_wp = explode(" ",$jalan_wp);
				if( count($jalan_wp) > 0 ){
					foreach( $jalan_wp as $p ){
						$sql .= " OR   REGEXP_LIKE (JALAN_WP, '".$p."') ";
					}
				}
				$sql .= " ) ";
			}

			if( $status_pekerjaan_wp != "" ){
				
				$sql .= " AND STATUS_PEKERJAAN_WP = '".$status_pekerjaan_wp."' ";
			}
	    	$count = Yii::app()->dbOracle->createCommand("select count(*) from (
				$sql
				) a")->queryScalar();
			return new CSqlDataProvider($sql, array(
				'db' => Yii::app()->dbOracle,
	            'keyField' => 'SUBJEK_PAJAK_ID',
	            'totalItemCount' => $count,
	            'sort' => array(
	                'attributes' => array(
	                    'SUBJEK_PAJAK_ID', 'count'
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
				'subjek_pajak_id' => 'Subjek Pajak ID',
				'nm_wp' => 'Nama WP',
				'jalan_wp' => 'Jalan WP',
				'blok_kav_no_wp' => 'Blok Kav No WP',
				'rw_wp' => 'RW WP',
				'rt_wp' => 'RT WP',
				'kelurahan_wp' => 'Kelurahan WP',
				'kota_wp' => 'Kota WP',
				'kd_pos_wp' => 'Kode Pos WP',
				'telp_wp' => 'Telp WP',
				'npwp' => 'NPWP',
				'status_pekerjaan_wp' => 'Status Pekerjaan WP',
				'email' => 'Email',
				'password' => 'Password'
			);
		}

		public function insert(){
			$timestamp = new CDbExpression('NOW()');
		      $connection = Yii::app()->dbOracle;
		      $transaction=$connection->beginTransaction();
		      $connection->createCommand()
		        ->insert(
		          'DAT_SUBJEK_PAJAK',
		          array(
		            'SUBJEK_PAJAK_ID'=>$model->subjek_pajak_id,
		            'NM_WP'=>$model->nm_wp,
		            'JALAN_WP'=>$model->jalan_wp,
		            'BLOK_KAV_NO_WP'=>$model->blok_kav_no_wp,
		            'RW_WP'=>$model->rw_wp,
		            'RT_WP'=>$model->rt_wp,
		            'KELURAHAN_WP'=>$model->kelurahan_wp,
		            'KOTA_WP'=>$model->kota_wp,
		            'KD_POS_WP'=>$model->kd_pos_wp,
		            'TELP_WP'=>$model->telp_wp,
		            'NPWP'=>$model->npwp,
		            'STATUS_PEKERJAAN_WP'=>$model->status_pekerjaan_wp,
		            'EMAIL'=>$model->email,
		            'PASSWORD'=>$model->password,
		            'DATE_CREATED'=>$timestamp,
		          )
		        );
		}
	}
