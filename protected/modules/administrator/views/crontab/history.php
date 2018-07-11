



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
					

						<?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'crontab-history-grid',
							'dataProvider'=>$model->search(),
							
							'itemsCssClass' => 'table table-striped table-hover',
							'pagerCssClass'=>'text-center',    
								'pager'=>array(    
									'header'=>'',
									'prevPageLabel'=>'<',
									'nextPageLabel'=>'>',
										'selectedPageCssClass' => 'active',         
										'hiddenPageCssClass' => '',                        
										'htmlOptions'=>array(
											'class'=>'pagination',
										),                  
									),
							'columns'=>array(
								'id',
								'code',
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
