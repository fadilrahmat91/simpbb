<?php
/* @var $this ProdukController */
/* @var $model Produk */

$this->breadcrumbs=array(
	'Produks'=>array('index'),
	$model->id_produk,
);

$this->menu=array(
	array('label'=>'List Produk', 'url'=>array('index')),
	array('label'=>'Create Produk', 'url'=>array('create')),
	array('label'=>'Update Produk', 'url'=>array('update', 'id'=>$model->id_produk)),
	array('label'=>'Delete Produk', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_produk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Produk', 'url'=>array('admin')),
);
?>

<h1>View Produk #<?php echo $model->id_produk; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_produk',
		'nama_produk',
		'harga',
		'deskripsi',
		'tgl_produk_masuk',
		'kategori_id',
		'id_brand',
		'image',
	),
)); ?>
