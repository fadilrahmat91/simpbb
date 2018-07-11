<?php
/* @var $this TableKegiatanController */
/* @var $model TableKegiatan */

$this->breadcrumbs=array(
	'Table Kegiatans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TableKegiatan', 'url'=>array('index')),
	array('label'=>'Create TableKegiatan', 'url'=>array('create')),
	array('label'=>'Update TableKegiatan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TableKegiatan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TableKegiatan', 'url'=>array('admin')),
);
?>

<h1>View TableKegiatan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama_kegiatan',
		'keterangan_kegiatan',
		'tanggal_kegiatan',
		'cover_image',
		'dibuat_oleh',
		'tanggal_upload',
	),
)); ?>
