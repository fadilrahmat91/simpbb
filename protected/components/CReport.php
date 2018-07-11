<?php
class CReport{
	
	public function init()
    {
        date_default_timezone_set("UTC");
    }
	public function persenDenda(){
		return 2;
	}
	public function biayaAdministrasi(){
		//return 3000;
		return 0;
	}
	public function Kodepropinsi(){
		return 12;
	}
	public function getTotalDenda($jumlah,$bulan){
		$denda =  (self::persenDenda()/100)*$jumlah;
		return $denda * $bulan;
	}
	public function getPersentaseNotFormat($nilai,$total){
		if( $nilai <= 0 ){
			return 0;
		}
		if( $total <= 0 ){
			return 0;
		}
		//return (($nilai*100) / $total);
		return (($nilai/$total)*100);
	}
	public function getPersentase($nilai,$total){
		if( $nilai <= 0 ){
			return 0;
		}
		return round(($nilai*100) / $total);
	} 
	public function minimalketetapan($ketetapan, $tahun){
		$data = Yii::app()->autodata->getminimalketetapan($tahun);
		if( $data > 0 ){
			if( $ketetapan < $data ){
				return round($data);
			}
		}
		return $ketetapan;
	}
	public function Kodekabupaten(){
		return '07';
	}
	public function month($month = "" ){
		$array = [
					"JAN"=>"01","FEB"=>"02","MAR"=>"03","APR"=>"04","MAY"=>"05","JUN"=>"06","JUL"=>"07",
					"MEI"=>"05","AUG"=>"08","SEP"=>"09","OCT"=>"10","OKT"=>"10","NOV"=>"11","NOP"=>"11","DEC"=>"12","DES"=>"12"
				];
		if( $month != "" ){
			return $array[$month];
		}
		return $array;
	}
	public function tahun_mulai_simpatda(){
		return 2015;
	}
	public function monthNumber($month = "" ){
		$array = [
					"01"=>"JUN",
					"02"=>"FEB",
					"03"=>"MAR",
					"04"=>"APR",
					"05"=>"MAY",
					"06"=>"JUN",
					"07"=>"JUL",
					"08"=>"AUG",
					"09"=>"SEP",
					"10"=>"OCT",
					"11"=>"NOV",
					"12"=>"DEC"
				];
		if( $month != "" ){
			return (isset($array[$month]) ? $array[$month] : '-');
		}
		return $array;
	}
	public function getNumMonth($ts1,$ts2){
		/*$date1 = '2000-01-25';
		$date2 = '2010-02-20';
		
		$ts1 = strtotime($date1);
		$ts2 = strtotime($date2);
		*/
		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);

		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);

		return $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
		
	}
	public function getMonthDenda($month){
		if( $month > 24 ){
			return 24;
		}
		return $month;
	}
	public function isDenda($jatuh_tempo,$tanggal_sekarang){
		list($d_tempo,$b_tempo,$t_tempo) = explode("-",$jatuh_tempo);
		$b_tempo = self::month($b_tempo);
		$jatuh_tempo = $b_tempo.'/'.$d_tempo.'/'.$t_tempo;
		$jatuh_tempo = strtotime($jatuh_tempo);
		$tanggal_sekarang = strtotime($tanggal_sekarang);
		if( (int)$jatuh_tempo > (int)$tanggal_sekarang ){
			return ['status'=>true,'jatuh_tempo'=>$jatuh_tempo,'tanggal_sekarang'=>$tanggal_sekarang,'denda_bulan'=>""];
		}
		return ['status'=>false,'jatuh_tempo'=>$jatuh_tempo,'tanggal_sekarang'=>$tanggal_sekarang,'denda_bulan'=>self::getMonthDenda(self::getNumMonth($jatuh_tempo,$tanggal_sekarang))];
	}
	public function propinsi(){
		return array(self::Kodepropinsi()=>'SUMATERA UTARA');
	}
	public function kabupaten(){
		return array(self::Kodekabupaten()=>'SIMALUNGUN');
	}
	public function tahun_mulai(){
		return 1994;
	}
	public function tahun_akhir(){
		return date('Y');
	}
	private function queryKecamatan($kecamatan_kode=""){
		  
		$sql = "SELECT * FROM REF_KECAMATAN" ;
		$sql .= " Where 1 = 1 " ;
		if( $kecamatan_kode != "" ){
			$sql .= " AND KD_KECAMATAN = '".$kecamatan_kode."' " ;
		}
		return $sql;
	}


	public function kecamatan( $kecamatan_kode = ""){
		$oci = Yii::app()->dbOracle;  
		$sql = self::queryKecamatan($kecamatan_kode);
		$command = $oci->createCommand($sql);       
		return $command->query();
	}





	// private function queryPerekam($perekam=""){
		  
	// 	$sql = "SELECT * FROM DAT_BAYAR_SPPT" ;
	// 	$sql .= " Where 1 = 1" ;
	// 	if( $perekam != "" ){
	// 		$sql .= " AND NIP_PEREKAM = '".$perekam."' GROUP BY NIP_PEREKAM" ;
	// 	}
	// 	return $sql;
	// }

	// public function perekam_nip( $perekam = ""){
	// 	$oci = Yii::app()->dbOracle;  
	// 	$sql = self::queryPerekam($perekam);
	// 	$command = $oci->createCommand($sql);       
	// 	return $command->query();
	// }
	





	public function kecamatanName( $kecamatan_kode ){
		$kecamatan = self::kecamatan($kecamatan_kode);
		$kecname = "";
		foreach( $kecamatan as $p ){
			$kecname = $p['NM_KECAMATAN'];
		}
		return $kecname;
	}
	Public function querynip_perekam($perekam=""){
		  
		$sql = "SELECT * FROM DAT_BAYAR_SPPT";
		$sql .= " Where 1 = 1 " ;
		if( $perekam != "" ){
			$sql .= " AND NIP_PEREKAM = '".$perekam."'  GROUP BY NIP_PEREKAM" ;
		}

		return $sql;	
	}
	public function namaperekam( $perekam = ""){
		$oci = Yii::app()->dbOracle;  
		$sql = self::querynip_perekam($perekam);
		$command = $oci->createCommand($sql);       
		return $command->query();
	}
	public function kelurahanName( $kecamatan, $kelurahan_kode ){
		$kelurahan = self::kelurahan($kecamatan,$kelurahan_kode);
		$kelname = "";
		foreach( $kelurahan as $p ){
			$kelname = $p['NM_KELURAHAN'];
		}
		return $kelname;
	}
	public function uangFormat($uang){
		return Yii::app()->format->formatNumber($uang,2);
	}
	public function kelurahan($kecamatan="",$kd_kelurahan=""){
		$oci = Yii::app()->dbOracle;    
		$sql = "SELECT * FROM REF_KELURAHAN";
		$sql .= " where 1=1 ";
		if( $kecamatan != "" ){
			$sql .= " and KD_KECAMATAN = '".$kecamatan."' ";
		}
		if( $kd_kelurahan != "" ){
			$sql .= " and KD_KELURAHAN = '".$kd_kelurahan."' ";
		}
		$sql .= " ORDER BY KD_KECAMATAN ASC" ;
 
		$command = $oci->createCommand($sql);       
		return $command->queryAll();
	}
	public function kelurahanOption($kecamatan, $kelurahandefault=""){
		$kelurahan = Yii::app()->report->kelurahan($kecamatan);
		$html = "";
		foreach( $kelurahan as $p ){
			$html .= "<option ".( $kelurahandefault == $p['KD_KELURAHAN'] ? 'selected' : '' )." value='".$p['KD_KELURAHAN']."'>".$p['KD_KELURAHAN']."-".$p['NM_KELURAHAN']."</option>";
		}
		return $html;
	}
	public function loopKecamatanCategories($kecamatan){
		$data = [];
		$nilai = [];
		foreach($kecamatan as $row) {
			$data[$row['KD_KECAMATAN']] = $row['NM_KECAMATAN'];
			$nilai[$row['KD_KECAMATAN']] = 0;
		}
		return ['cat'=>$data,'nilai'=>$nilai];
	}
	public function loopKelurahanCategories($kecamatan){
		$data = [];
		$nilai = [];
		foreach($kecamatan as $row) {
			$data[$row['KD_KECAMATAN'].$row['KD_KELURAHAN']] = $row['NM_KELURAHAN'];
			$nilai[$row['KD_KECAMATAN'].$row['KD_KELURAHAN']] = 0;
		}
		return ['cat'=>$data,'nilai'=>$nilai];
	}
	public function getalltahun( $tahun = "" ){
		
		if( $tahun == "" ){
			$date = self::tahun_akhir();
		}else{
			$date = $tahun;
		}
		$tahun = [];
		$nilai = [];
		$objek = [];
		for( $n = self::tahun_mulai(); $n <= $date; $n++){
			$tahun[] = $n;
			$nilai[$n] = 0;
			$objek[$n] = 0;
		}
		return ['tahun'=>$tahun,'nilai'=>$nilai,'objek'=>$objek];
	}
	public function getRealIp()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	public function get_nama_alamat($subjek_id,$need)
	{
		$oci = Yii::app()->dbOracle;    
		$sql = "SELECT $need FROM DAT_SUBJEK_PAJAK
				WHERE SUBJEK_PAJAK_ID='".$subjek_id."' ";
		
		return $oci->createCommand($sql)->queryScalar();       
		
	}
}

?>