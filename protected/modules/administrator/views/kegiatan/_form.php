<?php
/* @var $this TableKegiatanController */
/* @var $model TableKegiatan */
/* @var $form CActiveForm */
?>
 
<div class="form">
  <div class="box-body">
    <?php $form=$this->beginWidget('CActiveForm', array(
      'id'=>'table-kegiatan-form',
      'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>'form'
      ),
      // Please note: When you enable ajax validation, make sure the corresponding
      // controller action is handling ajax validation correctly.
      // There is a call to performAjaxValidation() commented in generated controller code.
      // See class documentation of CActiveForm for details on this.
      'enableAjaxValidation'=>false,
    )); ?>
 
      <p class="note">Field <span class="required">*</span> Harus diisi.</p>
 
      <div class="form-group">
        <?php echo $form->labelEx($model,'nama_kegiatan',array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-9">
          <?php echo $form->textField($model,'nama_kegiatan',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
          <?php echo $form->error($model,'nama_kegiatan'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model,'dropcaps',array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-9">
          <?php echo $form->textArea($model,'dropcaps',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
          <?php echo $form->error($model,'dropcaps'); ?>
        </div>
      </div>

      <div class="form-group">
        <?php echo $form->labelEx($model,'keterangan_kegiatan',array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-9">
          <?php echo $form->textArea($model,'keterangan_kegiatan',array('class'=>'form-control','rows'=>6, 'cols'=>50)); ?>
          <?php echo $form->error($model,'keterangan_kegiatan'); ?>
        </div>
      </div>
 
      <div class="form-group">
        <?php echo $form->labelEx($model,'tanggal_kegiatan',array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-9">
          <?php echo $form->textField($model,'tanggal_kegiatan',array('class'=>'datepicker form-control')); ?>
          <?php echo $form->error($model,'tanggal_kegiatan'); ?>
        </div>
      </div>
  </div>
  <div class="box-footer">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Ubah',array('id'=>'simpanmenusaya','class'=>'btn btn-primary','name'=>'simpanmenu')); ?>
  </div>
  <?php $this->endWidget(); ?>
 
</div><!-- form -->
<script>
$("document").ready(function(){
  $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
  });
})
</script>