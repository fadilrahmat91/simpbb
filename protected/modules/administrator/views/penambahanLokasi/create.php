<section class="content-header">
    <h1>
        Penambahan
        <small>Lokasi</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Form Pencarian Lokasi</h3>
					<div class="box-tools">
						<?php echo CHtml::link("Data Lokasi",array('index'),array('class'=>"btn btn-primary btn-sm")) ?>
					</div>
				</div>
				<div class="box-body">
					<?php $this->renderPartial('_search', array('model'=>$model)); ?>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Form Tambah Lokasi</h3>
				</div>
				<div class="box-body">
					<?php $this->renderPartial('_form', array('model'=>$model)); ?>
				</div>
			</div>
		</div>
	</div>
</section>