<?php

class HistoryBayarController extends Controller
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
    return RolesMenu::actionRule('HistoryBayar'); 
  }
  public function actionIndex(){
    $nop="";
   
    
    $model=new LaporanEvaluasi;
    $model->unsetAttributes(); 
    $model->tahun = date("Y");

  
   
    $model->is_pagination = array( 'pageSize'=>10); 
    if(isset($_GET['nop'])){
      $nop = $_GET['nop'];
      
      $model->nop= $nop;
      $model->tahun="";
      
      if(empty($nop)){
      $model->tahun = date("Y");
      }

     }

     if( Yii::app()->request->isAjaxRequest ){
        $this->renderPartial('_rgridview', array('model'=>$model),false,true);
    
      
    }else{
      $this->render('admin',array(
        'model'=>$model
      ));
    }
  }
  public function actionCeknop(){
    $nop =  Yii::app()->request->getPost('nop');
    if( $nop == "" ){
      return;
    }
    $noparray = Yii::app()->pembayaran->explodeNope($nop);
    if( $noparray['status'] == false ){
      return;
    }
    $nops = $noparray['data'];
     $kd_propinsi   = $nops[0];
     $kd_dati2    = $nops[1];
    $kd_kecamatan   = $nops[2];
    $kd_kelurahan   = $nops[3];
    $kd_blok    = $nops[4];
    $nomor_urut   = $nops[5];
    $kd_jenis     = $nops[6];
    

    $perubahanNop = new PerubahanNop;
    $perubahanNop->kd_propinsi = $kd_propinsi;
    $perubahanNop->kd_dati2 = $kd_dati2;
    $perubahanNop->kecamatan = $kd_kecamatan;
    $perubahanNop->kelurahan = $kd_kelurahan;
    $perubahanNop->nomor_urut = $nomor_urut;
    $perubahanNop->blok = $kd_blok;
    $perubahanNop->kd_jenis_op = $kd_jenis;
    $perubahanNop->is_pagination = false;
    
    $perubahanNop = $perubahanNop->search();
      $data = $perubahanNop->getData();
    if( count($data) > 0 ){
      echo CJSON::encode(['status'=>'nop_berubah','nop'=>$data[0]['NOP'],'tanggal'=>$data[0]['TGL_PERUBAHAN_NOP']]);
      return;
    }
      
          

          if( count($nop) > 0 ){
              
          
          
            $url=Yii::app()->createUrl('administrator/historybayar/index',array(
              'nop'=>$nop,
              ));
            $response = ["status"=>'ok-update','msg'=>'Data Ditemukan','url'=>$url];
            echo CJSON::encode($response);
            Yii::app()->end();
            return;
          }
            $response = ["status"=>'error','msg'=>'Data Tidak Ada'];
            echo CJSON::encode($response);
            Yii::app()->end();
            return;
          
      
          
        
        
  }
  public function actionExport(){
   $model=new LaporanEvaluasi('searchRekapitulasi');
    $model->unsetAttributes();
    $model->nop = @$_GET['nop'];
   
    

    $filename = 'LaporanEvaluasi';
    if( !empty($model->nop)){
      if( is_array($model->nop)){
        $filename = 'LaporanEvaluasi '.implode("-",$model->nop);

 
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
