<?php
/* @var $this CrontabController */
/* @var $model Crontab */

$this->breadcrumbs=array(
	'Crontabs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Crontab', 'url'=>array('index')),
	array('label'=>'Create Crontab', 'url'=>array('create')),
	array('label'=>'Update Crontab', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Crontab', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Crontab', 'url'=>array('admin')),
);
?>

<h1>View Crontab #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'nama_crontab',
		'url',
		'last_running',
	),
)); ?>
