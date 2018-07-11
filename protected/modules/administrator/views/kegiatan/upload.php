<style>
    /* FROM HTTP://WWW.GETBOOTSTRAP.COM
     * Glyphicons
     *
     * Special styles for displaying the icons and their classes in the docs.
     */

    .bs-glyphicons {
      padding-left: 0;
      padding-bottom: 1px;
      margin-bottom: 20px;
      list-style: none;
      overflow: hidden;
    }

    .bs-glyphicons li {
      float: left;
      width: 25%;
      height: 115px;
      padding: 10px;
      margin: 0 -1px -1px 0;
      font-size: 12px;
      line-height: 1.4;
      text-align: center;
      border: 1px solid #ddd;
    }

    .bs-glyphicons .glyphicon {
      margin-top: 5px;
      margin-bottom: 10px;
      font-size: 24px;
    }

    .bs-glyphicons .glyphicon-class {
      display: block;
      text-align: center;
      word-wrap: break-word; /* Help out IE10+ with class names */
    }

    .bs-glyphicons li:hover {
      background-color: rgba(86, 61, 124, .1);
    }

    @media (min-width: 768px) {
      .bs-glyphicons li {
        width: 12.5%;
      }
    }
</style>
<section class="content-header"> 
    <h1> 
        Upload 
        <small>Kegiatan</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/kegiatan/admin')?>">Kegiatan</a></li>
        <li class="active">Unggah</li>
    </ol>
</section> 
<section class="content">
  <div class="callout callout-info">
    <h4>Tips Upload!</h4>

    <p>1. Required File png, jpeg, gif</p>
    <p>2. Required File size upload 2 Mb</p>
    <p>3. Required File upload : Width : 1110 pixels and Height : 529 pixels for good quality</p>
  </div>

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <i class="fa fa-image fa-lg"></i> 
      <h3 class="box-title">Upload Photos Kegiatan</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
      <div class="box-tools">
        <?php echo CHtml::link("Data Konten Kegiatan",array('admin'),array('class'=>"btn btn-primary btn-sm")) ?>
      </div>
    </div>
    <div class="box-body">
      Browse your photos in here
    </div>
    <?php $this->renderPartial('_upload', array('model'=>$model)); ?> 
  </div>
  <!-- /.box -->
<!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-green">
                    <!-- 3 Jan. 2014 -->
                    Gallery
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> Uploaded :
                  <?php
                    $time = TableKegiatan::getImageTimeLast($model->id);
                    $timeLast = ($time['imagetime']);
                    echo TableKegiatan::time_elapsed_string($timeLast);
                  ?>
                </span>
                <h3 class="timeline-header">Foto Terkait</h3>
                <div class="timeline-body">
                    <div class="tab-pane" id="glyphicons">

                        <ul class="bs-glyphicons">
                          <?php 
                              $xx = TableKegiatanDetail::getkegiatandetail($model->id); 
                              foreach ($xx as $s) {
                                $id_detail = $s['gambar'];
                                $nama_file = $s['nama_file'];
                                $kegiatan_id = $s['kegiatan_id'];
                          ?>
                          <li>
                            <a href="<?php echo Yii::app()->baseUrl; ?>/kegiatan/ImageDetail/?file=<?php echo $s['nama_file'];?>&id=<?php echo $model->id; ?>" target="_blank">
                              <img src="<?php echo Yii::app()->baseUrl; ?>/kegiatan/showimage/?filename=<?php echo "thumb_".$s['nama_file'];?>&id=<?php echo $model->id; ?>" alt="<?php echo $s['nama_kegiatan']; ?>" class="margin" style="width: 90px; height: 60px;"/>
                            </a>
                            <a href="<?= Yii::app()->createUrl("/administrator/kegiatan/deleteimage",array("id"=>$id_detail, 'kegiatan_id'=>$kegiatan_id, 'nama_file'=>$nama_file)); ?>" title="Delete"><span class="glyphicon glyphicon-trash" style="font-size: 14px;"></span></a> -
                            <a href="<?= Yii::app()->createUrl("/administrator/kegiatan/primaryimage",array("id"=>$id_detail, 'kegiatan_id'=>$kegiatan_id)); ?>" title="Primary Key"><span class="glyphicon glyphicon-star" style="font-size: 14px;"></span></a>                          
                          </li>
                          <?php
                              }
                          ?>
                        </ul>
                      </div>
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

<?php
  $nopic = Yii::app()->getRequest()->getParam('nopic');
  if ($nopic == 'p') {
    echo "<script type='text/javascript'>alert('Gambar Tidak Dapat di hapus dikarenakan sebagai primary key');</script>";
  }elseif ($nopic == 's') {
    echo "<script type='text/javascript'>alert('Gambar Berhasil dihapus');</script>";
  }elseif ($nopic == 't') {
    echo "<script type='text/javascript'>alert('Gambar Berhasil dijadikan primary key');</script>";
  }
?>