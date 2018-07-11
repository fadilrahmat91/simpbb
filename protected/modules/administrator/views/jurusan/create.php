<?php
/* @var $this JurusanController */
/* @var $model Jurusan */

$this->breadcrumbs=array(
	'Jurusans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jurusan', 'url'=>array('index')),
	array('label'=>'Manage Jurusan', 'url'=>array('admin')),
);
?>

<h1>Create Jurusan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>