<?php
/* @var $this CrontabHistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Crontab Histories',
);

$this->menu=array(
	array('label'=>'Create CrontabHistory', 'url'=>array('create')),
	array('label'=>'Manage CrontabHistory', 'url'=>array('admin')),
);
?>

<h1>Crontab Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
