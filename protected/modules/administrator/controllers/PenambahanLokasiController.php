<?php

class PenambahanLokasiController extends Controller
{
	public $layout='//layouts/column2';
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	public function accessRules()
	{
		return RolesMenu::actionRule('penambahanLokasi'); 
	}
	public function actionIndex(){
		$model = new LaporanObjekPajakLokasi('search');
		$model->userId = Yii::app()->user->nik;
		$this->render('index',array(
			'model'=>$model
		));
	}
	public function actionCreate(){
		$model = new ObjekPajakForm;
		if(isset($_POST['ObjekPajakForm'])){
			$model->attributes = $_POST['ObjekPajakForm'];
			if(!$model->validate()){
				$error = CJSON::decode(CActiveForm::validate($model));
				$msg = "<ul>";
				foreach( $error as $p ){
					$msg .= "<li>".$p[0]."</li>";
				}
				$msg .= "</ul>";
				$response = ["status"=>'error','msg'=>$msg];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;				
			}
			
			$nop = $model->nop;
			$nops = $nop;
			$nop = Yii::app()->pembayaran->explodeNope($nop);
			if( $nop['status'] == false ){
				$response = ["status"=>'error','msg'=>"NOP Tidak Valid"];
				echo CJSON::encode($response);
				Yii::app()->end();
				return;
			}
			$nop = $nop['data'];
			$kd_propinsi 	= $nop[0];
			$kd_dati2 		= $nop[1];
			$kd_kecamatan 	= $nop[2];
			$kd_kelurahan 	= $nop[3];
			$kd_blok 		= $nop[4];
			$nomor_urut 	= $nop[5];
			$kd_jenis 		= $nop[6];
			$data = Yii::app()->objekPajak->getObjekPajakLimit($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis);
			
			if( count($data) > 0 ){
				Yii::app()->objekPajak->update_objek_pajak_lat_long($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis,$model->lattitude,$model->longitude,Yii::app()->user->nik);
				$nops = explode("-",$nops);
				$x = ['status'=>'info','msg'=>"Lokasi Berhasil diperbaharui",'NOP'=>$nops[0]];
				echo CJSON::encode($x);
				Yii::app()->end();
			}else{
				$x = ['status'=>'error','msg'=>"Objek Pajak tidak ditemukan"];
				echo CJSON::encode($x);
				Yii::app()->end();
			}
			return;
		}else if( isset($_POST['noppencarian'])){
			$nop = $_POST['noppencarian'];
			
			$nops = $nop;
			if( $nop == "" ){
				return;
			}
			$nop = Yii::app()->pembayaran->explodeNope($nop);
			if( $nop['status'] == false ){
				$x = ['status'=>'error','msg'=>"NOP tidak Valid"];
				echo CJSON::encode($x);
				Yii::app()->end();
				return;
			}
			$nop = $nop['data'];
			$kd_propinsi 	= $nop[0];
			$kd_dati2 		= $nop[1];
			$kd_kecamatan 	= $nop[2];
			$kd_kelurahan 	= $nop[3];
			$kd_blok 		= $nop[4];
			$nomor_urut 	= $nop[5];
			$kd_jenis 		= $nop[6];
			
			$data = Yii::app()->objekPajak->getObjekPajakLimit($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$nomor_urut,$kd_jenis);
			
			if( count($data) > 0 ){
				$nops = explode("-",$nops);
				$x = ['status'=>'info','msg'=>'Lokasi NOP Ditemukan','LATTITUDE'=>$data[0]['LATTITUDE'],'LONGITUDE'=>$data[0]['LONGITUDE'],'NOP'=>$nops[0]];
				echo CJSON::encode($x,JSON_NUMERIC_CHECK);
				Yii::app()->end();
			}else{
				$x = ['status'=>'error','msg'=>"NOP tidak ditemukan atau Lokasi Belum ditentukan"];
				echo CJSON::encode($x);
				Yii::app()->end();
			}
			
			return;
		}
		
		$this->render('create',array(
			'model' => $model
		));
	}
	
}