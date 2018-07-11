<section class="content-header">
	<h1>Pengaturan Crontab
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
						<a href="<?=Yii::app()->createAbsoluteUrl('/administrator/crontab/create')?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
					</div>
					<h3 class="box-title">Data Administrator</h3>

				</div>
					<div class="box-body">
							

							<?php $this->widget('zii.widgets.grid.CGridView', array(
								'id'=>'crontab-grid',
								'dataProvider'=>$model->search(),
								'filter'=>$model,
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
									'code',
									'nama_crontab',
									'url',
									'last_running',
									array(
										'header'=>'Action',
										'class'=>'CButtonColumn',
										'template'=>'{ubah} {delete} {lihat} {lari}',
								    	'buttons'=>array(
								        'ubah'=> array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/crontab/update/", array("id"=>$data->id))',
								            'options'=>array( 'class'=>'fa fa-pencil'),
								            'imageUrl'=>false,
								        ),
								        'lihat'=>array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/crontab/history/", array("code"=>$data->code))',
								            'options'=>array( 'class'=>'glyphicon glyphicon-eye-open' ),
								            'imageUrl'=>false,
								        ),
								         'delete'=>array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/crontab/delete/", array("id"=>$data->id,"code"=>$data->code))',
								            'options' => array('class'=>'fa fa-trash-o fa-lg'),
								            'imageUrl'=>false,
								        ),
								           'lari'=>array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("$data[url]")',
								            'options'=>array( 'class'=>'glyphicon glyphicon-play run_data'),
								            'imageUrl'=>false,
									        ),

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