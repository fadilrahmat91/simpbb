<?php
/* @var $this KategoriNewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kategori News',
);

$this->menu=array(
	array('label'=>'Create KategoriNew', 'url'=>array('create')),
	array('label'=>'Manage KategoriNew', 'url'=>array('admin')),
);
?>

<h1>Kategori News</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
