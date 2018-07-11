<?php
/* @var $this BackendMenusController */
/* @var $model BackendMenus */
/* @var $form CActiveForm */
?>

<div class="form">
<div class="box-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'backend-menus-form',
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php $parent = BackendMenus::model()->findAll(
		array(
                      'condition' => 'parent_menu = :parent_menu',
                      'params'    => array(':parent_menu' => 0)
                  )
	);?>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'parent_menu',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->dropDownList($model, 'parent_menu',  array('0'=>'Menu Utama') + CHtml::listData($parent, 'id', 'nama_menu'), array('class'=>'form-control' )); ?>
			<?php echo $form->error($model,'parent_menu'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nama_menu',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->textField($model,'nama_menu',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'nama_menu'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'kontroller',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->textField($model,'kontroller',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'kontroller'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'link_url',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->textField($model,'link_url',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'link_url'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php echo $form->checkBox($model,'status'); ?>
			<?php echo $form->error($model,'status'); ?>
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
		$("form#backend-menus-form").submit(function(){
			var _form = $("form#backend-menus-form");
			var dataku =$("input#BackendMenus_nama_menu").val();

			Ajax.run(_form.attr('action'),'POST',_form.serialize(),function(response){
				// console.log(_form);
				//alert(dataku);
				if(response.status == 'ok-update' ){
					alert(response.msg);
					window.location.href = response.redirect;
				}else if(response.status == 'ok' ){
					alert(response.msg);
					_form[0].reset();
				}else{
					// show eror login;
					//Ajax.run_error();
					alert(response.msg);
				}
			});
			return false;
		})
	});
</script>