<?php
/* @var $this KontenDetailController */
/* @var $data KontenDetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('konten_id')); ?>:</b>
	<?php echo CHtml::encode($data->konten_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('judul')); ?>:</b>
	<?php echo CHtml::encode($data->judul); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gambar')); ?>:</b>
	<?php echo CHtml::encode($data->gambar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_buat')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_buat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isi_konten')); ?>:</b>
	<?php echo CHtml::encode($data->isi_konten); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sumber')); ?>:</b>
	<?php echo CHtml::encode($data->sumber); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>