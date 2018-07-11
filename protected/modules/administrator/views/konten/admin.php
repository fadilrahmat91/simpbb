
<section class="content-header">
	<h1>Pengaturan Konten
	<small>pengaturan</small>
	</h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-database"></i>
					<div class="box-tools">
						<a href="<?=Yii::app()->createAbsoluteUrl('administrator/konten/create')?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
					</div>

				<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
				<div class="search-form" style="display:none">
				<?php $this->renderPartial('_search',array(
					'model'=>$model,
				)); ?>
					<h3 class="box-title">Data Konten Detail</h3>

				</div>
					<div class="box-body">
							
						

					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'konten-grid',
						'itemsCssClass' =>'table table-striped table-hover',
						'dataProvider'=>$model->search(),
						'filter'=>$model,
						'columns'=>array(
							'id',
							'nama',
							'slug',
							array(
								'class'=>'CButtonColumn',
							),
						),
					)); ?>

								
					</div>
		   </div>
		</div>
	</div>
</section>
<?php
/* @var $this KontenController */
/* @var $model Konten */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#konten-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
