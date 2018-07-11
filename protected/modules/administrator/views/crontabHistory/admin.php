



<section class="content-header">
	<h1> Crontab History
	<small>pengaturan</small>
	</h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-database"></i>
					<!-- <div class="box-tools">
						<a href="" class="btn btn-primary"></a>
					</div> -->
					<h3 class="box-title">Data CrontabHistory</h3>

				</div>
					<div class="box-body">				
						<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
						<div class="search-form" style="display:none">
							<?php $this->renderPartial('_search',array(
								'model'=>$model,
							)); ?>
						</div><!-- search-form -->

						<?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'crontab-history-grid',
							'dataProvider'=>$model->search(),
							'filter'=>$model,
							'itemsCssClass' => 'table table-striped table-hover',
							'columns'=>array(
								'id',
								array(
								'name'=>'code',
								'filter'=>CHtml::listData(CrontabHistory::model()->findAll(),'code','code'),
								),
								'tanggal_running',
								/*array(
									'class'=>'CButtonColumn',
								),*/
							),
						)); ?>
								
					</div>
		   </div>
		</div>
	</div>
</section>

<?php
/* @var $this CrontabHistoryController */
/* @var $model CrontabHistory */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#crontab-history-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
