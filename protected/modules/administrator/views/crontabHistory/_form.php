<?php
/* @var $this CrontabHistoryController */
/* @var $model CrontabHistory */
/* @var $form CActiveForm */
?>

<div class="form">
<div class="box-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'crontab-history-form',
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
				<?php echo $form->labelEx($model,'code',array('class'=>'col-sm-3 control-label')); ?>
			<div class="col-sm-9">
				<?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
				<?php echo $form->error($model,'code'); ?>
			</div>
	</div>

	<div class="form-group">
				<?php echo $form->labelEx($model,'tanggal_running',array('class'=>'col-sm-3 control-label')); ?>
			<div class="col-sm-9">
				<?php echo $form->textField($model,'tanggal_running'array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'tanggal_running'); ?>
			</div>
	</div>
</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->