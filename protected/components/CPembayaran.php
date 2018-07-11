<?php
class CPembayaran{
	
	public function init()
    {
        date_default_timezone_set("UTC");
    }
	
	function tempatBayar(){
		return "DPPKA SIMALUNGUN";
	}
	function getRandomString($length = 50) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';

		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}

		return $string;
	}
	function limit_date_pembayaran(){
		$date = date('Y');
		//return $date - 5;
		return "";
	}
	function limit_max_wajib_bayar(){
		return date('Y') - 1;
	}
	function limit_date_wajib_bayar(){
		
		return 2013;
	}
	function is_wajib_bayar($tahun){
		return ($tahun >= self::limit_date_wajib_bayar() AND $tahun <= self::limit_max_wajib_bayar() ? true : false );
	}
	public function explodeNope($nop,$isValidation = true){
		$nop = preg_replace('/\D/', '-', $nop);
		$nop = explode("-",$nop);
		if( $isValidation == true ){
			if( count ($nop) != 7 ){
				//NOP NOT VALID
				return ['status'=>false,'msg'=>'NOP Tidak Valid'];
			}
		}
		$kd_propinsi 	= $nop[0];
		$kd_dati2 		= $nop[1];
		$kd_kecamatan 	= $nop[2];
		$kd_kelurahan 	= $nop[3];
		$kd_blok 		= $nop[4];
		$nomor_urut 	= $nop[5];
		$kd_jenis 		= $nop[6];
		if( $isValidation == true ){
			if( $kd_propinsi == "_" || $kd_dati2 == "_" || $kd_kecamatan == "_" || $kd_kelurahan == "_" || $kd_blok == "_" || $nomor_urut == "_" || $kd_jenis == "_" ){
				return ['status'=>false,'msg'=>'NOP Tidak Valid'];
			}
		}
		return[ 'status'=>true,'data'=>[$nop[0],$nop[1],$nop[2],$nop[3],$nop[4],$nop[5],$nop[6]]];
	}
	
	public function checkifSmallerExist( $tahun_pilih, $tahun_bayar ){
		$bayar = [];
		$tidak_bayar = [];
		$bayar2 = [];
		foreach( $tahun_bayar as $p => $val ){
			if( isset($tahun_pilih[$val])){
				$bayar[$val] = $val;
				if( $val < self::limit_date_wajib_bayar()){
					$bayar2[$val] = $val;
				}
			}else{
				$tidak_bayar[$val] = $val;
				
			}
		}
		
		$msg_error = false;
		if(count($bayar) > 0 ){
			if( count($tidak_bayar) > 0 ){
				$max_bayar = max($bayar);
				foreach( $tidak_bayar as $p => $val ){
					if( self::is_wajib_bayar($val)){
					//if( $val >= self::limit_date_wajib_bayar()){
						$msg_error .= "<p>Tahun $val Harus Bayar</p>";
					}
					
					if( count($bayar2) > 0 ){
						$max_bayar = max($bayar2);
						if( $val < $max_bayar ){
							$msg_error .= "<p>Pilih Pembayaran Tahun $val, untuk membayar diatas $val</p>";
						}
					}
				}
			}
		}else{
			$msg_error = "Data Pembayaran Tidak valid. refresh data anda";
		}
		
		if( $msg_error != false ){
			return ['status'=>false,'msg'=>$msg_error];
		}
		return ['status'=>true,'msg'=>$bayar];
	}
	public function simpan_pembayaran($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis,$b_bayar,$total_ketetapan,$total_denda){
		$status = false;
		$date = date('m/d/Y');
		
		try{
			$connection = Yii::app()->dbOracle;
			$transaction=$connection->beginTransaction();
			
			$no_pembayaran = self::getRandomString();
			$sql = "insert into DAT_BAYAR_SPPT (NO_PEMBAYARAN, KD_PROPINSI,KD_DATI2,KD_KECAMATAN,KD_KELURAHAN,KD_BLOK,NO_URUT,KD_JNS_OP,JUMLAH_BAYAR,JUMLAH_DENDA,STATUS_BAYAR,NIP_PEREKAM,DATE_CREATED) values (:NO_PEMBAYARAN,:KD_PROPINSI,:KD_DATI2, :KD_KECAMATAN, :KD_KELURAHAN,:KD_BLOK, :NO_URUT,:KD_JNS_OP,:JUMLAH_BAYAR,:JUMLAH_DENDA,:STATUS_BAYAR,:NIP_PEREKAM,TO_DATE('$date 00:00:00', 'mm/dd/yy HH24:MI:SS'))";
			$parameters = array(":NO_PEMBAYARAN"=>$no_pembayaran,":KD_PROPINSI"=>$kd_propinsi,":KD_DATI2"=>$kd_dati2,":KD_KECAMATAN"=>$kd_kecamatan,":KD_KELURAHAN"=>$kd_kelurahan,":KD_BLOK"=>$kd_blok,":NO_URUT"=>$nomor_urut,":KD_JNS_OP"=>$kd_jenis,":JUMLAH_BAYAR"=>$total_ketetapan,":JUMLAH_DENDA"=>$total_denda,":STATUS_BAYAR"=>"1",":NIP_PEREKAM"=>Yii::app()->user->nik);
		
			$connection->createCommand($sql)->execute($parameters);
			foreach( $b_bayar as $p ){
				$connection->createCommand()
				->insert(
					'DAT_BAYAR_SPPT_DETAIL',
					array(
						'NOMOR_PEMBAYARAN'=>$no_pembayaran,
						'TAHUN_SPPT'=>$p['tahun'],
						'JUMLAH_BAYAR'=>$p['ketetapan'],
						'JUMLAH_DENDA'=>$p['denda'],
					)
				);
			}
			foreach( $b_bayar as $p ){
				$sqlupdatepembayaran = "insert into PEMBAYARAN_SPPT 
				(KD_PROPINSI,KD_DATI2,KD_KECAMATAN,KD_KELURAHAN,KD_BLOK,NO_URUT,KD_JNS_OP,THN_PAJAK_SPPT,PEMBAYARAN_SPPT_KE,KD_KANWIL,KD_KANTOR,KD_TP,DENDA_SPPT,JML_SPPT_YG_DIBAYAR,TGL_PEMBAYARAN_SPPT,TGL_REKAM_BYR_SPPT,NIP_REKAM_BYR_SPPT) values 
				(:KD_PROPINSI,:KD_DATI2, :KD_KECAMATAN, :KD_KELURAHAN,:KD_BLOK, :NO_URUT,:KD_JNS_OP,:THN_PAJAK_SPPT,:PEMBAYARAN_SPPT_KE,:KD_KANWIL,:KD_KANTOR,:KD_TP,:DENDA_SPPT,:JML_SPPT_YG_DIBAYAR,TO_DATE('$date 00:00:00', 'mm/dd/yy HH24:MI:SS'),TO_DATE('$date 00:00:00', 'mm/dd/yy HH24:MI:SS'),:NIP_REKAM_BYR_SPPT)";
				$params = array(":KD_PROPINSI"=>$kd_propinsi,":KD_DATI2"=>$kd_dati2,":KD_KECAMATAN"=>$kd_kecamatan,":KD_KELURAHAN"=>$kd_kelurahan,":KD_BLOK"=>$kd_blok,":NO_URUT"=>$nomor_urut,":KD_JNS_OP"=>$kd_jenis,":THN_PAJAK_SPPT"=>$p['tahun'],":PEMBAYARAN_SPPT_KE"=>1,":KD_KANWIL"=>$p['KD_KANWIL'],":KD_KANTOR"=>$p['KD_KANTOR'],":KD_TP"=>$p['KD_TP'],":DENDA_SPPT"=>$p['denda'],":JML_SPPT_YG_DIBAYAR"=>$p['ketetapan'] + $p['denda'],":NIP_REKAM_BYR_SPPT"=>Yii::app()->user->nik);
				$connection->createCommand($sqlupdatepembayaran)->execute($params);
				
			}
			/*foreach( $b_bayar as $p ){
				$sqlupdateSPPT = "UPDATE SPPT SET STATUS_PEMBAYARAN_SPPT = '1' WHERE KD_PROPINSI = '".$kd_propinsi."' AND KD_DATI2 = '".$kd_dati2."' AND KD_KECAMATAN = '".$kd_kecamatan."' AND KD_KELURAHAN = '".$kd_kelurahan."' AND KD_BLOK='".$kd_blok."' AND NO_URUT = '".$nomor_urut."' AND KD_JNS_OP = '".$kd_jenis."' AND THN_PAJAK_SPPT ='".$p['tahun']."' AND ROWNUM <= 1";
				$connection->createCommand($sqlupdateSPPT)->execute();
			}*/
			$transaction->commit();
			$status = true;
		}catch(Exception $e){
		   $transaction->rollBack();
		}
		return [ 'status' => $status,'NOMOR_PEMBAYARAN' => $no_pembayaran ];
	}
	function get_jatuh_tempo($nop,$tahun){
		$nop = str_replace("-",".",$nop);
		list($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$no_urut,$kd_jenis) = explode(".",$nop);
		$sql = "select 
					
to_char(TGL_JATUH_TEMPO_SPPT, 'DD-MON-YYYY')	AS TGL_JATUH_TEMPO_SPPT				
				from 
					SPPT 
				where 
					KD_PROPINSI = '$kd_propinsi' 
					and KD_DATI2 = '$kd_dati2' 
					and KD_KECAMATAN = '$kd_kecamatan' 
					and KD_KELURAHAN = '$kd_kelurahan'
					and KD_BLOK = '$kd_blok'
					and NO_URUT = '$no_urut'
					and KD_JNS_OP = '$kd_jenis'
					AND THN_PAJAK_SPPT = '$tahun' AND ROWNUM <= 1";
		return  Yii::app()->dbOracle->createCommand($sql)->queryScalar();
	}
	function getPrintData($nomor_pembayaran){
		$oci = Yii::app()->dbOracle;
		$sql = "select 
					A.KD_PROPINSI||'.'||A.KD_DATI2||'.'||A.KD_KECAMATAN||'.'||
					A.KD_KELURAHAN||'.'||A.KD_BLOK||'-'||A.NO_URUT||'.'||A.KD_JNS_OP NOP,
					A.THN_PAJAK_SPPT,
					A.JML_SPPT_YG_DIBAYAR,
					A.DENDA_SPPT
				from 
					PEMBAYARAN_SPPT A,DAT_BAYAR_SPPT B, DAT_BAYAR_SPPT_DETAIL C
				WHERE 
					A.KD_PROPINSI = B.KD_PROPINSI
					AND A.KD_DATI2 = B.KD_DATI2
					AND A.KD_KECAMATAN = B.KD_KECAMATAN
					AND A.KD_KELURAHAN = B.KD_KELURAHAN
					AND A.KD_BLOK = B.KD_BLOK
					AND A.NO_URUT = B.NO_URUT
					AND A.KD_JNS_OP = B.KD_JNS_OP
					AND B.NO_PEMBAYARAN = C.NOMOR_PEMBAYARAN
					AND A.THN_PAJAK_SPPT = C.TAHUN_SPPT
					AND B.NO_PEMBAYARAN = '".$nomor_pembayaran."'
				ORDER BY A.THN_PAJAK_SPPT DESC";
		$command = $oci->createCommand($sql);
		return $command->queryAll();
	}
	function getPembayaranByNopem($nomor_pembayaran){
		$oci = Yii::app()->dbOracle;
		$sql = "select 
					A.KD_PROPINSI,
					A.KD_DATI2,
					A.KD_KECAMATAN,
					A.KD_KELURAHAN,
					A.KD_BLOK,
					A.NO_URUT,
					A.KD_JNS_OP,
					to_char(A.DATE_CREATED, 'DD-MON-YYYY')  AS TANGGAL_BAYAR
				from 
					DAT_BAYAR_SPPT A
				WHERE 
					 A.NO_PEMBAYARAN = '".$nomor_pembayaran."' ";
		$command = $oci->createCommand($sql);
		return $command->queryAll();
	}
	function getPrintData2($nop){
		$oci = Yii::app()->dbOracle;
		$nop = str_replace("-",".",$nop);
		list($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$no_urut,$kd_jenis) = explode(".",$nop);
		$sql = "select 
					A.KD_PROPINSI||'.'||A.KD_DATI2||'.'||A.KD_KECAMATAN||'.'||
					A.KD_KELURAHAN||'.'||A.KD_BLOK||'-'||A.NO_URUT||'.'||A.KD_JNS_OP NOP,
					A.THN_PAJAK_SPPT,
					A.JML_SPPT_YG_DIBAYAR,
					A.DENDA_SPPT
					
				from 
					PEMBAYARAN_SPPT A
				WHERE 
					KD_PROPINSI = '$kd_propinsi' 
					AND A.KD_DATI2 = '$kd_dati2' 
					AND A.KD_KECAMATAN = '$kd_kecamatan' 
					AND A.KD_KELURAHAN = '$kd_kelurahan'
					AND A.KD_BLOK = '$kd_blok'
					AND A.NO_URUT = '$no_urut'
					AND A.KD_JNS_OP = '$kd_jenis'
					
				ORDER BY A.THN_PAJAK_SPPT DESC";
		$command = $oci->createCommand($sql);
		return $command->queryAll();
	}
	function getPembayaranByNonop($nop){
		$oci = Yii::app()->dbOracle;
		$nop = str_replace("-",".",$nop);
		list($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$no_urut,$kd_jenis) = explode(".",$nop);
		$sql = "select * from PEMBAYARAN_SPPT
		 		where
		 			KD_PROPINSI = '$kd_propinsi' 
					AND KD_DATI2 = '$kd_dati2' 
					AND KD_KECAMATAN = '$kd_kecamatan' 
					AND KD_KELURAHAN = '$kd_kelurahan'
					AND KD_BLOK = '$kd_blok'
					AND NO_URUT = '$no_urut'
					AND KD_JNS_OP = '$kd_jenis'
												 ";
		$command = $oci->createCommand($sql);
		return $command->queryAll();
	}
}

?>