<?php
/* @var $this ZoneController */
/* @var $model Zone */
/* @var $form CActiveForm */
$tahun = [];
?>

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
				<?php echo $form->labelEx($model,'tanggal_bayar'); ?>
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<?php echo $form->textField($model,'tanggal_bayar',array('class'=>'form-control','placeholder'=>'Tanggal Bayar')); ?>
				</div>
			</div>   
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kecamatan'); ?>
				<select id="LaporanPembayaranNik_kecamatan" class="select2-element form-control" name="LaporanPembayaranNik[kecamatan]">
					<option>Pilih Kecamatan</option>
					<?php foreach(Yii::app()->report->kecamatan() as $p ){ ?>
						<option <?=($model->kecamatan == $p['KD_KECAMATAN'] ? 'selected' : '')?> value="<?=$p['KD_KECAMATAN']?>"><?=$p['KD_KECAMATAN'].'-'.$p['NM_KECAMATAN']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'kelurahan'); ?>
				<select class="select2-element form-control" id="LaporanPembayaranNik_kelurahan" name="LaporanPembayaranNik[kelurahan]">
				<?=$keloption?>
				</select>
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
	$("select#LaporanPembayaranNik_kecamatan").change(function(){
		var kec = $(this).val();
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKelurahan/getKelurahanbykecamatan?allowempty=1')?>", 'GET', {kecamatan:kec},function(response){
			$("select#LaporanPembayaranNik_kelurahan").html(response.html);
		});
	});
	
	/*$('#LaporanPembayaranNik_tanggal_bayar').datepicker({
			autoUpdateInput: false
		}, function(date) {
			$('#LaporanPembayaranNik_tanggal_bayar').val(date.format('MM-DD-YYYY'));
		}
	)*/
	$('#LaporanPembayaranNik_tanggal_bayar').datepicker({
		format: 'mm-dd-yyyy'
	});
})
</script>