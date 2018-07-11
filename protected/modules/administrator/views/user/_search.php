<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="col-md-4">
	<div class="form-group">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'nik'); ?>
		<?php echo $form->textField($model,'nik',array('class'=>'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'nama_lengkap'); ?>
		<?php echo $form->textField($model,'nama_lengkap',array('class'=>'form-control')); ?>
	</div>



	<div class="form-group buttons">
		<?php echo CHtml::submitButton('Search',array("class"=>"btn btn-primary")); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->