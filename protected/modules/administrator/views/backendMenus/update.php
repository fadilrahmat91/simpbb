

<section class="content-header">
    <h1>
        Admin
        <small>Pengaturan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Data User </a></li>
        <li class="active">Ubah User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Ubah Data Administrator <?php echo $model->id; ?></h3>
					<div class="box-tools">
              </div>
				</div>
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
	</div>
</section>