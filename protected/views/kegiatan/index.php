<!-- About -->
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
            <ul class="timeline">
              <?php
                $SumData = $Jumkegiatan[0]['kegiatan'];
                if ($SumData > 0) {
                    $dataProvider=new CSqlDataProvider($page_kegiatan,array(
                       'keyField' => 'id',
                       'totalItemCount'=>TableKegiatan::model()->count(),
                       'pagination'=>array(
                           'pageSize'=>2,
                        ),
                    ));

                    $page = new CPagination($Jumkegiatan[0]['kegiatan']);
                    $page->pageSize = 2;
					$x = 0;
                    foreach ($dataProvider->data as $ia=>$iia)
                    {
                  ?>
                     <li class="<?=($x%2==0 ? '' : 'timeline-inverted')?>">
                        <div class="timeline-image">
                          <!-- <img class="rounded-circle img-fluid" src="img/about/1.jpg" alt=""> -->
                          <a class="portfolio-link" data-toggle="modal" href="#portfolioModal<?php echo $iia['id']; ?>">
                              <img class="rounded-circle img-fluid" src="<?php echo Yii::app()->baseUrl; ?>/Kegiatan/Showimage/?filename=<?php echo "/round_".$iia['nama_file'];?>&id=<?php echo $iia['id']; ?>" alt="<?php echo $iia['nama_kegiatan']; ?>">
                          </a>
                        </div>
                        <div class="timeline-panel">
                          <div class="timeline-heading">
                            <h4>
                                <?php 
                                  $date = $iia['tanggal_kegiatan'];
                                  echo Yii::app()->dateFormatter->format("d MMM y",strtotime($date));
                                ?>
                            </h4>
                            <h4 class="subheading"><?php echo $iia['nama_kegiatan']; ?></h4>
                          </div>
                          <div class="timeline-body">
                            <p class="text-muted">
                              <?php 
                                  $num_char = 60;
                                  $text = $iia['keterangan_kegiatan'];
                                  echo substr($text, 0, $num_char) . ' ...';
                              ?>
                            </p>
                          </div>
                        </div>
                      </li>
                  <?php
					$x++;				  
                    }
                    $this->widget('CLinkPager',array('pages'=>$page));
                }else{
              ?>
                    <li class="timeline-inverted">
                      <div class="timeline-image">
                        <h4>Data Kegiatan
                          <br>Belum
                          <br>Tersedia!</h4>
                      </div>
                    </li>
              <?php
                }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal 1 -->
    <?php
        foreach ($kegiatan as $s) {
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
                <img src="<?php echo Yii::app()->baseUrl; ?>/Kegiatan/Showimage/?filename=<?php echo "/thumb_".$s['nama_file'];?>&id=<?php echo $id; ?>" alt="" style="width: 250px; height: 200px;"/></a>
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