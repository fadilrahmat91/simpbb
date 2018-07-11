<?php
/* @var $this CrontabHistoryController */
/* @var $model CrontabHistory */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="col-md-4">
	<div class="form-group">
		<?php echo $form->label($model,'id',array('class'=>'col-sm-3 control-label')); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'code',array('class'=>'col-sm-3 control-label')); ?>
		<?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
	</div>

	

	<div class="box-footer">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->