<?php
/* @var $this CrontabHistoryController */
/* @var $model CrontabHistory */

$this->breadcrumbs=array(
	'Crontab Histories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CrontabHistory', 'url'=>array('index')),
	array('label'=>'Create CrontabHistory', 'url'=>array('create')),
	array('label'=>'View CrontabHistory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CrontabHistory', 'url'=>array('admin')),
);
?>

<h1>Update CrontabHistory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>