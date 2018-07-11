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
				
					<h3 class="box-title">Data Pertanyaan</h3>
				</div>
					<div class="box-body">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'hubungikami-grid',
						'dataProvider'=>$model->search(),
						'afterAjaxUpdate'=>"function(){jQuery('#search_element input').datepicker({'dateFormat': 'yy-mm-dd'}).on('changeDate', function(e){
    $(this).datepicker('hide');
})}",
						'filter'=>$model,
						'itemsCssClass' => 'table  table-bordered table-hover',
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
							//'id',
							'nama',
							'email',
							'no_telp',
							array(
								'name'=>'pertanyaan',
								'htmlOptions' => array('class' => 'css-esilepsis','style'=>'max-width:200px;'),							
							),
							array(
								'name'=>'jawaban',
								'htmlOptions' => array('class' => 'css-esilepsis','style'=>'max-width:200px;'),							
							),
							array(
								'name'=>'status_jawab',
								'value'=>'Hubungikami::status($data->status_jawab)',
								'filter'=>Hubungikami::status(),
							),
							//'tanggal_jawab',
							array(
								'name'=>'dijawab_oleh',
								'value'=>'User::get_user_by_id($data["dijawab_oleh"],"nama_lengkap")',
								'filter'=>CHtml::listData(User::model()->findAll(),'id','nama_lengkap'),
							
							),
							array(
	         					'name' => 'tanggal_kirim',
	         					'type' => 'raw',
								'filterHtmlOptions'=>array('id'=>'search_element')
	       					),
							//'tanggal_kirim',
							
							array(
								//'header'=>'Lihat',
								'class'=>'CButtonColumn',
								'template'=>'{view}',
								'buttons'=>array(
								'view'=>array(
								            'label'=>'Lihat',
								            'imageUrl'=>false,
								          'options'=>array('class'=>'btn btn-primary btn-xs fa fa-eye'),
								        ),
								
								)
							),
							array(
								//'header'=>'Lihat',
								'class'=>'CButtonColumn',
								'template'=>'{balas}',
								'buttons'=>array(
								'balas'=>array(
								            'label'=>'balas',
								            'url'=>'Yii::app()->createUrl("administrator/hubungikami/create",array("id"=>$data->id))',
								            'options'=>array('class'=>'btn btn-warning btn-xs fa fa-reply'),
								        ),
								
								)
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