

<section class="content-header">
	<h1>Pengaturan Konten Detail
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
						<a href="<?=Yii::app()->createAbsoluteUrl('administrator/kontendetail/create')?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
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
							'id'=>'mata-kuliah-grid',
							'dataProvider'=>$model->search(),
							'filter'=>$model,
							'columns'=>array(
								'id_matkul',
								'mata_kuliah',
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

// Yii::app()->clientScript->registerScript("
// $('#run_data').click(function(){
// 	alert('a');
// 	return false;
// });
// ");
// ?>

<?php
/* @var $this KontenDetailController */
/* @var $model KontenDetail */



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#konten-detail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>
<script type="text/javascript">

	function ganti_status(id,status){
		
		var url = $("#"+id).data('url');

		$.get(url+"/id/"+id+"/status/"+status,function(data){
			
		    if (status == 1) {
		         confirm(" apakah anda yakin ingin menonaktifkan ini?");
		    } else {
		         confirm(" apakah anda yakin ingin mengaktifkan ini?");
		    }
			$("#"+id).parent().html(data);
		})
	}
		
</script>
<style>
.css-esilepsis{
	 white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
</style>




