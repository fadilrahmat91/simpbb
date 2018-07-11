<style type="text/css">
  
  p {
      margin: 0 0 10px;
      font-family: 'Roboto', sans-serif;
  }
  p, pre {
      margin: 0 0 1em 0;
  }
  a, a:link, a:focus, a:active, a:visited {
      outline: 0;
  }
  a, a:link, a:focus, a:active, a:visited {
      outline: 0;
  }
  img {
      border: 0;
      -ms-interpolation-mode: bicubic;
  }
  .interior.container .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
  }
  .blogBox {
      margin-bottom: 30px;
      box-sizing: border-box;
  }
  .blogBox .item {
      background: #f4f4f4;
      -webkit-transition: all 0.15s ease-in-out;
      transition: all 0.15s ease-in-out;
      max-height: 425px;
  }
  .blogBox .item:hover {
      background: #e8e8e8;
      cursor: pointer;
  }
  .blogBox .item img {
      width: 100%;
  }
  .blogBox .item p {
      padding-bottom: 40px;
  }
  .blogBox .item .blogTxt {
      padding: 25px;
  }
  .blogBox .item h2 {
      margin: 15px 0;
      font-family: 'Roboto', sans-serif;
  }
  .blogBox .item .blogCategory a {
      padding: 5px 10px 2px;
      border: 1px solid #616161;
      color: #616161;
      text-transform: uppercase;
      font-size: 14px;
      font-family: 'Roboto', sans-serif;
      -webkit-transition: all 0.15s ease-in-out;
      transition: all 0.15s ease-in-out;
  }
  .blogBox .item .blogCategory a:hover {
      background: #616161;
      color: #fff;
      text-decoration: none;
  }

  #loadMore {
      padding-bottom: 30px;
      padding-top: 30px;
      text-align: center;
      width: 100%;
  }
  #loadMore a {
      background: #468847;
      border-radius: 3px;
      color: white;
      display: inline-block;
      padding: 10px 30px;
      transition: all 0.25s ease-out;
      -webkit-font-smoothing: antialiased;
  }
  #loadMore a:hover {
      background-color: #127714;
  }

  @media screen and (min-width: 1200px) {
    .blogBox .featured h2 {
      font-size: 42px;
    }
  }
  @media screen and (min-width: 991px) {
    .blogBox .featured h2 {
      font-size: 30px;
      font-style: italic;
    } 
    .blogBox .featured .blogTxt {
      max-width: 50%;
      width: 100%;
      padding: 50px;
      float: left;
      background: inherit;
      min-height: 378px;
    }
    .blogBox .featured img {
      max-width: 50%;
      width: 100%;
      float: left;
      min-height: 378px;
    }
  }
  @media screen and (min-width: 768px) {
    .blogBox .item img {
      height: 152px;
    }
  }
</style>
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
        <ul class="timeline loadMore">
          <?php
            $SumData = $Jumkegiatan[0]['kegiatan'];
            if (!empty($SumData)) {
                // $dataProvider=new CSqlDataProvider($page_kegiatan,array(
                //    'keyField' => 'id',
                //    'totalItemCount'=>TableKegiatan::model()->count(),
                //    'pagination'=>array(
                //        'pageSize'=>2,
                //     ),
                // ));

                // $page = new CPagination($Jumkegiatan[0]['kegiatan']);
                // $page->pageSize = 2;
                $x = 0;
                //foreach ($dataProvider->data as $ia=>$iia)
                foreach ($Kegiatan as $iia)
                {
              ?>
                 <li class="<?=($x%2==0 ? 'blogBox moreBox' : 'timeline-inverted thumbnail blogBox moreBox')?>" style="display: none;">
                    <div class="timeline-image">
                      <!-- <img class="rounded-circle img-fluid" src="img/about/1.jpg" alt=""> -->
                      <!-- <a href="<?php echo Yii::app()->baseUrl; ?>/kegiatan/view/?id=<?php echo $iia['id']; ?>&kegiatan=<?=$iia['nama_kegiatan']; ?>"> -->
                        <!-- <a href="<?php echo $this->createUrl('post/read',array('year'=>2008,'title'=>'a sample post')); ?>">
                      <!-- <a class="portfolio-link" data-toggle="modal" href="#portfolioModal<?php echo $iia['id']; ?>"> -->
                        <!-- <a href="<?php echo Yii::app()->createAbsoluteUrl('kegiatanview/',array('id'=>$iia['id']))?>"> --> 
		       <a href="<?php echo Yii::app()->baseUrl; ?>/kegiatan/show/<?=$iia['id']; ?>/<?=TableKegiatan::slug($iia['nama_kegiatan']); ?>"> 
                          <img class="rounded-circle img-fluid" src="<?php echo Yii::app()->baseUrl; ?>/Kegiatan/Showimage/?filename=<?php echo "/round_".$iia['nama_file'];?>&id=<?php echo $iia['id']; ?>" alt="<?php echo $iia['nama_kegiatan']; ?>">
                      </a>
                    </div>
                    <div class="timeline-panel">
                      <div class="timeline-heading">
                        <h6>
                            <?php 
                              $date = $iia['tanggal_kegiatan'];
                              echo Yii::app()->dateFormatter->format("d MMM y",strtotime($date));
                            ?>
                        </h6>
                        <h6 class="subheading"><?php echo $iia['nama_kegiatan']; ?></h6>
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
              ?>
              <?php
                //$this->widget('CLinkPager',array('pages'=>$page));
            }else{
          ?>
                <div class="col-lg-12">
                  <ul class="timeline">
                    <li class="timeline-inverted blogBox moreBox">
                      <div class="timeline-image">
                        <h4>Data Kegiatan
                          <br>Belum
                          <br>Tersedia!</h4>
                      </div>
                    </li>
                  </ul>
                </div>
          <?php
            }
          ?>
        </ul>
        <div id="loadMore" style="">
          
           <a href="#">Load More</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div style="text-align: center;">
          <!-- <div class="btn btn-success btn-lg active" role="button" aria-pressed="true" id="loadMore">Load more</div> -->
          <!-- <div class="btn btn-info btn-lg active" role="button" aria-pressed="true" id="showLess">Show less</div> -->
        </div>
        <!-- <ul class="timeline">
          <li class="timeline-inverted">
            <div class="timeline-image loadmore">
              <h4><br>
                <div id="loadMore">Load more</div>
                <div id="showLess">Show less</div>
              </h4>
            </div>
          </li>
        </ul> -->
      </div>
    </div>
  </div>
</section>
<script>
$( document ).ready(function () {
    $(".moreBox").slice(0, 3).show();
    if ($(".blogBox:hidden").length != 0) {
      $("#loadMore").show();
    }   
    $("#loadMore").on('click', function (e) {
      e.preventDefault();
      $(".moreBox:hidden").slice(0, 3).slideDown();
      if ($(".moreBox:hidden").length == 0) {
        $("#loadMore").fadeOut('slow');
      }
    });
  });
</script>
