<?php
/* @var $this ProdukController */
/* @var $model Produk */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_produk'); ?>
		<?php echo $form->textField($model,'id_produk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_produk'); ?>
		<?php echo $form->textField($model,'nama_produk',array('size'=>33,'maxlength'=>33)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'harga'); ?>
		<?php echo $form->textField($model,'harga',array('size'=>33,'maxlength'=>33)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deskripsi'); ?>
		<?php echo $form->textField($model,'deskripsi',array('size'=>60,'maxlength'=>333)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_produk_masuk'); ?>
		<?php echo $form->textField($model,'tgl_produk_masuk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kategori_id'); ?>
		<?php echo $form->textField($model,'kategori_id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_brand'); ?>
		<?php echo $form->textField($model,'id_brand'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>333)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->