<?php
/* @var $this CrontabController */
/* @var $model Crontab */
/* @var $form CActiveForm */
?>

<div class="form">
<div class="box-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'crontab-form',
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
			<?php echo $form->labelEx($model,'nama_crontab',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->textField($model,'nama_crontab',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'nama_crontab'); ?>
		</div>
	</div>

	<div class="form-group">
			<?php echo $form->labelEx($model,'url',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->textArea($model,'url',array('form-groups'=>6, 'cols'=>50,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'url'); ?>
		</div>
	</div>

	<div class="form-group">
			<?php echo $form->labelEx($model,'last_running',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->textField($model,'last_running',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'last_running'); ?>
		</div>
	</div>
</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	$("document").ready(function(){
		$("form#crontab-form").submit(function(){
			var _form = $(this);
			Ajax.run(_form.attr('action'),'POST',_form.serialize(),function(response){
				if(response.status == 'ok' ){
					alert(response.msg);
					_form[0].reset();
				}else{
					//Ajax.run_error();
					alert(response.msg);
				}
			});
			return false;
		})
	});
</script>