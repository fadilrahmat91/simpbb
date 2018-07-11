<section>
<div class="container">
<?php foreach($model as $dpt) { ?>



     <div class="row">    
        <div class="col-md-12 text-center">
         <br>

         <h3 class="text-center"><?php echo $dpt['judul']; ?></h3><br>


          <a href="#">
             <?php $namafile =FileLokasi::model()->findByAttributes(array("id"=>$dpt["gambar"]))->nama_file; ?>
                  <img class="image-fluid" src="<?php echo Yii::app()->request->baseUrl; ?>/upload/konten/thumb_<?php echo $namafile; ?>">
          </a>
        </div>
        <div class="col-md-12 "><br>
         <small class="text-center">Tanggal:<?php echo $dpt['tgl_buat']; ?></small>
         <div> <p class="service-heading"> <?php echo $dpt['isi_konten']; ?></p></div>
         <div> <p class="text-right">sumber: <?php echo $dpt['sumber']; ?></p></div>
        
        </div>
       
        
      </div>
      <?php } ?>
      <hr>
  </div>
</section>