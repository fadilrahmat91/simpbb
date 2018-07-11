<?php
/* @var $this KontenDetailController */
/* @var $model KontenDetail */
/* @var $form CActiveForm */
?>


<div class="form">
	<div class="box-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'konten-detail-form',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		 'enctype' => 'multipart/form-data',
		'role'=>'form'
	),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
 	
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'konten_id',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-4">
		<?php echo $form->dropDownList($model,'konten_id',CHtml::listData(Konten::model()->findAll(),'id','nama'),array('class'=>'form-control'));?>
		</div>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'judul',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-8">
		<?php echo $form->textField($model,'judul',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'judul'); ?>
	</div>
	</div>

	
	<div class="form-group">
        <?php echo $form->labelEx($model,'gambar',array('class'=>'col-sm-3 control-label')); ?>
        <div class="col-sm-8">
        <?php echo CHtml::error($model, 'gambar')?>
   		<?php echo CHtml::activeFileField($model, 'gambar')?>
		
			
			<?php if($model->gambar >= 1) { ?>
			<?php echo $namafile =FileLokasi::model()->findByAttributes(array("id"=>$model["gambar"]))->nama_file; ?>
		    <img class="img-fluid" src="<?php echo Yii::app()->request->baseUrl; ?>/upload/konten/<?php echo $namafile; ?>" alt="" style="width:100px; height: 100px;">
		<?php    } ?>
		

		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'isi_konten',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-8">
		<?php echo $form->textArea($model,'isi_konten',array("id"=>"editor1" )); ?>
		<?php echo $form->error($model,'isi_konten'); ?>
	</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'sumber',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-8">
		<?php echo $form->textArea($model,'sumber',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'sumber'); ?>
	</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->checkBox($model,'status'); ?>
			<?php echo $form->error($model,'status'); ?>
		</div>
	</div>


	<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
/* @var $this KontenController */
/* @var $model Konten */
/* @var $form CActiveForm */
?>


<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()

       //Date picker
    $('#datepicker').datepicker({
    	format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
      autoclose: true
    })
  })
</script>
<!-- <script>
	$("document").ready(function(){
		$("form#konten-detail-form").submit(function(){
			var _form = $(this);
			Ajax.run(_form.attr('action'),'POST',_form.serialize(),function(response){
				if(response.status == 'ok' ){
					alert(response.msg);
					_form[0].reset();
				}else{
					//Ajax.run_error();
					alert(response.msg);
				}
			});
			return false;
		})
	});
</script> -->


