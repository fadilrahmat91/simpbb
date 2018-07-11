<?php
/* Evaluasi Laporan Tahunan */
class EvaluasiLaporanTahunanController extends Controller
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
    return RolesMenu::actionRule('EvaluasiLaporanTahunan'); 
  }
  public function actionIndex(){
    
    $model=new EvaluasiLaporanTahunan;
    $model->unsetAttributes();  // clear any default values
    $model->tahun = date("Y");
    $keloption = "<option>Pilih Kelurahan</option>";
   
	if( isset($_GET['EvaluasiLaporanTahunan'])){

    // print_r($_GET['EvaluasiLaporanTahunan']);exit;
		 $model->attributes =  $_GET['EvaluasiLaporanTahunan'];
     if( (int)$model->kelurahan > 0 && (int)$model->kecamatan > 0){
        $keloption = Yii::app()->report->kelurahanOption($model->kecamatan,$model->kelurahan);
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
    $model=new EvaluasiLaporanTahunan;
    $model->unsetAttributes();
    $model->tahun = $_GET['tahun'];
    $model->kecamatan = $_GET['kecamatan'];
    $model->kelurahan = $_GET['kelurahan'];
    $filename = 'EvaluasiLaporanTahunan ('.$model->tahun.')';
    $factory = new CWidgetFactory();    
        $widget = $factory->createWidget($this, 'ext.EExcelView', array(
            'dataProvider'=>$model->searchRekapitulasi(),
            'grid_mode'=>'export',
            'title'=>'EvaluasiLaporanTahunan ('.$model->tahun.')',
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>array(
                  //'promotioncode',
                array(
                  'name'=>'TAHUN',
                  'header'=>'TAHUN',
                ),
                array(
                  'name'=>'KD_KECAMATAN',
                  'header'=>'KECAMATAN',
                  'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
                ),
                array(
                  'name'=>'KD_KELURAHAN',
                  'header'=>'KELURAHAN',
                  'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',
                ),
                array(
                  'name'=>'JUM_OBJEK_KETETAPAN',
                  'header'=>'JUMLAH OBJEK KETETAPAN',
                ),
                array(
                  'name'=>'KETETAPAN',
                  'header'=>'KETETAPAN',
                  'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
                ),
                array(
                  'name'=>'JUM_OBJEK_PIUTANG',
                  'header'=>'JUMLAH OBJEK PIUTANG',
                ),
                array(
                  'name'=>'PIUTANG',
                  'header'=>'PIUTANG',
                  'value' => 'Yii::app()->report->uangFormat($data["PIUTANG"])',
                ),
                array(
                  'name'=>'JUM_OBJEK_REALISASI',
                  'header'=>'JUMLAH OBJEK REALISASI',
                ),
                array(
                  'name'=>'REALISASI',
                  'header'=>'REALISASI',
                  'value' => 'Yii::app()->report->uangFormat($data["REALISASI"])',
                ),
                array(
                  'name'=>'SELISIH',
                  'header'=>'SELISIH',
                  'value' => 'Yii::app()->report->uangFormat($data["SELISIH"])',
                )
            ),
        ));
        $widget->init();
        $widget->run();
  }
  public function actionExportPdf(){
    $model=new EvaluasiLaporanTahunan('EvaluasiLaporanTahunan');
    $model->unsetAttributes();
    $model->tahun = $_GET['tahun'];
    $model->kecamatan = $_GET['kecamatan'];
    $model->kelurahan = $_GET['kelurahan'];
    $model->is_pagination = false;
    $data = $model->searchRekapitulasi()->getData();
    $html2pdf = Yii::app()->ePdf->HTML2PDF('L', 'legal', 'fr');
    $html2pdf->WriteHTML($this->renderPartial('_exportPdf', array('data'=>$data), true));
    $html2pdf->Output('EvaluasiLaporanTahunan-'.date('Y-m-d H:i:s').'.pdf', 'D');
  }
}
