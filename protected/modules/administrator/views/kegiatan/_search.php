<?php
/* @var $this TableKegiatanController */
/* @var $model TableKegiatan */
/* @var $form CActiveForm */
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
		        <?php echo $form->label($model,'nama_kegiatan'); ?>
		        <?php echo $form->textField($model,'nama_kegiatan',array('class'=>'form-control','placeholder'=>'Nama Kegiatan')); ?>
	      </div>
	      <div class="col-lg-4">
	        	<?php echo $form->labelEx($model,'tanggal_kegiatan'); ?>
			    <div class="input-group">
			     	<div class="input-group-addon">
			        	<i class="fa fa-calendar"></i>
			      	</div>
			      	<?php echo $form->textField($model,'tanggal_kegiatan',array('class'=>'form-control datepicker','placeholder'=>'Tanggal Kegiatan')); ?>
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
  $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
  });
})
</script>