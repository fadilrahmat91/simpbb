<?php
/* @var $this BackendMenusController */
/* @var $model BackendMenus */

$this->breadcrumbs=array(
	'Backend Menuses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BackendMenus', 'url'=>array('index')),
	array('label'=>'Create BackendMenus', 'url'=>array('create')),
	array('label'=>'Update BackendMenus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BackendMenus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BackendMenus', 'url'=>array('admin')),
);
?>

<h1>View BackendMenus #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_menu',
		'nama_menu',
		'link_url',
		'status',
	),
)); ?>
