<section class="content-header">
    <h1>
        User
        <small>Pengaturan</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Ubah Akses</h3>
					
				</div>
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</section>