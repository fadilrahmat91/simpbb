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
				<select id="LaporanKetetapan_kecamatan" class="select2-element form-control" name="LaporanKetetapan[kecamatan]">
					<option>Pilih Kecamatan</option>
					<?php foreach(Yii::app()->report->kecamatan() as $p ){ ?>
						<option <?=($model->kecamatan == $p['KD_KECAMATAN'] ? 'selected' : '')?> value="<?=$p['KD_KECAMATAN']?>"><?=$p['NM_KECAMATAN']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kelurahan'); ?>
				<select class="select2-element form-control" id="LaporanKetetapan_kelurahan" name="LaporanKetetapan[kelurahan]">
				<?=$keloption?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				
					<?php echo $form->labelEx($model,'status_bayar'); ?>
					<?php echo $form->dropDownList($model, 'status_bayar', array(''=>'Pilih Status',0=>'Belum Bayar',1=>'Bayar'), array('class'=>'form-control select2-element' )); ?>
				
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'tanggal_terbit'); ?>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<?php echo $form->textField($model,'tanggal_terbit',array('class'=>'form-control','placeholder'=>'Tanggal Terbit')); ?>
				</div>
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
	$("select#LaporanKetetapan_kecamatan").change(function(){
		var kec = $(this).val();
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKelurahan/getKelurahanbykecamatan?allowempty=1')?>", 'GET', {kecamatan:kec},function(response){
			$("select#LaporanKetetapan_kelurahan").html(response.html);
		});
	});
	
	$('#LaporanKetetapan_tanggal_terbit').daterangepicker(
		{
			autoUpdateInput: false
		}, function(start_date, end_date) {
			$('#LaporanKetetapan_tanggal_terbit').val(start_date.format('MM-DD-YYYY')+' - '+end_date.format('MM-DD-YYYY'));
		}
	)
})
</script>