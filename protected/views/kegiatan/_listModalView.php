<!-- Modal 1 -->
<?php
    foreach ($Kegiatan as $s) {
      $id = $s['id'];
?>
<div class="portfolio-modal modal fade" id="portfolioModal<?php echo $s['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="close-modal" data-dismiss="modal">
        <div class="lr">
          <div class="rl"></div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <div class="modal-body">
              <!-- Project Details Go Here -->
              <h2 class="text-uppercase"><?php echo $s['nama_kegiatan']; ?></h2>
              <img class="img-fluid d-block mx-auto" src="<?php echo Yii::app()->baseUrl; ?>/Kegiatan/Showimage/?filename=<?php echo $s['nama_file'];?>&id=<?php echo $id; ?>" alt="<?php echo $s['nama_kegiatan']; ?>">
              <?php 
                  $text = $s['keterangan_kegiatan']; 
                  $text = str_replace("\r\n","\n",$text);

                  $paragraphs = preg_split("/[\n]{2,}/",$text);
                  foreach ($paragraphs as $key => $p) {
                      $paragraphs[$key] = "<p align=justify>".str_replace("\n","<br />",$paragraphs[$key])."</p>";
                  }

                  $text = implode("", $paragraphs);

                  echo $text;
              ?>
              <ul class="list-inline">
                <li>Tanggal kegiatan : 
                  <?php 
                    $date = $s['tanggal_kegiatan'];
                    echo Yii::app()->dateFormatter->format("d MMM y",strtotime($date));
                  ?>
                </li>
                <!-- <li>Client: Threads</li>
                <li>Category: Illustration</li> -->
              </ul>
              
            </div>
          </div>
        </div>
      </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">FOTO TERKAIT</h2>
        </div>
      </div>
      <div class="row text-center">
        <?php 
            $xx = TableKegiatanDetail::getKegiatanDetail($id); 
            foreach ($xx as $s) {
        ?>
        <div class="col-md-4">
          <a href="<?php echo Yii::app()->baseUrl; ?>/Kegiatan/ImageDetail/?file=<?php echo $s['nama_file'];?>&id=<?php echo $id; ?>" target="_blank">
            <!-- <img class="img-fluid d-block mx-auto" src="<?php echo Yii::app()->request->baseUrl; ?>/upload/kegiatan/<?php echo $id."/"."/thumb_".$s['nama_file']; ?>" alt="<?php echo $s['nama_kegiatan']; ?>"> -->
            <img src="<?php echo Yii::app()->baseUrl; ?>/Kegiatan/Showimage/?filename=<?php echo "/thumb_".$s['nama_file'];?>&id=<?php echo $id; ?>" alt="<?php echo $s['nama_kegiatan'] ?>" style="width: 250px; height: 200px;"/></a>
        </div>
        <?php } ?>
      </div>
  </div>
  <!-- <button class="btn btn-primary" data-dismiss="modal" type="button">
  <i class="fa fa-times"></i>
  Close Project</button> -->
    </div>
  </div>
</div>
<?php } ?>