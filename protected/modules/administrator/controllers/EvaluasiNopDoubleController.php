<?php
/* Evaluasi NOP Double */
class EvaluasiNopDoubleController extends Controller
{
  public $layout='//layouts/column2';
  public function filters()
  {
    return array(
      'accessControl', // perform access control for CRUD operations
      'postOnly + delete', // we only allow deletion via POST request.
    );
  }
  public function accessRules()
  {
    return RolesMenu::actionRule('EvaluasiNopDouble'); 
  }
  public function actionIndex(){
    
    $model=new EvaluasiNopDouble;
    $model->unsetAttributes();  // clear any default values
    $model->tahun = date("Y");
    
    if(isset($_GET['EvaluasiNopDouble'])){ 
      $model->attributes = $_GET['EvaluasiNopDouble'];
    }
    if( Yii::app()->request->isAjaxRequest ){
      $this->renderPartial('_rgridview', array('model'=>$model),false,true);
    }else{
      $this->render('admin',array(
        'model'=>$model
      ));
    }
  }
  public function actionExport(){
    $model=new EvaluasiNopDouble;
    $model->unsetAttributes();
    $model->tahun = $_GET['tahun'];
    $filename = 'EvaluasiNopDouble ('.$model->tahun.')';
    $factory = new CWidgetFactory();    
        $widget = $factory->createWidget($this, 'ext.EExcelView', array(
            'dataProvider'=>$model->searchRekapitulasi(),
            'grid_mode'=>'export',
            'title'=>'EvaluasiNopDouble ('.$model->tahun.')',
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>array(
                  //'promotioncode',
                array(
                  'name'=>'THN_PAJAK_SPPT',
                  'header'=>'TAHUN PAJAK SPPT ',
                ),
                array(
                  'name'=>'NOP_ASAL',
                  'header'=>'NOP ASAL ',
                ),
                array(
                  'name'=>'STATUS_NOP_ASAL',
                  'header'=>'STATUS NOP ASAL ',
                ),
                array(
                  'name'=>'NOP_PERUBAHAN',
                  'header'=>'NOP PERUBAHAN',
                ),
                array(
                  'name'=>'STATUS_NOP_PERUBAHAN',
                  'header'=>'STATUS NOP PERUBAHAN ',
                ),
            ),
        ));
        $widget->init();
        $widget->run();
  }
  public function actionExportPdf(){
    $model=new EvaluasiNopDouble('EvaluasiNopDouble');
    $model->unsetAttributes();
    $model->tahun = $_GET['tahun'];
    $model->is_pagination = false;
    $data = $model->searchRekapitulasi()->getData();
    $html2pdf = Yii::app()->ePdf->HTML2PDF('P', 'legal', 'fr');
    $html2pdf->WriteHTML($this->renderPartial('_exportPdf', array('data'=>$data, ), true));
    $html2pdf->Output('EvaluasiNopDouble-'.date('Y-m-d H:i:s').'.pdf', 'D');
  }
}