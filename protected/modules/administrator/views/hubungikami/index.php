<?php
/* @var $this HubungikamiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hubungikamis',
);

$this->menu=array(
	array('label'=>'Create Hubungikami', 'url'=>array('create')),
	array('label'=>'Manage Hubungikami', 'url'=>array('admin')),
);
?>

<h1>Hubungikamis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
