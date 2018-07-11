<?php
class CobjekPajak{
	
	public function init()
    {
        date_default_timezone_set("UTC");
    }
	public function isFasum( $kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis ){
		$oci = Yii::app()->dbOracle;
		$sql = "select 
					JNS_BUMI
				from 
					DAT_OP_BUMI A
				WHERE 
					A.KD_PROPINSI = '".$kd_propinsi."'
					AND A.KD_DATI2 = '".$kd_dati2."'
					AND A.KD_KECAMATAN = '".$kd_kecamatan."'
					AND A.KD_KELURAHAN = '".$kd_kelurahan."'
					AND A.KD_BLOK = '".$kd_blok."'
					AND A.NO_URUT = '".$nomor_urut."'
					AND A.KD_JNS_OP = '".$kd_jenis."' AND ROWNUM <= 1";
		$command = $oci->createCommand($sql);
		$result = $command->queryAll();
		if( empty($result)){
			return false;
		}else{
			if( $result[0]['JNS_BUMI'] == '4'){
				return true;
			}
		}
		return false;
	}
	function getObjekPajak($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis){
		$oci = Yii::app()->dbOracle;
		$sql = "select 
					B.NM_WP,
					B.KOTA_WP,
					B.KELURAHAN_WP,
					B.JALAN_WP,
					B.RT_WP,
					B.RW_WP,
					A.JALAN_OP,
					A.RT_OP,
					A.RW_OP,
					A.TOTAL_LUAS_BUMI,
					A.TOTAL_LUAS_BNG
				from 
					DAT_OBJEK_PAJAK A, DAT_SUBJEK_PAJAK B
				WHERE 
					A.SUBJEK_PAJAK_ID = B.SUBJEK_PAJAK_ID
					AND A.KD_PROPINSI = '".$kd_propinsi."'
					AND A.KD_DATI2 = '".$kd_dati2."'
					AND A.KD_KECAMATAN = '".$kd_kecamatan."'
					AND A.KD_KELURAHAN = '".$kd_kelurahan."'
					AND A.KD_BLOK = '".$kd_blok."'
					AND A.NO_URUT = '".$nomor_urut."'
					AND A.KD_JNS_OP = '".$kd_jenis."' ";
		$command = $oci->createCommand($sql);
		return $command->queryAll();
	}
	function getObjekPajakLimit($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis){
		$sql = "select 
					A.JALAN_OP,
					A.RT_OP,
					A.RW_OP,
					A.TOTAL_LUAS_BUMI,
					A.TOTAL_LUAS_BNG,
					A.LATTITUDE,
					A.LONGITUDE
				from 
					DAT_OBJEK_PAJAK A
				WHERE A.KD_PROPINSI = '".$kd_propinsi."'
					AND A.KD_DATI2 = '".$kd_dati2."'
					AND A.KD_KECAMATAN = '".$kd_kecamatan."'
					AND A.KD_KELURAHAN = '".$kd_kelurahan."'
					AND A.KD_BLOK = '".$kd_blok."'
					AND A.NO_URUT = '".$nomor_urut."'
					AND A.KD_JNS_OP = '".$kd_jenis."'  ";
					
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
			$sql .= " AND ROWNUM <= $count";
		$data = new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'KD_KECAMATAN',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'KD_KECAMATAN', 'count'
                ),
				'defaultOrder'=>'KD_KECAMATAN ASC',
            ),
            'pagination'=>FALSE,
                )
        );
		return $data->getData();
	}
	function update_objek_pajak_lat_long($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis,$lattitude,$longitude,$nip_perekam){
		//echo $date = date('m/d/Y HH24:MI:SS');
		$date = date('m/d/Y H:i:s', time());
		$sqlupdateSPPT = "	UPDATE DAT_OBJEK_PAJAK 
								SET 
							LATTITUDE = '$lattitude',
							LONGITUDE = '$longitude',
							NIP_PEREKAM_LOKASI = '$nip_perekam',
							TGL_PENAMBAHAN_LOKASI = TO_DATE('$date', 'mm/dd/yy HH24:MI:SS')
							WHERE KD_PROPINSI = '".$kd_propinsi."' AND KD_DATI2 = '".$kd_dati2."' AND KD_KECAMATAN = '".$kd_kecamatan."' AND KD_KELURAHAN = '".$kd_kelurahan."' AND KD_BLOK='".$kd_blok."' AND NO_URUT = '".$nomor_urut."' AND KD_JNS_OP = '".$kd_jenis."' AND ROWNUM <= 1";
		Yii::app()->dbOracle->createCommand($sqlupdateSPPT)->execute();
	}
	function getObjekPajakMarker( $params = [] ){
		$oci = Yii::app()->dbOracle;
		$sql = "select 
					A.KD_PROPINSI||'.'||A.KD_DATI2||'.'||A.KD_KECAMATAN||'.'||A.KD_KELURAHAN||'.'||A.KD_BLOK||'-'||A.NO_URUT||'.'||A.KD_JNS_OP NOP,
					A.LATTITUDE,
					A.LONGITUDE,
					A.JALAN_OP,
					A.RT_OP,
					A.RW_OP,
					A.TOTAL_LUAS_BUMI,
					A.TOTAL_LUAS_BNG
				from 
					DAT_OBJEK_PAJAK A
				WHERE 
					A.LATTITUDE IS NOT NULL AND A.LONGITUDE IS NOT NULL ";
			if( count($params) > 0 ){
				if( isset($params['kd_propinsi']) && $params['kd_propinsi'] != "" ){
					$kd_prop 		= $params['kd_propinsi'];
					$sql .= " AND A.KD_PROPINSI = '$kd_prop' ";
				}
				if( isset($params['kd_dati2']) && $params['kd_dati2'] != "" ){
					$kd_dati2 		= $params['kd_dati2'];
					$sql .= " AND A.KD_DATI2 = '$kd_dati2' ";
				}
				if( isset($params['kd_kecamatan']) && $params['kd_kecamatan'] != "" ){
					$kd_kecamatan 		= $params['kd_kecamatan'];
					$sql .= " AND A.KD_KECAMATAN = '$kd_kecamatan' ";
				}
				if( isset($params['kd_kelurahan']) && $params['kd_kelurahan'] != "" ){
					$kd_kelurahan 		= $params['kd_kelurahan'];
					$sql .= " AND A.KD_KELURAHAN = '$kd_kelurahan' ";
				}
				if( isset($params['kd_blok']) && $params['kd_blok'] != "" ){
					$kd_blok 		= $params['kd_blok'];
					$sql .= " AND A.KD_BLOK = '$kd_blok' ";
				}
				
				if( isset($params['nomor_urut']) && $params['nomor_urut'] != "" ){
					$nomor_urut 		= $params['nomor_urut'];
					$sql .= " AND A.NO_URUT = '$nomor_urut' ";
				}
				if( isset($params['kd_jenis']) && $params['kd_jenis'] != "" ){
					$kd_jenis 		= $params['kd_jenis'];
					$sql .= " AND A.KD_JNS_OP = '$kd_jenis' ";
				}
				
			}
			
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
			$sql .= " AND ROWNUM <= $count";
		$data = new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'NOP',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'NOP', 'count'
                ),
				'defaultOrder'=>'NOP ASC',
            ),
            'pagination'=>FALSE,
                )
        );
		return $data->getData();
	}
	public function ubahDataJatuhTempo(){
		$sql = "select 	KD_PROPINSI,KD_DATI2,KD_KECAMATAN,KD_KELURAHAN,KD_BLOK,NO_URUT,KD_JNS_OP,THN_PAJAK_SPPT ,  TO_CHAR(TGL_JATUH_TEMPO_SPPT,'YYYY-MM-DD HH24:MI:SS') AS TAHUN_JATUH_TEMPO  FROM SPPT where THN_PAJAK_SPPT = '1995' AND THN_PAJAK_SPPT != TO_CHAR(TGL_JATUH_TEMPO_SPPT, 'YYYY')";
	
		$count = Yii::app()->dbOracle->createCommand("select count(*) from (
			$sql
			) a")->queryScalar();
		$data = new CSqlDataProvider($sql, array(
			'db' => Yii::app()->dbOracle,
            'keyField' => 'KD_PROPINSI',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'KD_PROPINSI', 'count'
                ),
				'defaultOrder'=>'KD_PROPINSI ASC',
            ),
            'pagination'=>FALSE,
                )
        );
		$data = $data->getData();
		if( !empty( $data) ){
			foreach($data as $p ){
				$TAHUN_JATUH_TEMPO = explode("-",$p['TAHUN_JATUH_TEMPO']);
				$sql2 = "UPDATE SPPT SET
					TGL_JATUH_TEMPO_SPPT = TO_DATE('$p[THN_PAJAK_SPPT]-$TAHUN_JATUH_TEMPO[1]-$TAHUN_JATUH_TEMPO[2]', 'YYYY-MM-DD HH24:MI:SS'),
					STATUS_PERUBAHAN_PEMBAYARAN = '8'
					WHERE 
					KD_PROPINSI = '$p[KD_PROPINSI]' AND 
					KD_DATI2 = '$p[KD_DATI2]' AND
					KD_KECAMATAN = '$p[KD_KECAMATAN]' AND
					KD_KELURAHAN = '$p[KD_KELURAHAN]' AND
					KD_BLOK = '$p[KD_BLOK]' AND
					NO_URUT = '$p[NO_URUT]' AND
					KD_JNS_OP = '$p[KD_JNS_OP]' AND
					THN_PAJAK_SPPT = '$p[THN_PAJAK_SPPT]' AND ROWNUM <= 1";
					//echo $sql2;
					if(Yii::app()->dbOracle->createCommand($sql2)->execute()){
						echo "SUKSES";
					}else{
						echo $sql2;
					}
					
					echo "<hr>";
			}
		}
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

?>