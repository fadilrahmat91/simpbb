<?php
/* @var $this CrontabHistoryController */
/* @var $model CrontabHistory */

$this->breadcrumbs=array(
	'Crontab Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CrontabHistory', 'url'=>array('index')),
	array('label'=>'Manage CrontabHistory', 'url'=>array('admin')),
);
?>

<h1>Create CrontabHistory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>