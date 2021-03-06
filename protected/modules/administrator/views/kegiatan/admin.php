<section class="content-header">
    <h1>
        Konten
        <small>Kegiatan</small>
    </h1>
    <ol class="breadcrumb">
	    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">Kegiatan</li>
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
          $this->renderPartial('_search',array('model'=>$model)); 
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
          <a href="<?=Yii::app()->createAbsoluteUrl('administrator/kegiatan/export/tanggal_kegiatan/'.$model->tanggal_kegiatan)?>" class="btn btn-app">
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
          <h3 class="box-title">Data Kegiatan</h3>
          <div class="box-tools">
            <?php echo CHtml::link("<i class='fa fa-plus'></i>  Tambah Kegiatan",array('create'),array('class'=>"btn btn-primary btn-sm")) ?>
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
<?php
	Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function () {
	      $('.search-form').fadeToggle('slow');
			return false;
		});
	");
?>