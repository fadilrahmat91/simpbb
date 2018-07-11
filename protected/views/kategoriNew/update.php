<?php
/* @var $this KategoriNewController */
/* @var $model KategoriNew */

$this->breadcrumbs=array(
	'Kategori News'=>array('index'),
	$model->kategori_id=>array('view','id'=>$model->kategori_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List KategoriNew', 'url'=>array('index')),
	array('label'=>'Create KategoriNew', 'url'=>array('create')),
	array('label'=>'View KategoriNew', 'url'=>array('view', 'id'=>$model->kategori_id)),
	array('label'=>'Manage KategoriNew', 'url'=>array('admin')),
);
?>

<h1>Update KategoriNew <?php echo $model->kategori_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>