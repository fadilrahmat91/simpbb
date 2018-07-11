<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/css/blueimp-gallery.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/css/blueimp-gallery-indicator.css">

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/css/demo/demo.css">
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Kegiatan</h2>
            <h3 class="section-subheading text-muted">Kegiatan Badan Pendapatan Daerah</h3>
          </div>
        </div>
		
        <div class="row">
          <div class="col-lg-12">
			<?php if( !empty($kegiatanDetail)) { ?>
				<div id="links" class="links row">
					<?php foreach($kegiatanDetail as $p ){ ?>
						<div class="col-lg-2" style="margin-bottom:30px;">
						<a  href="<?php echo Yii::app()->baseUrl; ?>/upload/kegiatan/<?=$p['kegiatan_id']?>/<?=$p['nama_file']?>" title="nama kegiatan" data-gallery >
							<img src="<?php echo Yii::app()->baseUrl; ?>/upload/kegiatan/<?=$p['kegiatan_id']?>/thumb_<?=$p['nama_file']?>" style="max-width:100%;">
						</a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			<!-- The container for the list of example images -->
			<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
			<div id="blueimp-gallery" class="blueimp-gallery">
				<div class="slides"></div>
				<h3 class="title"></h3>
				<a class="prev" style="color:#fff">‹</a>
				<a class="next" style="color:#fff">›</a>
				<a class="close" style="color:#fff">×</a>
				<a class="play-pause"></a>
				<ol class="indicator"></ol>
			</div>
          </div>
        </div>
      </div>
    </section>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/js/blueimp-helper.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/js/blueimp-gallery.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/js/blueimp-gallery-fullscreen.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/js/blueimp-gallery-indicator.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/js/jquery.blueimp-gallery.js"></script>