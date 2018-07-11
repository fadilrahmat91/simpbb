<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'table-kegiatan-form',
    'htmlOptions'=>array(
      'class'=>'form-horizontal',
      'role'=>'form'
    ),
    'enableAjaxValidation'=>false,
  )); 
?>
<div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header with-border">
      <i class="ion ion-clipboard"></i>
      <h3 class="box-title">Form Tambah</h3>
      <div class="box-tools">
        <?php echo CHtml::link("Data Subjek Pajak",array('admin'),array('class'=>"btn btn-primary btn-sm")) ?>
      </div>
    </div>
    <div class="box-body">
      <form class="form-horizontal">
          <div class="box-body">
            <div class="form-group">
              <?php echo $form->labelEx($model,'subjek_pajak_id',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <input type="text" name="<?= $model->subjek_pajak_id?>" value="<?= $model->subjek_pajak_id?>" class="form-control" data-inputmask="'mask': ['99.99.99.99.99.99.99.99.99', '999999999999999999']" data-mask>
                <?php echo $form->error($model,'subjek_pajak_id'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'nm_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'nm_wp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'nm_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'jalan_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'jalan_wp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'jalan_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'blok_kav_no_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'blok_kav_no_wp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'blok_kav_no_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'rw_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'rw_wp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'rw_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'rt_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'rt_wp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'rt_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'kelurahan_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'kelurahan_wp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'kelurahan_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'kota_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'kota_wp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'kota_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'kd_pos_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'kd_pos_wp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'kd_pos_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'telp_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <input type="text" name="<?= $model->telp_wp?>" value="<?= $model->telp_wp?>" class="form-control" data-inputmask="'mask': ['9999.9999.9999', '9999 9999 9999']" data-mask>
                <?php echo $form->error($model,'telp_wp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'npwp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <?php echo $form->textField($model,'npwp',array('class'=>'form-control', 'maxlength'=>50)); ?>
                <?php echo $form->error($model,'npwp'); ?>
              </div>
            </div>
            <div class="form-group">
              <?php echo $form->labelEx($model,'status_pekerjaan_wp',array('class'=>'col-sm-2 control-label')); ?>

              <div class="col-sm-10">
                <select class="select2-element form-control" name="<?= $model->status_pekerjaan_wp?>">
                  <option>Pilih Status</option>
                  <?php foreach(Lookup::lookup_items_dropdown() as $p ){ ?>
                    <option <?=($model->status_pekerjaan_wp == $p['KD_LOOKUP_ITEM'] ? 'selected' : '')?> value="<?=$p['KD_LOOKUP_ITEM']?>"><?=$p['NM_LOOKUP_ITEM']?></option>
                  <?php } ?>
                </select>
                <?php echo $form->error($model,'status_pekerjaan_wp'); ?>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary pull-right')); ?>
          </div>
          <!-- /.box-footer -->
      </form>
      <?php //$this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="box box-primary">
    <div class="box-header with-border">
      <i class="ion ion-clipboard"></i>
      <h3 class="box-title">User & Password</h3>
    </div>
    <div class="box-body">
      <form class="form-horizontal">
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
      </form>
      <?php //$this->renderPartial('_form_user_password', array('model'=>$model)); ?>
    </div>
  </div>
</div>
<?php $this->endWidget(); ?>
<script>
  $("document").ready(function(){
    $('[data-mask]').inputmask();
        var  in_array = function(needle, haystack) {
        for(var i in haystack) {
          if(haystack[i] == needle) return true;
        }
        return false;
    }
  });
</script>