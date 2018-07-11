<?php
/* @var $this KontenController */
/* @var $model Konten */
/* @var $form CActiveForm */
?>

<div class="form">
	<div class="box-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'konten-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		 'enctype' => 'multipart/form-data',
		'role'=>'form'
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-8">
		<?php echo $form->textField($model,'nama',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nama'); ?>
	</div>
	</div>

<div class="form-group">
		<?php echo $form->labelEx($model,'slug',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-8">
		<?php echo $form->textArea($model,'slug',array('class'=>'form-control','disabled'=>(isset($model->id)?'disabled':''))); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>
	</div>
</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->