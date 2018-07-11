<?php
/* @var $this MahasiswaController */
/* @var $model Mahasiswa */
/* @var $form CActiveForm */
?>
<div class="box-body">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mahasiswa-form',
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
		<?php echo $form->labelEx($model,'npm',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-6">
		<?php echo $form->textField($model,'npm',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'npm'); ?>
	</div>
	</div>
		<div class="form-group">
				<?php echo $form->labelEx($model,'jurusan',array('class'=>'col-sm-3 control-label')); ?>
				<?php $hsl =Jurusan::model()->findAll(); ?>
				<div class="col-md-4">
				<select id="dat-kategori" class="select2-element form-control" name="Mahasiswa[jurusan]">
					<option>Pilih </option>
						<?php foreach($hsl as $dpt ){ ?>
						<option <?=($model->jurusan == $dpt['jurusan'] ? 'selected' : '')?> value="<?= $dpt['id']?>"><?=$dpt['id'].'-'.$dpt['jurusan']?></option>
					<?php } ?>
				</select>
			</div>
	</div>

	

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->