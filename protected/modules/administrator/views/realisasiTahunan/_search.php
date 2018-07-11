<?php
/* @var $this ZoneController */
/* @var $model Zone */
/* @var $form CActiveForm */
$tahun = [];
?>
<?php for( $xn = Yii::app()->report->tahun_akhir(); $xn >= Yii::app()->report->tahun_mulai(); $xn-- ){ ?>
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
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'tahun'); ?>
				<?php echo $form->dropDownList($model, 'tahun',  $tahun, array('class'=>'select2-element form-control','multiple'=>'multiple','data-placeholder'=>'Pilih Tahun')); ?>
			</div>    
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kecamatan'); ?>
				<select id="RealisasiTahunan_kecamatan" class="select2-element form-control" name="RealisasiTahunan[kecamatan]">
					<option>Pilih Kecamatan</option>
					<?php foreach(Yii::app()->report->kecamatan() as $p ){ ?>
						<option <?=($model->kecamatan == $p['KD_KECAMATAN'] ? 'selected' : '')?> value="<?=$p['KD_KECAMATAN']?>"><?=$p['KD_KECAMATAN'].'-'.$p['NM_KECAMATAN']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kelurahan'); ?>
				<select class="select2-element form-control" id="RealisasiTahunan_kelurahan" name="RealisasiTahunan[kelurahan]">
				<?=$keloption?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'tanggal_bayar'); ?>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<?php echo $form->textField($model,'tanggal_bayar',array('class'=>'form-control','placeholder'=>'Tanggal Bayar')); ?>
				</div>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'tanggal_terbit_sppt'); ?>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<?php echo $form->textField($model,'tanggal_terbit_sppt',array('class'=>'form-control','placeholder'=>'Tanggal Terbit Sppt')); ?>
				</div>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'group_by'); ?>
				<div class="radio">
					<label>
						<input type="radio" name="RealisasiTahunan[group_by]" id="tahun_order_group" value="<?=RealisasiTahunan::ORDER_TAHUN?>" <?=$model->group_by == RealisasiTahunan::ORDER_TAHUN ? 'checked':''?>>
						Tahun
					 </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="RealisasiTahunan[group_by]" id="kecamatan_order_group" value="<?=RealisasiTahunan::ORDER_KECAMATAN?>" <?=$model->group_by == RealisasiTahunan::ORDER_KECAMATAN ? 'checked':''?>>
					Tahun & Kecamatan
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="RealisasiTahunan[group_by]" id="kelurahan_order_group" value="<?=RealisasiTahunan::ORDER_KELURAHAN?>" <?=$model->group_by == RealisasiTahunan::ORDER_KELURAHAN ? 'checked':''?>>
					Tahun, Kecamatan & Kelurahan
				  </label>
				</div>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<div class="form-group">
			<button class="btn btn-primary btn-sm" name="yt0" type="submit">Cari <i class="fa fa-search"></i></button>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<script>
$("document").ready(function(){
	$("select#RealisasiTahunan_kecamatan").change(function(){
		var kec = $(this).val();
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKelurahan/getKelurahanbykecamatan?allowempty=1')?>", 'GET', {kecamatan:kec},function(response){
			$("select#RealisasiTahunan_kelurahan").html(response.html);
		});
	});
	
	$('#RealisasiTahunan_tanggal_bayar').daterangepicker({
			autoUpdateInput: false
		}, function(start_date, end_date) {
			$('#RealisasiTahunan_tanggal_bayar').val(start_date.format('MM-DD-YYYY')+' - '+end_date.format('MM-DD-YYYY'));
		}
	);
	$('#RealisasiTahunan_tanggal_terbit_sppt').daterangepicker({
			autoUpdateInput: false
		}, function(start_date, end_date) {
			$('#RealisasiTahunan_tanggal_terbit_sppt').val(start_date.format('MM-DD-YYYY')+' - '+end_date.format('MM-DD-YYYY'));
		}
	);
})
</script>