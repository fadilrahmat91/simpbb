<section class="content-header">
		<h1>
			Konten
				<small>Pengaturan</small>
		</h1>
		<ol class="breadcrumb">
				<li><a href=""><i class="fa fa-dashboard"></i>Update Konten</a></i>
				<li class="active">Ubah Konten</li>
		</ol>
</section>
	<section class="content">
	    <div class="row">
			<div class="col-md-10">
				<div class="box box-primary">
					<div class="box-header with-border">
						<i class="ion ion-clipboard"></i>
						<h3 class="box-title">Ubah Data Konten <?php echo $model->id; ?></h3>
						<div class="box-tools"> </div>
					</div>
					<?php $this->renderPartial('_form_edit', array('model'=>$model)); ?>
				</div>
		   </div>
		</div>
	</section>



	

