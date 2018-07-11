<?php
/* @var $this KategoriNewController */
/* @var $model KategoriNew */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'kategori_id'); ?>
		<?php echo $form->textField($model,'kategori_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama_kategori'); ?>
		<?php echo $form->textField($model,'nama_kategori',array('size'=>33,'maxlength'=>33)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->