<?php
/* @var $this TableKegiatanController */
/* @var $data TableKegiatan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_kegiatan')); ?>:</b>
	<?php echo CHtml::encode($data->nama_kegiatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan_kegiatan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan_kegiatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_kegiatan')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_kegiatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover_image')); ?>:</b>
	<?php echo CHtml::encode($data->cover_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dibuat_oleh')); ?>:</b>
	<?php echo CHtml::encode($data->dibuat_oleh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_upload')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_upload); ?>
	<br />


</div>