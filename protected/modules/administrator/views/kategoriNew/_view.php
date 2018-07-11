<?php
/* @var $this KategoriNewController */
/* @var $data KategoriNew */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('kategori_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->kategori_id), array('view', 'id'=>$data->kategori_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_kategori')); ?>:</b>
	<?php echo CHtml::encode($data->nama_kategori); ?>
	<br />


</div>