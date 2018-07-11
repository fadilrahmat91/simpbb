<?php
/* @var $this CrontabController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Crontabs',
);

$this->menu=array(
	array('label'=>'Create Crontab', 'url'=>array('create')),
	array('label'=>'Manage Crontab', 'url'=>array('admin')),
);
?>

<h1>Crontabs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
