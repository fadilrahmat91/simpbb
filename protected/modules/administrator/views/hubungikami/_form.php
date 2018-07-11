<?php
/* @var $this HubungikamiController */
/* @var $model Hubungikami */
/* @var $form CActiveForm */
?>

<div class="form ">
<div class="box-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hubungikami-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
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
		<div class="col-sm-9">
		<?php echo $form->labelEx($model,'Jawaban'); ?>
		
		<?php echo $form->textArea($model,'jawaban',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'jawaban'); ?>
		</div>
	</div>

	

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>

</div><!-- form -->