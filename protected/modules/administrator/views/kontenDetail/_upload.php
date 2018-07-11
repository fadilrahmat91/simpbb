<section class="content-header"> 
    <h1> 
        Upload 
        <small>Konten</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Konten</a></li>
        <li class="active">Upload</li>
    </ol> 
</section> 
<section class="content">
  <div class="callout callout-info">
    <h4>Tips Upload!</h4>

    <p>1. Required File png, jpeg, gif</p>
    <p>2. Required File size upload 2 Mb</p>
  </div>

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <i class="fa fa-image fa-lg"></i> 
      <h3 class="box-title">Upload Photos Konten</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      Browse your photos in here
    </div>
   
		<?php 
		  $this->widget('ext.dropzone.EDropzone', array(
		      'model' => $model,
		      'attribute' => 'gambar',
		      'url' => $this->createUrl('Kontendetail/upload/id/'.$model->id),
		      'mimeTypes' => array('image/jpeg', 'image/png', 'image/gif'),
		      //'onSuccess' => 'someJsFunction();',
		      'options' => array('addRemoveLinks' =>true,),
		  ));
		?>
  </div>
  <!-- /.box -->

  
<!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            
            <!-- timeline time label -->
            <!-- <li class="time-label">
                  <span class="bg-green">
                    3 Jan. 2014
                  </span>
            </li> -->
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">
                <!-- <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span> -->

                <h3 class="timeline-header">Foto Terkait</h3>

                <div class="timeline-body">
                  <?php 
                      $xx = Tablekegiatan::getkegiatandetail($model->id); 
                      foreach ($xx as $s) {
                  ?>
                    <a href="<?php echo Yii::app()->baseUrl; ?>/kegiatan/showimage/?filename=<?php echo "thumb_".$s['nama_file'];?>&id=<?php echo $model->id; ?>" target="_blank">
                      <!-- <img src="<?php echo Yii::app()->request->baseUrl; ?>/upload/Kegiatan/<?php echo $model->id."/"."thumb_".$s['nama_file']; ?>" alt="<?php echo $s['nama_kegiatan']; ?>" class="margin" style="width: 150px; height: 100px;"> -->
                      <img src="<?php echo Yii::app()->baseUrl; ?>/kegiatan/showimage/?filename=<?php echo "thumb_".$s['nama_file'];?>&id=<?php echo $model->id; ?>" alt="<?php echo $s['nama_kegiatan']; ?>" class="margin" style="width: 150px; height: 100px;"/>
                    </a>
                  <?php } ?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>
