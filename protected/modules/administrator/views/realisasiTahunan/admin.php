
<section class="content-header">
    <h1>
        LAPORAN
        <small>Pembayaran & Realisasi</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Form Laporan Pembayaran & Realisasi Tahunan</h3>
				</div>
				<div class="box-body">
				<?php 
					$this->renderPartial('_search',array('model'=>$model,'keloption'=>$keloption)); 
				?>
				</div>
			</div>
			<div class="box box-default">
				<div class="box-header with-border">
					<i class="fa fa-database"></i> 
					<h3 class="box-title">Laporan Pembayaran & Realisasi Tahunan</h3>
					<div class="box-tools">
						<a class="btn btn-default btn-sm pull-right" href="<?=Yii::app()->createUrl('administrator/realisasiTahunan/export',array('tahun' => $model->tahun,'kecamatan'=>$model->kecamatan,'kelurahan'=>$model->kelurahan,'tanggal_bayar'=>$model->tanggal_bayar,'group_by'=>$model->group_by,'tanggal_terbit_sppt'=>$model->tanggal_terbit_sppt))?>">Export <i class=" fa fa-file-excel-o"></i></a>
					</div>
				</div>
				<div class="box-body">
					<?php $this->renderPartial('_rGridView',array('model'=>$model)); ?>
				</div>
			</div>
		</div>
	</div>
</section>

