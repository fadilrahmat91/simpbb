<?php
/* @var $this HubungikamiController */
/* @var $model Hubungikami */

$this->breadcrumbs=array(
	'Hubungikamis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Hubungikami', 'url'=>array('index')),
	array('label'=>'Create Hubungikami', 'url'=>array('create')),
	array('label'=>'View Hubungikami', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Hubungikami', 'url'=>array('admin')),
);
?>

<h1>Update Hubungikami <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>