<?php
/* @var $this BackendMenusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Backend Menuses',
);

$this->menu=array(
	array('label'=>'Create BackendMenus', 'url'=>array('create')),
	array('label'=>'Manage BackendMenus', 'url'=>array('admin')),
);
?>

<h1>Backend Menuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
