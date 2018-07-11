<?php
/* @var $this HubungikamiController */
/* @var $data Hubungikami */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_telp')); ?>:</b>
	<?php echo CHtml::encode($data->no_telp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pertanyaan')); ?>:</b>
	<?php echo CHtml::encode($data->pertanyaan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jawaban')); ?>:</b>
	<?php echo CHtml::encode($data->jawaban); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_jawab')); ?>:</b>
	<?php echo CHtml::encode($data->status_jawab); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_jawab')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_jawab); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dijawab_oleh')); ?>:</b>
	<?php echo CHtml::encode($data->dijawab_oleh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_kirim')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_kirim); ?>
	<br />

	*/ ?>

</div>