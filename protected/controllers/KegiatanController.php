<?php

class KegiatanController extends Controller
{
	public function actionIndex()
	{
		$this->render('admin',[
			'Kegiatan' => TableKegiatan::getKegiatan(),
			'PageKegiatan' => TableKegiatan::getKegiatanPage(),
			//'kegiatanDetail' => TableKegiatanDetail::getkegiatandetail(),
			'Jumkegiatan' => TableKegiatan::getSumKegiatan()
		]);
	}

	// public function actionImageId($id){
	// 	$this->render('index',[
	// 		'kegiatanDetail' => TableKegiatanDetail::getkegiatandetail($id)
	// 	]);
	// }

	public function actionShowimage($filename = false, $id)
	{
		$path = Yii::getPathOfAlias('webroot').'/upload/kegiatan/'.$id.'/';
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

	public function actionView($id){ 
	    $this->render('_view',[ 
	      'kegiatanDetail' => TableKegiatanDetail::getKegiatanDetail($id),
	      'NameKegiatan' => TableKegiatan::getNameKegiatan($id),
	    ]); 
	}

	public function actionShow($id){ 
	    $this->render('_view',[ 
	      'kegiatanDetail' => TableKegiatanDetail::getKegiatanDetail($id),
	      'NameKegiatan' => TableKegiatan::getNameKegiatan($id),
	    ]); 
	}

	

	// public function actionGetDeliverible($file, $id){
	//   $path = Yii::getPathOfAlias('webroot').'/upload/kegiatan/'.$id.'/';
	//   if (file_exists($path.$file)) {
	//       header('Content-Description: File Transfer');
	//       header('Content-Type: application/octet-stream');
	//       header('Content-Disposition: attachment; filename='.basename($path.$file));
	//       header('Content-Transfer-Encoding: binary');
	//       header('Expires: 0');
	//       header('Cache-Control: must-revalidate');
	//       header('Pragma: public');
	//       header('Content-Length: ' . filesize($path.$file));
	//       readfile($path.$file);
	//   }
	// }

	public function actionImageDetail($file, $id){
		header('Content-Type: image/png, image/jpeg, image/jpg, image/gif');
		$path = Yii::getPathOfAlias('webroot').'/upload/kegiatan/'.$id.'/'.$file;
		readfile($path);
	}

	// public function actionKegiatanDetail(){
	// 	$kegiatanDetail = TableKegiatanDetail::getkegiatandetail($id);

	// 	if ($kegiatanDetail) {
	// 		$this->render('index', array('data'=>$kegiatanDetail));
	// 	}
	// }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}