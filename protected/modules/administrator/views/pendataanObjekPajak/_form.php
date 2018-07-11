<?php
$tahun = date('Y');
?>

<div class="form">
	<div id="page-1">
		<div class="box-body">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'pendataan-op-baru',
				'htmlOptions'=>array(
					'class'=>'form-horizontal',
					'role'=>'form',
					
				),
				'enableAjaxValidation'=>false,
			)); ?>
			
			<?php echo $form->errorSummary($model); ?>
			<div class="form-group">
				<?php echo $form->labelEx($model,'jenis_formulir',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-9 jns_transaksi" data-jnstransaksi='<?= json_encode(PendataanObjekPajak::jns_transaksi())?>' >
					<?php echo $form->dropDownList($model, 'jenis_formulir',  PendataanObjekPajak::jns_formulir(), array('class'=>'form-control' )); ?>
					<?php echo $form->error($model,'jenis_formulir'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'jenis_transaksi',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-9">
					<?php echo $form->dropDownList($model, 'jenis_transaksi',  array('0'=>'Pilih Jenis Formulir'), array('class'=>'form-control' )); ?>
					<?php echo $form->error($model,'jenis_transaksi'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'no_formulir',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-9">
					<?php echo $form->textField($model,'no_formulir',array('class'=>'form-control','data-inputmask'=>"'mask': ['$tahun.9999.999', '$tahun 9999 999']",'data-mask'=>'')); ?>
					<?php echo $form->error($model,'no_formulir'); ?>
				</div>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model,'nop',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-9">
					<?php echo $form->textField($model,'nop',array('class'=>'form-control','data-inputmask'=>"'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']",'data-mask'=>'')); ?>
					<?php echo $form->error($model,'nop'); ?>
				</div>
			</div>
			<div class="form-group">
				<?php echo $form->labelEx($model,'nop_asal',array('class'=>'col-sm-3 control-label')); ?>
				<div class="col-sm-9">
					<?php echo $form->textField($model,'nop_asal',array('class'=>'form-control','data-inputmask'=>"'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']",'data-mask'=>'')); ?>
					<?php echo $form->error($model,'nop_asal'); ?>
				</div>
			</div>
			</div>
		<div class="box-footer">
			<?php echo CHtml::submitButton('Lanjutkan',array('url'=>Yii::app()->createAbsoluteUrl('administrator/pendataanObjekPajak/page1'),'id'=>'lanjutkan-pendataan','class'=>'btn btn-primary','name'=>'simpanmenu')); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
