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
				<?php echo $form->labelEx($model,'subjek_pajak_id'); ?>
				<?php echo $form->textField($model,'subjek_pajak_id',array('class'=>'form-control','placeholder'=>'Subjek Pajak')); ?>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'nm_wp'); ?>
				<?php echo $form->textField($model,'nm_wp',array('class'=>'form-control','placeholder'=>'Nama WP')); ?>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'jalan_wp'); ?>
				<?php echo $form->textField($model,'jalan_wp',array('class'=>'form-control','placeholder'=>'Jalan WP')); ?>
			</div>
			<div class="col-lg-4">
				<?php echo $form->labelEx($model,'status_pekerjaan_wp'); ?>
				<select class="select2-element form-control" name="SubjekPajak[status_pekerjaan_wp]">
		            <option>Pilih Status</option>
		            <?php foreach(Lookup::lookup_items_dropdown() as $p ){ ?>
		              <option <?=($model->status_pekerjaan_wp == $p['KD_LOOKUP_ITEM'] ? 'selected' : '')?> value="<?=$p['KD_LOOKUP_ITEM']?>"><?=$p['NM_LOOKUP_ITEM']?></option>
		            <?php } ?>
		          </select>
			</div>
		</div>
	</div>
	<div class="box-footer">
		<button class="btn btn-primary btn-sm" name="yt0" type="submit">Cari <i class="fa fa-search"></i></button>
	</div>
<?php $this->endWidget(); ?>
</div>