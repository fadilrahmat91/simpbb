

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
								'id'=>'konten-detail-grid',
								'itemsCssClass' =>'table table-striped table-hover',
								'dataProvider'=>$model->search(),
								'filter'=>$model,
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
								//	'id',
									array(
									'name'=>'judul',
									'htmlOptions' => array('class' => 'css-esilepsis','style'=>'max-width:200px;'),
									),
									'tgl_buat',
									array(
									'name'=>'status',
									'type'=>'raw',
									'filter'=>KontenDetail::status(),
									'value'=>function($model){
										
										$data = $model->id;

										if($model->status == 1){
											return CHtml::link('on', '#', array('class'=>'btn btn-success btn-xs','id'=>$data,'onclick' => 'ganti_status('.$data.','.$model->status.')','data-url' => Yii::app()->createUrl('administrator/ajax/updatestatus')));

										}
											
											return CHtml::link('off', '#', array('class'=>'btn btn-danger btn-xs','id'=>$data,'onclick' => 'ganti_status('.$data.','.$model->status.')','data-url' => Yii::app()->createUrl('administrator/ajax/updatestatus')));

									},
									
									),
									array(
								
									'name'=>'gambar',
									'type'=>'raw',
									'value'=>function($model){
										$data=$model->gambar;
										if($data >= 1){
										$namafile =FileLokasi::model()->findByAttributes(array("id"=>$data))->nama_file;
										$imageUrl = Yii::app()->request->baseUrl.'/upload/konten/'.$namafile;
										$image = '<img class="img-fluid" src="'.$imageUrl.'" alt="" style="width:50px; height: 50px;" />';

										echo CHtml::link($image, array('items/viewslug'));
										
										
									}
								}
									),
									array(
									'name'=>'sumber',
									'htmlOptions' => array('class' => 'css-esilepsis','style'=>'max-width:200px;'),
									),
									array(
									'name'=>'isi_konten',
									'htmlOptions' => array('class' => 'css-esilepsis','style'=>'max-width:400px;'),
									'value' => 'strip_tags($data["isi_konten"])'
									),
									array(
									'name'=>'konten_id',
									'value'=>'Konten::model()->findByAttributes(array("id"=>$data["konten_id"]))->nama',
									 'filter'=>CHtml::listData(Konten::model()->findAll(),'id','nama'),
									 ),
									array(
										'header'=>'Action',
										'class'=>'CButtonColumn',
										'template'=>'{ubah} {delete} {lihat}',
								    	'buttons'=>array(
								        'ubah'=> array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/kontendetail/update/", array("id"=>$data->id,"gambar"=>$data->gambar))',
								            'options'=>array( 'class'=>'fa fa-pencil'),
								            'imageUrl'=>false,
								        ),
								        'lihat'=>array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/kontendetail/view/", array("id"=>$data->id))',
								            'options'=>array( 'class'=>'glyphicon glyphicon-eye-open' ),
								            'imageUrl'=>false,
								        ),
								         'delete'=>array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/kontendetail/delete/", array("id"=>$data->id,"gambar"=>$data->gambar))',
								            'options' => array('class'=>'fa fa-trash-o fa-lg'),
								            'imageUrl'=>false,
								        ),
								           // 'upload'=>array(
					              //         	'label'=>' ',
					              //         	'options' => array('class'=>'fa fa-image fa-lg'),
					              //         	'imageUrl'=>false,
					              //         	'url'=>'Yii::app()->createUrl("/administrator/kontendetail/upload",array("id"=>$data->id))',
					              //       ),
								           
										),
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



