<?php

class LaporanPiutangController extends Controller
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
		return RolesMenu::actionRule('LaporanPiutang'); 
	}
	public function actionIndex(){
		
		$model=new LaporanPiutang('search');
		$model->unsetAttributes();  // clear any default values
		$keloption = "<option>Pilih Kelurahan</option>";
		
		$model->is_pagination = array( 'pageSize'=>10);
		if(isset($_GET['LaporanPiutang'])){ 
			$model->attributes = $_GET['LaporanPiutang'];
			if( (int)$model->kelurahan > 0 && (int)$model->kecamatan > 0){
				$keloption .= Yii::app()->report->kelurahanOption($model->kecamatan,$model->kelurahan);
			}
		}
		if( Yii::app()->request->isAjaxRequest ){
			$this->renderPartial('_rgridview', array('model'=>$model),false,true);
		}else{
			$this->render('admin',array(
				'model'=>$model,
				'keloption'=>$keloption
			));
		}
	}
	public function actionExport(){ 
		$model=new LaporanPiutang('search');
		$model->unsetAttributes();
		$model->tahun = @$_GET['tahun'];
		$model->kecamatan = @$_GET['kecamatan'];
		$model->kelurahan = @$_GET['kelurahan'];
		$model->periode = @$_GET['periode'];
		$model->tanggal_terbit_sppt = @$_GET['tanggal_terbit_sppt'];
		//$model->status = $_GET['status'];
		$filename = 'Piutang '.$model->tahun;
		if( $model->kecamatan != '' ){
			$kecamatan = Yii::app()->report->kecamatan($model->kecamatan);
			$kecname = "";
			foreach( $kecamatan as $p ){
				$kecname = $p['NM_KECAMATAN'];
			}
			
			$filename .= '-Kecamatan '.$kecname;
		}
		$factory = new CWidgetFactory();    
        $widget = $factory->createWidget($this, 'ext.EExcelView', array(
            'dataProvider'=>$model->search(),
            'grid_mode'=>'export',
            'title'=>'Piutang ('.$model->tahun.')',
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>array(
                	//'promotioncode',
			        array(
			            'name'=>'NOP',
			            'header'=>'NOP',
			        ),
					array(
			            'name'=>'SUBJEK_ID',
			            'header'=>'SUBJEK ID',
			        ),
					array(
						'name'=>'NM_WP',
						'header'=>'NAMA WP',
						'value' => 'Yii::app()->report->get_nama_alamat($data["SUBJEK_ID"],"NM_WP")',
					),
					array(
						'name'=>'KECAMATAN',
						'header'=>'KECAMATAN',
						'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
					),
					array(
						'header'=>'KEL/DESA',
						'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',						
					),
					array(
			            'name'=>'ALAMAT_OP',
			            'header'=>'ALAMAT OP',
			        ),	
					array(
						'name' => 'PIUTANG',
						'header'=>'PIUTANG',
						//'value'=>'Yii::app()->report->minimalketetapan($data["PIUTANG"],$data["TAHUN"])' 
					),  
					array(
						'name' => 'TAHUN',                     
						'header'=>'TAHUN'
					),
					array(
						'name' => 'TGL_TERBIT',                     
						'header'=>'TGL TERBIT'
					),
					array(
						'name' => 'TGL_JTH_TEMPO',                     
						'header'=>'TGL JTH TEMPO'
					)
            ),
        ));
        $widget->init();
        $widget->run();
	}
}