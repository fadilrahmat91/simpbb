<?php
/* @var $this HubungikamiController */
/* @var $model Hubungikami */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="col-md-4">
	<div class="form-group">
		<?php echo $form->label($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
	</div>

	<div class="box-footer">
		<?php echo CHtml::submitButton('Search',array('class'=>'btn btn-primary')); ?>
	</div>
   </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->