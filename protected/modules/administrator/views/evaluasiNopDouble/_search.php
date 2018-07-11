<?php 
$tahun = [];
//$tahun[0] = "Pilih Tahun";
for( $xn = Yii::app()->report->tahun_akhir(); $xn >= Yii::app()->report->tahun_mulai(); $xn-- ){ ?>
	<?php $tahun[$xn] = $xn?>
<?php } ?>
<div class="form">
	<div class="box-body">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route),
			'method'=>'get', 
			'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'role'=>'form'
			),
		)); ?>
		<div class="row">
			<div class="col-lg-8">
				<?php echo $form->labelEx($model,'tahun'); ?>
				<?php echo $form->dropDownList($model, 'tahun',  $tahun, array('class'=>'form-control select2-element')); ?>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<button class="btn btn-primary btn-sm " name="yt0" type="submit">Cari <i class="fa fa-search"></i></button>
	</div>
<?php $this->endWidget(); ?>
</div>