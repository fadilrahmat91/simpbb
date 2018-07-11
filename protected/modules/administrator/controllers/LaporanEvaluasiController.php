<?php

class LaporanEvaluasiController extends Controller
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
    return RolesMenu::actionRule('LaporanEvaluasi'); 
  }
  public function actionIndex(){
    
    $model=new LaporanEvaluasi;



    $model->unsetAttributes();  // clear any default values
    $model->tahun = date("Y");
    $model->is_pagination = array( 'pageSize'=>10);
    $keloption = "<option>Pilih Kelurahan</option>";
   //exit;
    
    if(isset($_GET['LaporanEvaluasi'])){ 



      $model->attributes = $_GET['LaporanEvaluasi'];
      $selisih= $_GET['LaporanEvaluasi']['selisih'];
    
      $model->selisih= $selisih;

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
   $model=new LaporanEvaluasi('searchRekapitulasi');
    $model->unsetAttributes();
    $model->tahun = @$_GET['tahun'];
    $model->kecamatan = @$_GET['kecamatan'];
    $model->kelurahan = @$_GET['kelurahan'];
    $model->selisih = @$_GET['selisih'];
    

    $filename = 'LaporanEvaluasi';
    if( !empty($model->tahun)){
      if( is_array($model->tahun)){
        $filename = 'LaporanEvaluasi '.implode("-",$model->tahun);

 
      }
    }
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
            'dataProvider'=>$model->searchRekapitulasi(),
            'grid_mode'=>'export',
            'title'=>$filename,
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>array(
                
         array(
        'name'=>'NOP',
        'header'=>'NOP',
       
        ), 
        array(
          'name'=>'KD_KECAMATAN',
          'header'=>'KD_KECAMATAN',
         
        ),
        array(
          'name'=>'KD_KELURAHAN',
          'header'=>'KD_KELURAHAN',
         
        ),
         array(
          'name'=>'KETETAPAN',
          'header'=>'KETETAPAN',
          'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ),
         array(
          'name'=>'DENDA_SPPT',
          'header'=>'DENDA_SPPT',
          
        ),
         array(
          'name'=>'REALISASI',
          'header'=>'REALISASI',
          'value' => 'Yii::app()->report->uangFormat($data["REALISASI"])',
        ),
          array(
          'name'=>'PIUTANG',
          'header'=>'PIUTANG',
        ),
        array(
          'name'=>'TGL_TERBIT',
          'header'=>'TANGGAL TERBIT',
        ),
         array(
          'name'=>'TGL_JATUH_TEMPO',
          'header'=>'TANGGAL JATUH TEMPO',
        ),
          array(
          'name'=>'SELISIH',
          'header'=>'SELISIH',
         
        ),
      
       
            ),
        ));
        $widget->init();
        $widget->run();
  }
}
