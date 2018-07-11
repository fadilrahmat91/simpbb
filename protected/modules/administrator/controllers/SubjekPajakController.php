<?php
/* Evaluasi Laporan Tahunan */
class SubjekPajakController extends Controller
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
    return RolesMenu::actionRule('SubjekPajak'); 
  }

  public function actionIndex(){
    $model=new SubjekPajak;
    $model->unsetAttributes();  // clear any default values

	if( isset($_GET['SubjekPajak'])){
		 $model->attributes =  $_GET['SubjekPajak'];
	}
    if( Yii::app()->request->isAjaxRequest ){
      $this->renderPartial('_rgridview', array('model'=>$model),false,true);
    }else{
      $this->render('admin',array(
        'model'=>$model
      ));
    }
  }
  /**
   * Manages all models.
   */
  public function actionAdmin()
  {
    $model=new SubjekPajak('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['SubjekPajak']))
      $model->attributes=$_GET['SubjekPajak'];

    $this->render('admin',array(
      'model'=>$model,
    ));
  }

  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id)
  {
    $this->render('view',array(
      'model'=>$this->loadModel($id),
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
    $model=new SubjekPajak('insert');
    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(isset($_POST['SubjekPajak']))
    {
      $model->attributes=$_POST['SubjekPajak'];
      if ($model->attributes) {
        $this->redirect(array('create','subjek_pajak_id'=>$model->subjek_pajak_id));
      }
    }

    $this->render('create',array(
      'model'=>$model,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id)
  {
      $subjek_pajak_id = $_GET[''];
      $nm_wp = $_GET[''];
      $jalan_wp = $_GET[''];
      $blok_kav_no_wp = $_GET[''];
      $rw_wp = $_GET[''];
      $rt_wp = $_GET[''];
      $kelurahan_wp = $_GET[''];
      $kota_wp = $_GET[''];
      $kd_pos_wp = $_GET[''];
      $telp_wp = $_GET[''];
      $npwp = $_GET[''];
      $status_pekerjaan_wp = $_GET[''];
      $email = $_GET[''];
      $password = $_GET[''];
    $model=$this->loadModel($id);

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if(isset($_POST['SubjekPajak']))
    {
      $model->attributes=$_POST['SubjekPajak'];
      if($model->save())
        $this->redirect(array('view','id'=>$model->id));
    }

    $this->render('update',array(
      'model'=>$model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id)
  {
    $this->loadModel($id)->delete();
    
    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    if(!isset($_GET['ajax']))
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer $id the ID of the model to be loaded
   * @return SubjekPajak the loaded model
   * @throws CHttpException
   */
  public function loadModel($id)
  {
    $model=SubjekPajak::model()->findByPk($id);

    if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $model;
  }

  public function actionExport(){
    $model=new SubjekPajak;
    $model->unsetAttributes();
    if( isset($_GET['subjek_pajak_id'])){
       $model->subjek_pajak_id =  $_GET['subjek_pajak_id'];
    }
    if( isset($_GET['nama_wp'])){
       $model->nama_wp =  $_GET['nama_wp'];
    }
    if( isset($_GET['jalan_wp'])){
       $model->jalan_wp =  $_GET['jalan_wp'];
    }
    $filename = 'SubjekPajak ('.$model->subjek_pajak_id.')';
    $factory = new CWidgetFactory();    
        $widget = $factory->createWidget($this, 'ext.EExcelView', array(
            'dataProvider'=>$model->search(),
            'grid_mode'=>'export',
            'title'=>'SubjekPajak ('.$model->subjek_pajak_id.')',
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>array(
                  //'promotioncode',
                array(
                  'name'=>'SUBJEK_PAJAK_ID',
                  'header'=>'SUBJEK PAJAK ID',
                ),
                array(
                  'name'=>'NM_WP',
                  'header'=>'NAMA WP',
                ),
                array(
                  'name'=>'JALAN_WP',
                  'header'=>'JALAN WP',
                ),
                array(
                  'name'=>'BLOK_KAV_NO_WP',
                  'header'=>'BLOK KAV NO WP',
                ),
                array(
                  'name'=>'RW_WP',
                  'header'=>'RW WP',
                ),
                array(
                  'name'=>'RT_WP',
                  'header'=>'RT WP',
                ),
                array(
                  'name'=>'KELURAHAN_WP',
                  'header'=>'KELURAHAN WP',
                ),
                array(
                  'name'=>'KOTA_WP',
                  'header'=>'KOTA WP',
                ),
                array(
                  'name'=>'KD_POS_WP',
                  'header'=>'KODE POS WP',
                ),
                array(
                  'name'=>'TELP_WP',
                  'header'=>'TELP WP',
                ),
                array(
                  'name'=>'NPWP',
                  'header'=>'NPWP',
                ),
                array(
                  'name'=>'STATUS_PEKERJAAN_WP',
                  'header'=>'STATUS PEKERJAAN WP',
                ),
            ),
        ));
        $widget->init();
        $widget->run();
  }

  public function actionExportPdf(){
    $model=new SubjekPajak('SubjekPajak');
    $model->unsetAttributes();
    if( isset($_GET['subjek_pajak_id'])){
       $model->subjek_pajak_id =  $_GET['subjek_pajak_id'];
    }
    if( isset($_GET['nama_wp'])){
       $model->nama_wp =  $_GET['nama_wp'];
    }
    if( isset($_GET['jalan_wp'])){
       $model->jalan_wp =  $_GET['jalan_wp'];
    }
    $model->is_pagination = false;
    $data = $model->search()->getData();
    $html2pdf = Yii::app()->ePdf->HTML2PDF('L', 'legal', 'fr');
    $html2pdf->WriteHTML($this->renderPartial('_exportPdf', array('data'=>$data), true));
    $html2pdf->Output('SubjekPajak-'.date('Y-m-d H:i:s').'.pdf', 'D');
  }
}
