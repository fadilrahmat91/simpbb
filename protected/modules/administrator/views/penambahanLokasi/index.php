<section class="content-header">
    <h1>
        Data Lokasi NOP Yang Saya Tambahkan
        <small>Lokasi NOP</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">DATA LOKASI</h3>
					<div class="box-tools">
						<?php echo CHtml::link("Tambahkan Lokasi Baru",array('create'),array('class'=>"btn btn-primary btn-sm")) ?>
					</div>
				</div>
				<div class="box-body">
					<?php $this->renderPartial('_listlokasi', array('model'=>$model)); ?>
				</div>
			</div>
		</div>
	</div>
</section>