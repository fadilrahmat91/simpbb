<?php
/* @var $this BackendMenusController */
/* @var $data BackendMenus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_menu')); ?>:</b>
	<?php echo CHtml::encode($data->parent_menu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama_menu')); ?>:</b>
	<?php echo CHtml::encode($data->nama_menu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link_url')); ?>:</b>
	<?php echo CHtml::encode($data->link_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>