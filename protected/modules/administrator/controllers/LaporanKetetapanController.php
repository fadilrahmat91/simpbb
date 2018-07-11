<?php

class laporanKetetapanController extends Controller
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
		return RolesMenu::actionRule('laporanKetetapan'); 
	}
	public function actionIndex(){
		
		$model=new LaporanKetetapan;
		$model->unsetAttributes();  // clear any default values
		$model->tahun = date("Y");
		$model->is_pagination = array( 'pageSize'=>10);
		$keloption = "<option>Pilih Kelurahan</option>";
		
		if(isset($_GET['LaporanKetetapan'])){ 
			$model->attributes = $_GET['LaporanKetetapan'];
			if( (int)$model->kelurahan > 0 && (int)$model->kecamatan > 0){
				$keloption .= Yii::app()->report->kelurahanOption($model->kecamatan,$model->kelurahan);
			}
		}
		if( Yii::app()->request->isAjaxRequest ){
			$this->renderPartial('_rgridview', array('model'=>$model),false,true);
		}else{
			$this->render('admin',array(
				'model'=>$model,
				'keloption' => $keloption
			));
		}
	}
	public function actionExport(){
		$model=new LaporanKetetapan;
		$model->unsetAttributes();
		$model->tahun = $_GET['tahun'];
		$model->kecamatan = $_GET['kecamatan'];
		$model->kelurahan = $_GET['kelurahan'];
		$model->status_bayar = $_GET['status_bayar'];
		$model->tanggal_terbit = $_GET['tanggal_terbit'];
		//$model->status = $_GET['status'];
		$filename = 'Ketetapan ('.$model->tahun.')';
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
            'title'=>'Ketetapan ('.$model->tahun.')',
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
			            'name'=>'NOMOR_ID',
			            'header'=>'NOMOR ID',
			        ),
					array(
			            'name'=>'NAMA_WP',
			            'header'=>'NAMA WP',
			        ),
					array(
						'name'=>'KECAMATAN',
						'header'=>'KECAMATAN',
						'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
					),
					array(
						'name'=>'KEL_DESA',
						'header'=>'KEL/DESA',
						'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',
					),
					array(
			            'name'=>'ALAMAT_WP',
			            'header'=>'ALAMAT WP',
			        ),	
					array(
			            'name'=>'ALAMAT_OP',
			            'header'=>'ALAMAT OP',
			        ),	
					array(
			            'name'=>'LUAS_BUMI',
			            'header'=>'LUAS BUMI',
			        ),	
					array(
			            'name'=>'LUAS_BNG',
			            'header'=>'LUAS BNG',
			        ),	
					array(
			            'name'=>'KELAS_TANAH',
			            'header'=>'KELAS TANAH',
			        ),	
					array(
			            'name'=>'KELAS_BNG',
			            'header'=>'KELAS BNG',
			        ),	
					array(
			            'name'=>'NOMOR_ID',
			            'header'=>'NOMOR ID',
			        ),	
					array(
			            'name'=>'NJOP_BUMI',
			            'header'=>'NJOP BUMI',
			        ),	
					array(
			            'name'=>'NJOP_BNG',
			            'header'=>'NJOP BNG',
			        ),
					array(
						'name' => 'NJOP',
						'header'=>'NJOP',				
					),  
					array(
						'name' => 'NJOPTKP',                     
						'header'=>'NJOPTKP'
					), 
					array(
						'name' => 'KETETAPAN',
						'header'=>'KETETAPAN',
						'value'=>'Yii::app()->report->minimalketetapan($data["KETETAPAN"],$data["TAHUN"])' 
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
					),
					array(
						'name' => 'STATUS',                     
						'header'=>'STATUS'
					)
            ),
        ));
        $widget->init();
        $widget->run();
	}
}
