<?php
/* @var $this AbsenController */
/* @var $model Absen */

$this->breadcrumbs=array(
	'Absens'=>array('index'),
	$model->id_absen,
);

$this->menu=array(
	array('label'=>'List Absen', 'url'=>array('index')),
	array('label'=>'Create Absen', 'url'=>array('create')),
	array('label'=>'Update Absen', 'url'=>array('update', 'id'=>$model->id_absen)),
	array('label'=>'Delete Absen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_absen),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Absen', 'url'=>array('admin')),
);
?>

<h1>View Absen #<?php echo $model->id_absen; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_ket',
		'nama',
		'nim',
		'id_absen',
		'tanggal',
		'id_matkul',
		'id_user',
	),
)); ?>
