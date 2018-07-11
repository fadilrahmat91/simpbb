<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/css/blueimp-gallery.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/css/blueimp-gallery-indicator.css">

<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/asset/image-gallery/css/demo/demo.css">
<style type="text/css">
	.dropcaps:first-letter {
	  color: #903;
	  float: left;
	  font-family: Georgia;
	  font-size: 75px;
	  line-height: 60px;
	  padding-top: 4px;
	  padding-right: 8px;
	  padding-left: 3px;
	}
</style>
    <section>
      <div class="container">
      	<?php
	        foreach ($NameKegiatan as $s) {
	          $id = $s['id'];
	    ?>
	  		<!-- <div class="row">
	          <div class="col-lg-12 text-center">
	            <h4 class="section-heading text-uppercase"><?php echo $s['nama_kegiatan']; ?></h4>
	          </div>
	        </div> -->
			<div class="row">
		        <div class="col-md-12 p-3 mb-2 bg-light text-dark" style="font-family: 'PT Sans',sans-serif; font-size: 14px;line-height: 21px;">
		        	<div class="text-center" style="font-size: 18px;"><b><?php echo $s['nama_kegiatan']; ?></b></div>
		        	<hr>
		        	<img class="img-fluid d-block mx-auto" src="<?php echo Yii::app()->baseUrl; ?>/Kegiatan/Showimage/?filename=<?php echo $s['nama_file'];?>&id=<?php echo $id; ?>" alt="<?php echo $s['nama_file']; ?>"><br />
		        		
			          <?php 
	                      $text = $s['dropcaps']; 
	                      $text = str_replace("\r\n","\n",$text);
	                      $paragraphs = preg_split("/[\n]{2,}/",$text);
	                      foreach ($paragraphs as $key => $p) {
	                          $paragraphs[$key] = "<p class=dropcaps align=justify class=card-text>".str_replace("\n","<br />",$paragraphs[$key])."</p>".$s['keterangan_kegiatan'];
	                      }
	                      $text = implode("", $paragraphs);
	                      echo $text;
	                  ?><br /><br />
	                  	<b>Tanggal kegiatan : 
	                      <?php 
	                        $date = $s['tanggal_kegiatan'];
	                        echo Yii::app()->dateFormatter->format("d MMM y",strtotime($date));
	                      ?>
	                  	</b>
		        </div>
		    </div>	
      	<?php
      		}
      	?>
	    <hr>
        <div class="row">
          <div class="col-lg-12">
          	Foto Terkait : <br /><br />
			<?php if( !empty($kegiatanDetail)) { ?>
				<div id="links" class="links row">
					<?php foreach($kegiatanDetail as $p ){ ?>
						<div class="col-lg-2" style="margin-bottom:30px;">
						<a  href="<?php echo Yii::app()->baseUrl; ?>/kegiatan/showimage/?filename=<?php echo $p['nama_file'];?>&id=<?php echo $p['id']; ?>" title="<?=$p['nama_kegiatan'] ?>" data-gallery >
							<img src="<?php echo Yii::app()->baseUrl; ?>/kegiatan/showimage/?filename=<?php echo "thumb_".$p['nama_file'];?>&id=<?php echo $p['id']; ?>" style="max-width:100%;">
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