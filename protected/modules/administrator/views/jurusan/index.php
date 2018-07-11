<?php
/* @var $this JurusanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jurusans',
);

$this->menu=array(
	array('label'=>'Create Jurusan', 'url'=>array('create')),
	array('label'=>'Manage Jurusan', 'url'=>array('admin')),
);
?>

<h1>Jurusans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
