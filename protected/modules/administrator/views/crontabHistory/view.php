<?php
/* @var $this CrontabHistoryController */
/* @var $model CrontabHistory */

$this->breadcrumbs=array(
	'Crontab Histories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CrontabHistory', 'url'=>array('index')),
	array('label'=>'Create CrontabHistory', 'url'=>array('create')),
	array('label'=>'Update CrontabHistory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CrontabHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CrontabHistory', 'url'=>array('admin')),
);
?>

<h1>View CrontabHistory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'tanggal_running',
	),
)); ?>
