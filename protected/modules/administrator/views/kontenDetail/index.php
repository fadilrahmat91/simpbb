<?php
/* @var $this KontenDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Konten Details',
);

$this->menu=array(
	array('label'=>'Create KontenDetail', 'url'=>array('create')),
	array('label'=>'Manage KontenDetail', 'url'=>array('admin')),
);
?>

<h1>Konten Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
