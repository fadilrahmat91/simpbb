<section class="content-header">
    <h1>
        Pengaturan
        <small>User</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active">Data User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-database"></i> 
					<div class="  box-tools">
						<a href="<?=Yii::app()->createAbsoluteUrl('/administrator/user/create')?>"  class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</a>
					</div>
					<h3 class="box-title">Data user</h3>
				</div>
				<div class="box-body">
					
					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'user-grid',
						'dataProvider'=>$model->search(),
						'filter'=>$model,
						'itemsCssClass' => 'table table-bordered table-hover',
						'columns'=>array(
							
							'username',
							array(
							'name'=>'userlevel',
							'value'=>'UserRole::model()->findByAttributes(array("kode"=>$data["userlevel"]))->nama_akses',
							'filter'=>CHtml::listData(UserRole::model()->findAll(),'kode','nama_akses'),
							//'htmlOptions' => array('style' => "text-align:center;"),
							),
							'nik',
							'nama_lengkap',
							'tanggal_daftar',
							/*
							'tanggal_ubah',
							'password',
							*/
							 array('class'=>'CButtonColumn',
								    'template'=>'{ubah} {view} {delete}',
								    'buttons'=>array (
								        'ubah'=> array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/user/update",array("id"=>$data->id))',
								            'options'=>array( 'class'=>'fa fa-pencil'),
								        ),
								        'view'=>array(
								            'label'=>'',
								            'imageUrl'=>false,
								            'options'=>array( 'class'=>'icon-search' ),
								        ),
								        'delete'=>array(
								            'label'=>'',
								            'url'=>'Yii::app()->createUrl("/administrator/user/delete",array("id"=>$data->id))',
								            'options'=>array( 'class'=>'fa fa-trash-o fa-lg' ),
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





