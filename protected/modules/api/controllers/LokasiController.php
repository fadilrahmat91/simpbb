<?php

class LokasiController extends Controller
{
	public function actionDataoptambahan(){
		if(!self::check_auth(@$_POST['keyNumber'],true)){
			return false;
		};
		
		$model = new LaporanObjekPajakLokasi('search');
		$model->userId = Yii::app()->user->nik;
		if( isset($_POST['lastDate'])){
			$model->lastdate = @$_POST['lastDate'];
		}
		$model = $model->search();
		$data = $model->getData();
		
		$response = array();
		$x = ['code'=>'ok','data'=>$data,'nik'=>Yii::app()->user->nik];
		array_push($response,$x);
		echo json_encode(
			$response
		);
		
	}
	public function actionSaveLatLong(){
		if(!self::check_auth(@$_POST['keyNumber'],true)){
			return false;
		};
		$longitude = @$_POST['longitude'];
		$lattitude = @$_POST['lattitude'];
		$kd_propinsi = Yii::app()->report->Kodepropinsi();
		$kd_dati2    = Yii::app()->report->Kodekabupaten();
		$kecamatan = @$_POST['kecamatan'];
		$kelurahan = @$_POST['kelurahan'];
		$kdblok    = @$_POST['kdblok'];
		$nomorurut = @$_POST['nomorurut'];
		$kdjenisop = @$_POST['kdjenisop'];
		
		$data = Yii::app()->objekPajak->getObjekPajakLimit($kd_propinsi,$kd_dati2,$kecamatan,$kelurahan,$kdblok,$nomorurut,$kdjenisop);
		
		$response = array();
		if( count($data) > 0 ){
			Yii::app()->objekPajak->update_objek_pajak_lat_long($kd_propinsi,$kd_dati2,$kecamatan,$kelurahan,$kdblok,$nomorurut,$kdjenisop,$lattitude,$longitude,Yii::app()->user->nik);
			$x = ['code'=>'ok','message'=>"Lokasi Berhasil diperbaharui"];
		}else{
			$x = ['code'=>'error','message'=>"Objek Pajak tidak ditemukan"];
		}
		array_push($response,$x);
		echo json_encode(
			$response
		);
	}
	public function actionKecamatan(){
		if(!self::check_auth(@$_POST['keyNumber'])){
			return false;
		};
		$kecamatan = Yii::app()->report->kecamatan();
		
		$arrays = [];
		foreach( $kecamatan as $p ){
			$array = [];
			$array['ID'] 	= $p['KD_KECAMATAN'];
			$array['NAMA'] 	= $p['KD_KECAMATAN']." - ".$p['NM_KECAMATAN'];
			$arrays[] = $array;
		}
		$response = array();
		$x = ['code'=>'ok','data'=>$arrays];
		array_push($response,$x);
		echo json_encode(
			$response
		);
	}
	public function actionKelurahan(){
		if(!self::check_auth(@$_POST['keyNumber'])){
			return false;
		};
		$kecamatanID = @$_POST['kodeKecamatan'];
		$kelurahan = Yii::app()->report->kelurahan($kecamatanID);
		$data = @$_POST;
		$response = array();
		$arrays = [];
		foreach( $kelurahan as $p ){
			$array = [];
			$array['ID'] 	= $p['KD_KELURAHAN'];
			$array['NAMA'] 	= $p['KD_KELURAHAN']." - ".$p['NM_KELURAHAN'];
			$arrays[] = $array;
		}
		$x = ['code'=>'ok','data'=>$arrays,'datax'=>$data];
		array_push($response,$x);
		echo json_encode(
			$response
		);
	}
	public function actionUbahDataJatuhTempo(){
		// JGN DIHAPUS
		$data = Yii::app()->objekPajak->ubahDataJatuhTempo();
	}
}