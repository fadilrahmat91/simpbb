


<div class="form ">
<div class="box-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-role-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'kode'); ?>
		<?php echo $form->textField($model,'kode',array('rows'=>6, 'cols'=>50,'class'=>'form-control','disabled'=>(isset($model->id)?'disabled':''))); ?>
		<?php echo $form->error($model,'kode'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_akses'); ?>
		<?php echo $form->textField($model,'nama_akses',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nama_akses'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alamat_utama'); ?>
		<?php echo $form->textField($model,'alamat_utama',array('rows'=>6, 'cols'=>5,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'alamat_utama'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->