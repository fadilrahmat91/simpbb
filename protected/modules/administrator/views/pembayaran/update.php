<?php
/* @var $this TableKegiatanController */
/* @var $model TableKegiatan */

$this->breadcrumbs=array(
	'Table Kegiatans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TableKegiatan', 'url'=>array('index')),
	array('label'=>'Create TableKegiatan', 'url'=>array('create')),
	array('label'=>'View TableKegiatan', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TableKegiatan', 'url'=>array('admin')),
);
?>

<h1>Update TableKegiatan <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>