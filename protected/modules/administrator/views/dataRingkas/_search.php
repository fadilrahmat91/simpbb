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
			<div class="col-lg-6">
				<?php echo $form->labelEx($model,'propinsi'); ?>
				<?php echo $form->dropDownList($model, 'propinsi',  Yii::app()->report->propinsi(), array('class'=>'select2-element form-control' )); ?>
			</div>
			<!-- /.col-lg-6 -->
			<div class="col-lg-6">
				<?php echo $form->labelEx($model,'kotadati2'); ?>
				<?php echo $form->dropDownList($model, 'kotadati2',  Yii::app()->report->kabupaten(), array('class'=>'select2-element form-control' )); ?>
			</div>
			<!-- /.col-lg-6 -->
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kecamatan'); ?>
				<select id="DataRingkasan_kecamatan" class="select2-element form-control" name="DataRingkasan[kecamatan]">
					<option>Pilih Kecamatan</option>
					<?php foreach(Yii::app()->report->kecamatan() as $p ){ ?>
						<option <?=($model->kecamatan == $p['KD_KECAMATAN'] ? 'selected' : '')?> value="<?=$p['KD_KECAMATAN']?>"><?=$p['KD_KECAMATAN'].'-'.$p['NM_KECAMATAN']?></option>
					<?php } ?>
				</select>
			</div>
			<!-- /.col-lg-6 -->
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kelurahan'); ?>
				<select class="select2-element form-control" id="DataRingkasan_kelurahan" name="DataRingkasan[kelurahan]">
				<?=$keloption?>
				</select>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'blok'); ?>
				<?php echo $form->textField($model,'blok',array('class'=>'form-control','placeholder'=>'Blok')); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'nama_wp'); ?>
				<?php echo $form->textField($model,'nama_wp',array('class'=>'form-control','placeholder'=>'NAMA WP')); ?>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'letak_op'); ?>
				<?php echo $form->textField($model,'letak_op',array('class'=>'form-control','placeholder'=>'Letak OP')); ?>
			</div>
		</div>
		<!-- /.col-lg-6 -->
	</div>
	
	
	<div class="box-footer">
		<button class="btn btn-primary btn-sm" name="yt0" type="submit">Cari  <i class="fa fa-search"></i></button>
	</div>
	<?php $this->endWidget(); ?>

</div>

<script>
$("document").ready(function(){
	$("select#DataRingkasan_kecamatan").change(function(){
		var kec = $(this).val();
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKelurahan/getKelurahanbykecamatan')?>", 'GET', {kecamatan:kec},function(response){
			$("select#DataRingkasan_kelurahan").html(response.html);
		});
	});
	$('select.select2-element').select2();
})
</script>