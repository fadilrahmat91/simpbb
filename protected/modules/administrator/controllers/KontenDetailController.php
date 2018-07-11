<?php

class KontenDetailController extends Controller
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
		return RolesMenu::actionRule('kontendetail'); 
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
	private function upload_file($file){
		//$dir = Yii::getPathOfAlias('webroot').'/upload/konten/';

		$model=new KontenDetail;
		$gambarlokasi=new FileLokasi;

		$random = rand(0,99999999999);
		$tempFile = $_FILES['KontenDetail']['tmp_name']['gambar'];  
		$targetPath = Yii::getPathOfAlias('webroot').'/upload/konten/'; 
		$file_name = $random.'_'.str_replace(' ' ,'_' ,$file['KontenDetail']['name']['gambar']); 
		$targetFile =  $targetPath.$file_name;

		$gambarlokasi = new FileLokasi;
		if(move_uploaded_file($tempFile,$targetFile)){
				$path = Yii::getPathOfAlias('webroot') . '/upload/konten/'.$file_name;
				$path_thumb = Yii::getPathOfAlias('webroot') . '/upload/konten/'.'/'.'thumb_'. $file_name;
				$thumb = Yii::app()->simpleImage->load($targetFile);
				$thumb->crop(790,477);
				$thumb->save($path_thumb);
	       		$gambarlokasi->nama_file = $file_name;
	       		if($gambarlokasi->save()){
	       			return $gambarlokasi->id;
	       		}
		}
		return 0;
	}

	public function actionUpload($id)
	{	
		$model=$this->loadModel($id);
		if( !empty($_FILES)){
				$idfile = self::upload_file($_FILES);

				$model->gambar =$idfile;

				$model->save();
			}
		$this->render('_upload',array(
			'model'=>$model,
		));
	}
	public function actionCreate()
	{
		$model=new KontenDetail;
		
		$timestamp = new CDbExpression('NOW()');
		 
			if(isset($_POST['KontenDetail']))
		{
			
			
			$idfile = 0;
			if( !empty($_FILES)){
				 $idfile = self::upload_file($_FILES);

			}
			
			$model->attributes=$_POST['KontenDetail'];
		
			$judul= $_POST['KontenDetail']['judul'];
			$slugnya = Konten::create_url($judul);
			$model->judul =$model->judul ;
			$model->gambar =$idfile;
			
			if($model->save()){
				$model->slug=$slugnya.'_'.$model->id;//.$id_terakhirnya
				$model->save();
       		}

			
               
				$this->redirect(array('admin'));

		}


		$this->render('create',array(
			'model'=>$model
			//'note'=>'silahkan isi terlebih dahulu',
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	
		
	public function actionUpdate($id)
	{
		// echo $gambar;exit;
		
		$model=$this->loadModel($id);
		
		$gambar = $model->gambar;
			
		if(isset($_POST['KontenDetail']))
		{
			
			
			//$idfile = $model->gambar;
			$model->attributes=$_POST['KontenDetail'];

			$dir = Yii::getPathOfAlias('webroot').'/upload/konten'; 
			$timestamp = new CDbExpression('NOW()');

			$idfile = $gambar;


			if(!empty($_FILES['KontenDetail']['name']['gambar'])){
				 if($gambar >=1 ){
					 $namafile =FileLokasi::model()->findByAttributes(array("id"=>$gambar))->nama_file;
					 $lokasi = Yii::getPathOfAlias('webroot') . '/upload/konten/'.$namafile;
					 $lokasi2 = Yii::getPathOfAlias('webroot') . '/upload/konten/'.'/'.'thumb_'.$namafile;
					if(FileLokasi::model()->deleteAll("id='$gambar'")){

						if(file_exists($lokasi)){
							unlink($lokasi);
							unlink($lokasi2);
						}
					}
				}
				$idfile = self::upload_file($_FILES);

			}else{
				$idfile = $gambar;
			
			}
			
			
			//print_r($_POST['KontenDetail']);exit;
			
			$judul= $model->judul;
			$slugnya = Konten::create_url($judul);
			$model->gambar =$idfile;
			$model->tgl_buat = $timestamp;
			
			
			$model->save();
			
			$this->redirect(array('admin'));
		}
		$model=$this->loadModel($id);

		$this->render('update',array(
			'model'=>$model,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id,$gambar)
	{
		//$data=$gambar;
		$this->loadModel($id)->delete();
		if($gambar >= 1 ){
		$namafile =FileLokasi::model()->findByAttributes(array("id"=>$gambar))->nama_file;
		$lokasi = Yii::getPathOfAlias('webroot') . '/upload/konten/'.$namafile;
		$lokasi2 = Yii::getPathOfAlias('webroot') . '/upload/konten/'.'/'.'thumb_'.$namafile;
		
		
		if($model=FileLokasi::model()->deleteAll("id='$gambar'")){

			if(file_exists($lokasi)){
				unlink($lokasi);
				unlink($lokasi2);
			}
		}
	}
		

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('KontenDetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new KontenDetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['KontenDetail']))
			$model->attributes=$_GET['KontenDetail'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return KontenDetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=KontenDetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param KontenDetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='konten-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
