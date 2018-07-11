<?php
/* @var $this ProdukController */
/* @var $model Produk */
/* @var $form CActiveForm */
?>

<div class="form">
<div class="box-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'produk-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'),

)); ?>

	

	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
				<?php echo $form->labelEx($model,'kategori_id',array('class'=>'col-sm-3 control-label')); ?>
				<?php $hsl =KategoriNew::model()->findAll(); ?>
				<div class="col-md-4">
				<select id="dat-kategori" class="select2-element form-control" name="Produk[kategori_id]">
					<option>Pilih </option>
						<?php foreach($hsl as $dpt ){ ?>
						<option <?=($model->kategori_id == $dpt['kategori_id'] ? 'selected' : '')?> value="<?= $dpt['kategori_id']?>"><?=$dpt['kategori_id'].'-'.$dpt['nama_kategori']?></option>
					<?php } ?>
				</select>
			</div>
	</div>
	 <div class="form-group">
		<?php echo $form->labelEx($model,'id_brand',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-4">
			<select id="kategori-form" class="form-control" name="Produk[id_brand]">

			</select>
		
	</div> 
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_produk',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-md-4">
		<?php echo $form->textField($model,'nama_produk',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nama_produk'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'harga',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-md-4">
		<?php echo $form->textField($model,'harga',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'harga'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'deskripsi',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-md-4">
		<?php echo $form->textField($model,'deskripsi',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'deskripsi'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tgl_produk_masuk',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-md-4">
		<?php echo $form->textField($model,'tgl_produk_masuk',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'tgl_produk_masuk'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'image',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-md-4">
		<?php echo $form->textField($model,'image',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
	</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
	$("document").ready(function(){
	$("select#dat-kategori").change(function(){
		var kateg = $(this).val();
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/produk/brand') ?>", 'GET', {kategori:kateg},function(response){
			$("select#kategori-form").html(response.html);
		});
	});
})

	
</script>
