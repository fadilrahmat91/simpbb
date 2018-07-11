<?php
/* @var $this MataKuliahController */
/* @var $model MataKuliah */

$this->breadcrumbs=array(
	'Mata Kuliahs'=>array('index'),
	$model->id_matkul=>array('view','id'=>$model->id_matkul),
	'Update',
);

$this->menu=array(
	array('label'=>'List MataKuliah', 'url'=>array('index')),
	array('label'=>'Create MataKuliah', 'url'=>array('create')),
	array('label'=>'View MataKuliah', 'url'=>array('view', 'id'=>$model->id_matkul)),
	array('label'=>'Manage MataKuliah', 'url'=>array('admin')),
);
?>

<h1>Update MataKuliah <?php echo $model->id_matkul; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>