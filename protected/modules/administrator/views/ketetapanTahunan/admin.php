<section class="content-header">
    <h1>
        LAPORAN
        <small>Ketetapan Tahunan</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Form Laporan Ketetapan</h3>
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
					<h3 class="box-title">Data Ketetapan</h3>
					<div class="box-tools">
						<a class="btn btn-default btn-sm pull-right" href="<?=Yii::app()->createAbsoluteUrl('administrator/ketetapanTahunan/export/tahun/'.$model->tahun.'/kecamatan/'.$model->kecamatan.'/kelurahan/'.$model->kelurahan.'/status_bayar/'.$model->status_bayar.'/tanggal_terbit/'.$model->tanggal_terbit.'/tanggal_jatuh_tempo/'.$model->tanggal_jatuh_tempo.'/group_by/'.$model->group_by)?>">Export <i class=" fa fa-file-excel-o"></i></a>
					</div>
				</div>
				<div class="box-body">
					<?php $this->renderPartial('_rgridview',array('model'=>$model)); ?>
				</div>
			</div>
		
		</div>
	</div>
</section>

