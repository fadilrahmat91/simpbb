<?php
/* @var $this KategoriNewController */
/* @var $model KategoriNew */

$this->breadcrumbs=array(
	'Kategori News'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List KategoriNew', 'url'=>array('index')),
	array('label'=>'Manage KategoriNew', 'url'=>array('admin')),
);
?>

<h1>Create KategoriNew</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>