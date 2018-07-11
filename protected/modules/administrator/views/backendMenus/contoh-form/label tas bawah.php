<?php
/* @var $this BackendMenusController */
/* @var $model BackendMenus */
/* @var $form CActiveForm */
?>

<div class="form">
<div class="box-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'backend-menus-form',
	 'htmlOptions'=>array(
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
		<?php echo $form->labelEx($model,'parent_menu'); ?>
		<?php echo $form->textField($model,'parent_menu',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'parent_menu'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_menu'); ?>
		<?php echo $form->textField($model,'nama_menu',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nama_menu'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'link_url'); ?>
		<?php echo $form->textField($model,'link_url',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'link_url'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	</div>
	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->