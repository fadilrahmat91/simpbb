<?php
/* @var $this BrandController */
/* @var $data Brand */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_brand')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_brand), array('view', 'id'=>$data->id_brand)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kategori_id')); ?>:</b>
	<?php echo CHtml::encode($data->kategori_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_brand')); ?>:</b>
	<?php echo CHtml::encode($data->nama_brand); ?>
	<br />


</div>