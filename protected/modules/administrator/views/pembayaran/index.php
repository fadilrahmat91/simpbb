<?php
/* @var $this TableKegiatanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Table Kegiatans',
);

$this->menu=array(
	array('label'=>'Create TableKegiatan', 'url'=>array('create')),
	array('label'=>'Manage TableKegiatan', 'url'=>array('admin')),
);
?>

<h1>Table Kegiatans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
