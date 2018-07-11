<?php
/* @var $this UserRoleController */
/* @var $data UserRole */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode')); ?>:</b>
	<?php echo CHtml::encode($data->kode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_akses')); ?>:</b>
	<?php echo CHtml::encode($data->nama_akses); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alamat_utama')); ?>:</b>
	<?php echo CHtml::encode($data->alamat_utama); ?>
	<br />


</div>