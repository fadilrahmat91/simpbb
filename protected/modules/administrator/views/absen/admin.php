<?php
/* @var $this AbsenController */
/* @var $model Absen */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#absen-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<section class="content-header">
	<h1>Hubungi kami
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
					<a data-toggle="modal" data-target="#tambah-matakuliah" class="btn btn-success btn-sm tombol_kanan " href="javascript:void(0);" ><i class="glyphicon glyphicon-plus"></i> &nbsp;&nbsp;Tambah </a>
					</div>
					<h3 class="box-title">Data Administrator</h3>

				</div>
					<div class="box-body">
					
					<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
					<div class="search-form" style="display:none">
					<?php $this->renderPartial('_search',array(
						'model'=>$model,
					)); ?>
					</div><!-- search-form -->

					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'absen-grid',
						'dataProvider'=>$model->search(),
						'filter'=>$model,
						'columns'=>array(
							'id',
							'id_ket',
							'nama',
							'nim',
							'id_absen',
							'tanggal',
							/*
							'id_matkul',
							'id_user',
							*/
							array(
								'class'=>'CButtonColumn',
							),
						),
					)); ?>
					</div>
</div>
</div>
</section>

<?php
/* @var $this HubungikamiController */
/* @var $model Hubungikami */

// $this->menu=array(
// 	array('label'=>'List Hubungikami', 'url'=>array('index')),
// 	array('label'=>'Create Hubungikami', 'url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#hubungikami-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<script>
 $("body").on("click", "#search_element input", function(){
            $(this).datepicker();
            $(this).datepicker("show");
    });

</script>
<style>
.css-esilepsis{
	 white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
</style>
