
<section>

<?php $bulan=array(
    array('Januari'=>'01','February'=>'02','Maret'=>'03','April'=>'04','Mei'=>'05','Juni'=>'06','Juli'=>'07','Agustus'=>'08','September'=>'09','Oktober'=>'10','November'=>'11','Desember'=>'12')
  );
 ?>

<div class="container">
       <div class="col-lg-12 text-center">
          <div class="col-lg-12 text-right">
               <a class="btn btn-primary" data-toggle="dropdown" href="#"> <span class="caret">Pilih Bulan</span></a>
                <ul class="dropdown-menu scrollable">
                 
                      
                           <table class="table table-hover">
                                 <?php
                                    for($r=0;$r<count($bulan);$r++){ 
                                      foreach($bulan[$r] as $key=>$value){
                                 ?>
                               <tr>
                                  <td><li><a href="<?php echo Yii::app()->createAbsoluteUrl('konten/bulan/'.$value)?>"><?php echo  $key ?></a></li></td>
                              </tr>
                               <?php  }
                                     }
                                ?>
                           </table>
                </ul>
            </div>
            <h3 class="section-heading text-uppercase">Konten</h3><br><br>
           
        </div>

<div class="row">  
         <?php foreach($model as $dpt){ ?>
         <?php $numc= 20; ?>
         <?php $num_char= 180; ?>
        <div class="col-md-3">
          <a href="#">
             <?php $namafile =FileLokasi::model()->findByAttributes(array("id"=>$dpt["gambar"]))->nama_file; ?>
                  <img class="image-fluid" src="<?php echo Yii::app()->request->baseUrl; ?>/upload/konten/<?php echo $namafile; ?>" alt="" style="width:200px; height: 200px;"><br><br>
          </a>
        </div>
        <div class="col-md-7">
          <h5><?php echo substr($dpt['judul'], 0, $numc); ?></h5>
         <div> <p class="service-heading"> <?php echo substr($dpt['isi_konten'], 0, $num_char); ?></p></div>
         <div> <a class="btn-sm btn-primary" href="<?=Yii::app()->createAbsoluteUrl('/konten/view/'.$dpt['slug'])?>">selengkapnya....</a></div>
        </div>
        <?php } ?>
        
  </div>
      <hr>
</section>