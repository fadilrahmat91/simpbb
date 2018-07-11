<?php
/* Pembayaran SPPT yang tidak ada SPPT/NOP */
class EvaluasiBayarTidakSpptController extends Controller
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
    return RolesMenu::actionRule('EvaluasiBayarTidakSppt'); 
  }
  public function actionIndex(){
    
    $model=new EvaluasiBayarTidakSppt;
    $model->unsetAttributes();  // clear any default values
    $model->tahun = date("Y");
    $keloption = "<option>Pilih Kelurahan</option>";
    
    if(isset($_GET['EvaluasiBayarTidakSppt'])){ 
      $model->attributes = $_GET['EvaluasiBayarTidakSppt'];
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
    $model=new EvaluasiBayarTidakSppt;
    $model->unsetAttributes();
    $model->tahun = $_GET['tahun'];
    $model->kecamatan = $_GET['kecamatan'];
    $model->kelurahan = $_GET['kelurahan'];
    $filename = 'EvaluasiBayarTidakSppt ('.$model->tahun.')';
    $factory = new CWidgetFactory();    
        $widget = $factory->createWidget($this, 'ext.EExcelView', array(
            'dataProvider'=>$model->searchRekapitulasi(),
            'grid_mode'=>'export',
            'title'=>'EvaluasiBayarTidakSppt ('.$model->tahun.')',
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
                  'name'=>'KD_BLOK',
                  'header'=>'KODE BLOK',
                ),
                array(
                  'name'=>'NO_URUT',
                  'header'=>'NOMOR URUT',
                ),
                array(
                  'name'=>'KD_JENIS_OP',
                  'header'=>'KODE JENIS OP',
                ),
                array(
                  'name'=>'THN_PAJAK_SPPT',
                  'header'=>'TAHUN PAJAK SPPT',
                ),
            ),
        ));
        $widget->init();
        $widget->run();
  }
  public function actionExportPdf(){
    $model=new EvaluasiBayarTidakSppt('EvaluasiBayarTidakSppt');
    $model->unsetAttributes();
    $model->tahun = $_GET['tahun'];
    $model->kecamatan = $_GET['kecamatan'];
    $model->kelurahan = $_GET['kelurahan'];
    $model->is_pagination = false;
    $data = $model->searchRekapitulasi()->getData();
    $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'legal', 'fr');
    $html2pdf->WriteHTML($this->renderPartial('_exportPdf', array('data'=>$data), true));
    $html2pdf->Output('EvaluasiBayarTidakSppt-'.date('Y-m-d H:i:s').'.pdf', 'D');
  }
}
