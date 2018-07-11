<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">
<div class="box-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
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
		<?php echo $form->labelEx($model,'nik',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->textField($model,'nik',array('size'=>60,'maxlength'=>255,'class'=>'form-control','disabled'=>(isset($model->id)?'disabled':''))); ?>
			<?php echo $form->error($model,'nik'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'userlevel',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->dropDownList($model, 'userlevel',  CHtml::listData(UserRole::model()->findAll(), 'kode', 'nama_akses'), array('class'=>'form-control' ,'disabled'=>(isset($model->id)?'disabled':''))); ?>
			<?php echo $form->error($model,'userlevel'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_lengkap',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->textField($model,'nama_lengkap',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'nama_lengkap'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'password'); ?>
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
		$("form#user-form").submit(function(){
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