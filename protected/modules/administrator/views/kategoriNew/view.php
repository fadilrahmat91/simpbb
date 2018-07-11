<?php
/* @var $this KategoriNewController */
/* @var $model KategoriNew */

$this->breadcrumbs=array(
	'Kategori News'=>array('index'),
	$model->kategori_id,
);

$this->menu=array(
	array('label'=>'List KategoriNew', 'url'=>array('index')),
	array('label'=>'Create KategoriNew', 'url'=>array('create')),
	array('label'=>'Update KategoriNew', 'url'=>array('update', 'id'=>$model->kategori_id)),
	array('label'=>'Delete KategoriNew', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->kategori_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KategoriNew', 'url'=>array('admin')),
);
?>

<h1>View KategoriNew #<?php echo $model->kategori_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'kategori_id',
		'nama_kategori',
	),
)); ?>
