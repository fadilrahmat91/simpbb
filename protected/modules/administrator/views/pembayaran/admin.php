<section class="content-header">
    <h1>
        LAPORAN
        <small>Pembayaran</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Form Laporan Pembayaran</h3>
					<div class="box-tools">
						<?php echo CHtml::link("Buat Pembayaran Baru",array('index'),array('class'=>"btn btn-primary btn-sm")) ?>
					</div>
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
					<h3 class="box-title">Data Pembayaran</h3>
					<div class="box-tools">
						<a class="btn btn-default btn-sm pull-right" href="<?=Yii::app()->createUrl('administrator/pembayaran/export',array('tanggal_bayar' => $model->tanggal_bayar,'kecamatan'=>$model->kecamatan,'kelurahan'=>$model->kelurahan))?>">Export Excel <i class=" fa fa-file-excel-o"></i></a>
						&nbsp;<a class="btn btn-default btn-sm pull-right" href="<?=Yii::app()->createUrl('administrator/pembayaran/exportPdf',array('tanggal_bayar' => $model->tanggal_bayar,'kecamatan'=>$model->kecamatan,'kelurahan'=>$model->kelurahan))?>">Export Pdf<i class=" fa fa-file-pdf-o"></i></a>
					</div>
				</div>
				<div class="box-body">
				<?php $this->widget('RGridView', array(
					'id'=>'video-grid',
					'dataProvider'=>$model->search(),
					//'filter'=>$model,
						'itemsCssClass' => 'table table-striped table-hover',
						'pagerCssClass'=>'text-center',    
						'pager'=>array(    
							'header'=>'',
							'prevPageLabel'=>'<',
							'nextPageLabel'=>'>',
								'selectedPageCssClass' => 'active',         
								'hiddenPageCssClass' => '',                        
								'htmlOptions'=>array(
									'class'=>'pagination',
								),                  
							),
							'columns'=>array(
							array(
								'name'=>'NOP',
								'header'=>'NOP',
							),  
							array(
								'name'=>'NM_WP',
								'header'=>'NAMA WP',
								'value' => 'Yii::app()->report->get_nama_alamat($data["NOMOR_ID"],"NM_WP")',
							),                        
							array(
								'header'=>'KECAMATAN',
								'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
							),
							array(
								'name' => 'KETETAPAN',
								'header'=>'KETETAPAN',
								'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
							),
							array(
								'name' => 'PEMBAYARAN_DENDA',
								'header'=>'PEMBAYARAN DENDA',
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_DENDA"])',
							), 			
							array(
								'name' => 'PEMBAYARAN_POKOK',                     
								'header'=>'PEMBAYARAN POKOK',
								'value' => 'Yii::app()->report->uangFormat($data["PEMBAYARAN_POKOK"])',
							),
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),			
							array(
								'name' => 'TGL_BAYAR',                     
								'header'=>'TGL BAYAR'
							)
					),
				)); ?>
			</div>
		</div>
		</div>
	</div>
</section>

