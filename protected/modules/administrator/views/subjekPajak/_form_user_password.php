<form class="form-horizontal">
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
    <div class="box-body">
      <div class="form-group">
        <?php echo $form->labelEx($model,'email',array('class'=>'col-sm-2 control-label')); ?>

        <div class="col-sm-10">
          <?php echo $form->textField($model,'email',array('class'=>'form-control', 'maxlength'=>50)); ?>
          <?php echo $form->error($model,'email'); ?>
        </div>
      </div>
      <div class="form-group">
        <?php echo $form->labelEx($model,'password',array('class'=>'col-sm-2 control-label')); ?>

        <div class="col-sm-10">
          <?php echo $form->passwordField($model,'password',array('class'=>'form-control', 'maxlength'=>50)); ?>
          <?php echo $form->error($model,'password'); ?>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary pull-right')); ?>
    </div>
    <!-- /.box-footer -->
  <?php $this->endWidget(); ?>
</form>