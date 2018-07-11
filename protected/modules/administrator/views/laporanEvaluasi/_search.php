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
				<?php echo $form->dropDownList($model, 'tahun',  $tahun, array('class'=>'form-control select2-element')); ?>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kecamatan'); ?>
				<select id="LaporanPembayaran_kecamatan" class="select2-element form-control" name="LaporanEvaluasi[kecamatan]">
					<option>Pilih Kecamatan</option>
					<?php foreach(Yii::app()->report->kecamatan() as $p ){ ?>
						<option <?=($model->kecamatan == $p['KD_KECAMATAN'] ? 'selected' : '')?> value="<?=$p['KD_KECAMATAN']?>"><?=$p['KD_KECAMATAN'].'-'.$p['NM_KECAMATAN']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kelurahan'); ?>
				<select class="select2-element form-control" id="LaporanPembayaran_kelurahan" name="LaporanEvaluasi[kelurahan]">
				<?=$keloption?>
				</select>
			</div>

			<div class="col-lg-4">
				
					<?php echo $form->labelEx($model,'selisih'); ?>

					<?php echo $form->dropDownList($model, 'selisih', array(''=>'Pilih',1=>'Lebih Bayar',0=>'Kurang bayar'), array('class'=>'form-control select2-element' )); ?>
				
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
	$("select#LaporanPembayaran_kecamatan").change(function(){
		var kec = $(this).val();
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKelurahan/getKelurahanbykecamatan?allowempty=1')?>", 'GET', {kecamatan:kec},function(response){
			$("select#LaporanPembayaran_kelurahan").html(response.html);
		});
	});
	
	$('#LaporanPembayaran_tanggal_bayar').daterangepicker(
		{
			autoUpdateInput: false
		}, function(start_date, end_date) {
			$('#LaporanPembayaran_tanggal_bayar').val(start_date.format('MM-DD-YYYY')+' - '+end_date.format('MM-DD-YYYY'));
		}
	);
	$('#LaporanPembayaran_tanggal_terbit_sppt').daterangepicker(
		{
			autoUpdateInput: false
		}, function(start_date, end_date) {
			$('#LaporanPembayaran_tanggal_terbit_sppt').val(start_date.format('MM-DD-YYYY')+' - '+end_date.format('MM-DD-YYYY'));
		}
	);
})

</script>