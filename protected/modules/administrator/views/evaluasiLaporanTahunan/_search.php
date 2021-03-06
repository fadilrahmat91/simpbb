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
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'tahun'); ?>
				<?php echo $form->dropDownList($model, 'tahun',  $tahun, array('class'=>'form-control select2-element')); ?>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kecamatan'); ?>
				<select id="Evaluasi_kecamatan" class="select2-element form-control" name="EvaluasiLaporanTahunan[kecamatan]">
					<option>Pilih Kecamatan</option>
					<?php foreach(Yii::app()->report->kecamatan() as $p ){ ?>
						<option <?=($model->kecamatan == $p['KD_KECAMATAN'] ? 'selected' : '')?> value="<?=$p['KD_KECAMATAN']?>"><?=$p['NM_KECAMATAN']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kelurahan'); ?>
				<select class="select2-element form-control" id="Evaluasi_kelurahan" name="EvaluasiLaporanTahunan[kelurahan]">
				<?=$keloption?>
				</select>
			</div>
		</div>
	</div>
		<div class="row">
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'group_by'); ?>
				<div class="radio">
					<label>
						<input type="radio" name="EvaluasiLaporanTahunan[group_by]" id="tahun_order_group" value="<?=LaporanKetetapan::ORDER_TAHUN?>" <?=$model->group_by == RealisasiTahunan::ORDER_TAHUN ? 'checked':''?>>
						Tahun
					 </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="EvaluasiLaporanTahunan[group_by]" id="kecamatan_order_group" value="<?=LaporanKetetapan::ORDER_KECAMATAN?>" <?=$model->group_by == RealisasiTahunan::ORDER_KECAMATAN ? 'checked':''?>>
					Tahun & Kecamatan
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input type="radio" name="EvaluasiLaporanTahunan[group_by]" id="kelurahan_order_group" value="<?=LaporanKetetapan::ORDER_KELURAHAN?>" <?=$model->group_by == RealisasiTahunan::ORDER_KELURAHAN ? 'checked':''?>>
					Tahun, Kecamatan & Kelurahan
				  </label>
				</div>
			</div>
		</div>
	<div class="box-footer">
		<button class="btn btn-primary btn-sm" name="yt0" type="submit">Cari <i class="fa fa-search"></i></button>
	</div>
<?php $this->endWidget(); ?>
</div>
<script>
$("document").ready(function(){
	$("select#Evaluasi_kecamatan").change(function(){
		var kec = $(this).val();
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKelurahan/getKelurahanbykecamatan?allowempty=1')?>", 'GET', {kecamatan:kec},function(response){
			$("select#Evaluasi_kelurahan").html(response.html);
		});
	});
})
</script>