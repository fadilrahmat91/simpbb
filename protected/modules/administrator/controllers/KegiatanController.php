<?php

class KegiatanController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return RolesMenu::actionRule('kegiatan'); 
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
		$model=new TableKegiatan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TableKegiatan']))
		{
			$model->dibuat_oleh = Yii::app()->user->id; 
			$model->attributes=$_POST['TableKegiatan'];
			if($model->save())
				$this->redirect(array('upload','id'=>$model->id));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TableKegiatan']))
		{
			$model->dibuat_oleh = Yii::app()->user->id; 
			$model->attributes=$_POST['TableKegiatan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpload($id)
	{

		$model=$this->loadModel($id);

		$kegiatan = new TableKegiatan;
		$detail_kegiatan = new TableKegiatanDetail;
		$gambarlokasi = new FileLokasi;

		$timestamp = new CDbExpression('NOW()');

		$kegiatanLokasi = Yii::getPathOfAlias('webroot').'/upload/kegiatan/';
		if (!empty($_FILES)) {
			$random = rand(0,99999999999);
			$tempFile = $_FILES['TableKegiatan']['tmp_name']['file']; 
			$targetPath = $kegiatanLokasi.$model->id.'/';  
			$file_name = $random.'_'.str_replace(' ' ,'_' ,$_FILES['TableKegiatan']['name']['file']); 
			$targetFile =  $targetPath.$file_name;
		   	if (!is_dir($targetPath)) {
				try {
				  mkdir($targetPath, 0777, true);
				} catch(ErrorException $ex) {
				   echo "Error: " . $ex->getMessage();
				}
			}
	       		if(move_uploaded_file($tempFile,$targetFile)){
				$path = $targetPath.$file_name;
				$path_thumb = $targetPath.'thumb_'. $file_name;
				$thumb = Yii::app()->simpleImage->load($targetFile);
				$thumb->crop(400,300);
				$thumb->save($path_thumb);

				$round_thumb = $targetPath.'round_'. $file_name;
				$round = Yii::app()->simpleImage->load($targetFile);
				$round->crop(156,156);
				$round->save($round_thumb);


				$gambarlokasi->nama_file = $file_name;
				$gambarlokasi->tanggal_upload = $timestamp;
				if($gambarlokasi->save()){
					$detail_kegiatan->kegiatan_id= $id;
					$detail_kegiatan->gambar= $gambarlokasi->id;
					$detail_kegiatan->no_urut= $id;
					$detail_kegiatan->tanggal_upload= $timestamp;
					$detail_kegiatan->save();

					if((int)$model->cover_image <= 0){
						$model->cover_image = $gambarlokasi->id;
						$model->save();

						$detail_kegiatan->gambar = $gambarlokasi->id;
						$detail_kegiatan->save();
					}
				}
		  	}
			return;
		}
		
		$this->render('upload',array(
			'model'=>$model,
		));
	}
	/* Function not support upload to centos linux */
	// public function actionUpload($id)
	// {

	// 	$model=$this->loadModel($id);

	// 	$kegiatan = new TableKegiatan;
	// 	$detail_kegiatan = new TableKegiatanDetail;
	// 	$gambarlokasi = new FileLokasi;

	// 	// $FileLokasi = new FileLokasi;
	// 	// $DetailKegiatan = new TableKegiatanDetail;
	// 	// $Kegiatan = new TableKegiatan;
	// 	//$gambarlokasi = new FileLokasi;

	// 	$timestamp = new CDbExpression('NOW()');

	// 	$kegiatanLokasi = Yii::getPathOfAlias('webroot').Yii::app()->params['kegiatanpic'];
	// 	//$kegiatanLokasi = Yii::getPathOfAlias('webroot').'/upload/kegiatan/'; 
	// 	if (!empty($_FILES)) {
	// 		//print_r($_FILES['TableKegiatan']);
	// 		$random = rand(0,99999999999);
	// 		$tempFile = $_FILES['TableKegiatan']['tmp_name']['file']; 
	// 		$targetPath = $kegiatanLokasi.$model->id.'/'; 
	// 		$file_name = $random.'_'.str_replace(' ' ,'_' ,$_FILES['TableKegiatan']['name']['file']); 
	// 		$targetFile =  $targetPath.$file_name;
	// 	   	if (!file_exists($targetPath)) {
				
	// 			try {
	// 			  mkdir($targetPath, 0777, true);
	// 			} catch(ErrorException $ex) {
	// 			   echo "Error: " . $ex->getMessage();
	// 			}
	// 		}
	// 		if(move_uploaded_file($tempFile,$targetFile)){
	// 			$path = $targetPath.$file_name;
	// 			$path_thumb = $targetPath.'thumb_'. $file_name;
	// 			$thumb = Yii::app()->simpleImage->load($targetFile);
	// 			$thumb->crop(400,300);
	// 			$thumb->save($path_thumb);

	// 			$round_thumb = $targetPath.'round_'. $file_name;
	// 			$round = Yii::app()->simpleImage->load($targetFile);
	// 			$round->crop(156,156);
	// 			$round->save($round_thumb);


	// 			$gambarlokasi->nama_file = $file_name;
	// 			$gambarlokasi->tanggal_upload = $timestamp;
	// 			if($gambarlokasi->save()){
	// 				$detail_kegiatan->kegiatan_id= $id;
	// 				$detail_kegiatan->gambar= $gambarlokasi->id;
	// 				$detail_kegiatan->no_urut= $id;
	// 				$detail_kegiatan->tanggal_upload= $timestamp;
	// 				$detail_kegiatan->save();

	// 				if((int)$model->cover_image <= 0){
	// 					$model->cover_image = $gambarlokasi->id;
	// 					$model->save();

	// 					$detail_kegiatan->gambar = $gambarlokasi->id;
	// 					$detail_kegiatan->save();
	// 				}
	// 			}
	// 		}
	// 		return;
	// 	}
		
	// 	$this->render('upload',array(
	// 		'model'=>$model,
	// 	));
	// }
	public function actionShowimage($filename = false, $id)
	{
	    if ($filename)
	    {
	        // $path =  Yii::getPathOfAlias('application.images'). '/';
	        $path = Yii::getPathOfAlias('webroot').'/upload/kegiatan/'.$id.'/'; 
	        if (file_exists($path.$filename))
	        {
	            Yii::app()->request->sendFile(
	                $filename,
	                file_get_contents($path.$filename)
	            );
	        } else {
	            echo "File not found!";
	        }
	    }
	}

	public function actionImageDetail($file, $id){
		header('Content-Type: image/png, image/jpeg, image/jpg, image/gif');
		$path = Yii::getPathOfAlias('webroot').'/upload/kegiatan/'.$id.'/'.$file;
		readfile($path);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{

		TableKegiatanDetail::model()->deleteAll(array(
		   'condition' => 'kegiatan_id = :ID',
		   'params' => array(
		        ':ID' => $id
		   )
		));

		$this->loadModel($id)->delete();

		$dir = Yii::getPathOfAlias('webroot').'/upload/kegiatan/'.$id.'/';
		if (is_dir($dir)) {
	        $scn = scandir($dir);
	        foreach ($scn as $files) {
	            if ($files !== '.') {
	                if ($files !== '..') {
	                    if (!is_dir($dir . '/' . $files)) {
	                        unlink($dir . '/' . $files);
	                    } else {
	                        emptyDir($dir . '/' . $files);
	                        rmdir($dir . '/' . $files);
	                    }
	                }
	            }
	        }
	    }
		rmdir($dir);

		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TableKegiatan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TableKegiatan']))
			$model->attributes=$_GET['TableKegiatan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TableKegiatan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TableKegiatan::model()->findByPk($id);

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadIdCover($id)
	{
		$model=TableKegiatan::model()->findByPk(array('cover_image'=>$id));

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionPrimaryImage($id, $kegiatan_id){
		//print_r($kegiatan_id);
		$model=$this->loadModel($kegiatan_id);

		$avatar=TableKegiatan::model()->findByAttributes(array('id'=>$kegiatan_id));
		$avatar->attributes=array('cover_image'=>$id);
		$avatar->save();
		$this->redirect(array('upload','id'=>$model->id, 'nopic'=>'t'));
	}

	public function actionDeleteImage($id, $kegiatan_id, $nama_file){
		$model=$this->loadModel($kegiatan_id);
		$getID = TableKegiatan::getIdCover($id);
		$kegiatanLokasi = Yii::getPathOfAlias('webroot').Yii::app()->params['kegiatanpic'].$model->id.'/';
		
		$data = 0;
		foreach ($getID as $p) {
			$data = $p['cover_image'];
		}

		if ($data == $id) {
			$this->redirect(array('upload','id'=>$model->id, 'nopic'=>'p'));
		}else{
			$path = $kegiatanLokasi.$nama_file;
			$path_thumb = $kegiatanLokasi.'thumb_'. $nama_file;
			$path_round = $kegiatanLokasi.'round_'. $nama_file;
			if (file_exists($path)) {
				unlink($path);
			}
			if (file_exists($path_thumb)) {
				unlink($path_thumb);
			}
			if (file_exists($path_round)) {
				unlink($path_round);
			}
			
			TableKegiatanDetail::model()->deleteAll(array(
			   'condition' => 'gambar = :ID',
			   'params' => array(
			        ':ID' => $id
			   )
			));

			FileLokasi::model()->deleteAll(array(
			   'condition' => 'id = :ID',
			   'params' => array(
			        ':ID' => $id
			   )
			));
			$this->redirect(array('upload','id'=>$model->id, 'nopic'=>'s'));
		}
	}

	/**
	 * Performs the AJAX validation.
	 * @param TableKegiatan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='table-kegiatan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionExport(){
    $model=new TableKegiatan;
    $model->unsetAttributes();
    $model->tanggal_kegiatan = $_GET['tanggal_kegiatan'];
    $filename = 'Kegiatan ('.$model->tanggal_kegiatan.')';
    $factory = new CWidgetFactory();    
        $widget = $factory->createWidget($this, 'ext.EExcelView', array(
            'dataProvider'=>$model->search(),
            'grid_mode'=>'export',
            'title'=>'Kegiatan ('.$model->tanggal_kegiatan.')',
            'filename'=>$filename,
            'stream'=>true,
            'exportType'=>'Excel2007',
            'columns'=>array(
                  //'promotioncode',
            	array(
	                'name'=>'id',
	                'header'=>'ID',
	                'filter' => false,
                ), 
                array(
                  	'name'=>'cover_image',
                  	'header'=>'COVER IMAGE',
                  	'value'=>function($model){
									$data=$model->cover_image;
									$data_id = $model->id;
									if($data >= 1){
										$namafile =FileLokasi::model()->findByAttributes(array("id"=>$data))->nama_file;
										$imageUrl = Yii::app()->request->baseUrl.'/upload/kegiatan/'.$data_id.'/'.$namafile;
										$image = '<img class="img-fluid" src="'.$imageUrl.'" alt="" style="width:50px; height: 50px;" />';
										echo CHtml::link($image);
									}
								},
                  	'filter' => false,
                  	'sortable'=>false,
                ),
                array(
                  	'name'=>'nama_kegiatan',
                  	'header'=>'NAMA KEGIATAN',
                  	'filter' => false,
                  	'sortable'=>false,
                ),
                array(
                  	'name'=>'dropcaps',
                  	'header'=>'Dropcaps',
                  	'filter' => false,
                  	'sortable'=>false,
                ),
                array(
                  	'name'=>'keterangan_kegiatan',
                  	'header'=>'KETERANGAN KEGIATAN',
                  	'filter' => false,
                  	'sortable'=>false,
                ),
                array(
                  	'name'=>'tanggal_kegiatan',
                  	'header'=>'TANGGAL KEGIATAN',
                  	'value'=>'Yii::app()->dateFormatter->format("d MMM y",strtotime($data->tanggal_kegiatan))',
                  	'filter' => false,
                  	'sortable'=>false,
                ),
                array(
                  	'name'=>'dibuat_oleh',
                  	'value'=>'User::model()->findByAttributes(array("id"=>$data["dibuat_oleh"]))->nama_lengkap',
                  	'filter'=>CHtml::listData(User::model()->findAll(),'id','nama_lengkap'),
                  	'header'=>'DIBUAT OLEH',
                  	//'filter' => false,
                  	'sortable'=>false,
                ),
            ),
        ));
        $widget->init();
        $widget->run();
  }
}
