<?php
/* @var $this TableKegiatanController */
/* @var $model TableKegiatan */
/* @var $form CActiveForm */
?>

<div class="form">
	<div class="box-body">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route),
			'id' => 'search-form-lokasi',
			'method'=>'POST',
			'htmlOptions'=>array(
				'role'=>'form'
			),
		)); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label class="radio-inline">
						<input type="radio" name="pencariantype" id="inlineRadio1" value="nop" checked> Cari Berdasarkan NOP
					</label>
					<label class="radio-inline">
						<input type="radio" name="pencariantype" id="inlineRadio2" value="lokasi"> Cari Berdasarkan Lokasi
					</label>
				</div>
			</div>
		</div>
		<div class="row" id="cari-berdasarkan-lokasi" style="display:none">
			<div class="col-md-3">
				<div class="form-group">
					<?php echo $form->label($model,'pencarian_lat',array('class'=>'control-label')); ?>
					<?php echo $form->textField($model,'pencarian_lat',array('class'=>'form-control','size'=>20,'maxlength'=>20)); ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<?php echo $form->label($model,'pencarian_lng',array('class'=>'control-label')); ?>
					<?php echo $form->textField($model,'pencarian_lng',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
				</div>
			</div>
		</div>
		<div class="row" id="cari-berdasarkan-nop">
			<div class="col-md-3">
				<div class="form-group">
					<?php echo $form->label($model,'pencarian_nop',array('class'=>'control-label')); ?>
					<?php echo $form->textField($model,'pencarian_nop',array('class'=>'form-control','size'=>60,'maxlength'=>255,'data-inputmask'=> "'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']","data-mask"=>"")); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<?php echo CHtml::submitButton('Cari',array('class'=>'btn btn-info btn-sm')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
