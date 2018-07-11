<section class="content-header">
    <h1>
        Pengaturan menu Administrator
        <small>Pengaturan</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active">Data</li>
    </ol>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-database"></i>
					<div class="box-tools">
						<a href="<?=Yii::app()->createAbsoluteUrl('/administrator/backendMenus/create')?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
					</div>
					<h3 class="box-title">Data Administrator</h3>

				</div>
					<div class="box-body">
				
								<?php $this->widget('zii.widgets.grid.CGridView', array(
									'id'=>'backend-menus-grid',
									'dataProvider'=>$model->search(),
									'filter'=>$model,
									'itemsCssClass' => 'table table-striped table-hover',
									'columns'=>array(
									'id',
									array(
									'name'=>'parent_menu',
									'value'=>'backendMenus::model()->findByAttributes(array("id"=>$data["parent_menu"]))->nama_menu',
									'filter'=>CHtml::listdata(backendMenus::model()->findAllByAttributes(array('parent_menu'=>0)),'id','nama_menu'),
									
									),
									// 'parent_menu',
									// 'nama_menu',
									'link_url',
									array(
									'name'=>'status',
									 'value'=>'BackendMenus::status($data->status)',
									 'filter'=>BackendMenus::status(),
									),
									array(
									'class'=>'CButtonColumn',
								    'template'=>'{ubah} {delete} {maneger}',
								    'buttons'=>array (
								   
								        'ubah'=> array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/backendMenus/update/", array("id"=>$data->id))',
								            'options'=>array( 'class'=>'fa fa-pencil'),
								        ),
								        
								        'delete'=>array(
								            'label'=>'',
								            'imageUrl'=>false,
								            'options'=>array( 'class'=>'fa fa-trash-o fa-lg' ),
								        ),
								        'maneger'=>array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/backendMenus/manageAction/", array("id"=>$data->id))',
								            'options'=>array( 'class'=>'fa fa-user' ),
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
