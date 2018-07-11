<?php
/* @var $this AbsenController */
/* @var $model Absen */

$this->breadcrumbs=array(
	'Absens'=>array('index'),
	$model->id_absen=>array('view','id'=>$model->id_absen),
	'Update',
);

$this->menu=array(
	array('label'=>'List Absen', 'url'=>array('index')),
	array('label'=>'Create Absen', 'url'=>array('create')),
	array('label'=>'View Absen', 'url'=>array('view', 'id'=>$model->id_absen)),
	array('label'=>'Manage Absen', 'url'=>array('admin')),
);
?>

<h1>Update Absen <?php echo $model->id_absen; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>