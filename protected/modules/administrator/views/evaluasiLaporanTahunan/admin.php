<section class="content-header">
    <h1>
        Evaluasi
        <small>Laporan Tahunan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li>Evaluasi Laporan Tahunan</li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <!-- Application buttons -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-search-plus"></i>
          <h3 class="box-title">
            Form Pencarian
          </h3>
        </div>
        <div class="box-body">
        <?php 
          $this->renderPartial('_search',array('model'=>$model,'keloption'=>$keloption)); 
        ?>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <!-- Application buttons -->
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">Export Data</h3>
        </div>
        <div class="box-body">
          <p>Pilih salah satu jenis export data sesuai yang Anda <code>Inginkan</code> dibawah ini :</p>
          <a href="<?=Yii::app()->createAbsoluteUrl('administrator/evaluasiLaporanTahunan/exportpdf/tahun/'.$model->tahun.'/kecamatan/'.$model->kecamatan.'/kelurahan/'.$model->kelurahan)?>" class="btn btn-app">
            <i class="fa fa-file-pdf-o"></i> Pdf
          </a>
          <a href="<?=Yii::app()->createAbsoluteUrl('administrator/evaluasiLaporanTahunan/export/tahun/'.$model->tahun.'/kecamatan/'.$model->kecamatan.'/kelurahan/'.$model->kelurahan)?>" class="btn btn-app">
            <i class="fa fa-file-excel-o"></i> Excel
          </a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-database"></i> 
          <h3 class="box-title">Data Evaluasi</h3>
          <div class="box-tools">
          </div>
        </div>
        <div class="box-body">
          <?php $this->renderPartial('_rgridview',array('model'=>$model)); ?>
        </div>
      </div>
    
    </div>
  </div>
  <!-- /. row -->
</section>

