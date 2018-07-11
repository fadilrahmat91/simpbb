<section class="content-header">
    <h1>
        User
        <small>Pengaturan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=Yii::app()->createAbsoluteUrl('administrator/user/admin')?>"><i class="fa fa-dashboard"></i> Data User </a></li>
        <li class="active">Ubah User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Ubah User <?php echo $model->nik; ?></h3>
					<div class="box-tools">
                <a href="<?=Yii::app()->createAbsoluteUrl('administrator/user/create')?>" class="btn btn-primary">Tambah User</a>
              </div>
				</div>
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</section>