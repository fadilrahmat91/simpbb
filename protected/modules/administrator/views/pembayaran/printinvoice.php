
<section class="content-header">
    <h1>
        Pembayaran
        <small>Print Invoice</small>
    </h1>
</section>
<section class="content">
    <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Data Pembayaran</h3>
          <div class="box-tools">
            <?php echo CHtml::link("Pembayaran Baru",array('index'),array('class'=>"btn btn-primary btn-sm")) ?>
          </div>
        </div>
        <div class="box-body">
          <div id="print_me">
            <table class="table table-bordered table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>NO</th>
                  <th>TAHUN</th>
                  <th>PEMBAYARAN POKOK</th>
                  <th>PEMBAYARAN DENDA</th>
                  <th>TOTAL</th>
                  <th>PRINT</th>
                </tr>
              </thead>
              <tbody>
              <?php $no = 0;?>
              <?php $total_bayar = 0;?>
              <?php $total_denda = 0;?>
              <?php if(count($data) > 0 ){?>
               <?php foreach ($data as $p ) { 
                  $jatuhtempo = Yii::app()->pembayaran->get_jatuh_tempo($data[0]['NOP'],$p['THN_PAJAK_SPPT']);
                  $total_bayar += $p['JML_SPPT_YG_DIBAYAR'];
                  $total_denda += $p['DENDA_SPPT'];
                          $no++;?>
                    <tr>
                      <td scope="row"><?php echo $no ?></td>
                      <td><?php echo $p['THN_PAJAK_SPPT']?></td>
                      <td>Rp.<?php echo Yii::app()->report->uangFormat($p['JML_SPPT_YG_DIBAYAR']) ?></td>
                      <td>Rp.<?php echo Yii::app()->report->uangFormat($p['DENDA_SPPT']) ?></td>
                    <td>Rp.<?php echo Yii::app()->report->uangFormat($p['DENDA_SPPT'] + $p['JML_SPPT_YG_DIBAYAR']) ?></td>
                      <td><button type="button" class="btn btn-default btn-sm print-one" data-jatuhtempo="<?=$jatuhtempo?>" data-tahun="<?php echo $p['THN_PAJAK_SPPT']?>" data-nop="<?=$p['NOP']?>" data-denda="<?php echo $p['DENDA_SPPT']?>" data-tagihan="<?php echo $p['JML_SPPT_YG_DIBAYAR'] ?>" data-jumlahbayar="<?php echo $p['DENDA_SPPT'] + $p['JML_SPPT_YG_DIBAYAR'] ?>" data-persentase="<?=Yii::app()->report->getPersentase($p['DENDA_SPPT'],$p['JML_SPPT_YG_DIBAYAR'])?>" id="cekdata">Print <i class="fa fa-print"></i></button></td>
                    </tr>
               <?php } ?>
               <tr>
                <td colspan="2">Total</td>
                <td><?=$total_bayar?></td>
                <td><?=$total_denda?></td>
                <td><?=$total_denda + $total_bayar?></td>
                <td><button type="button" class="btn btn-info btn-sm print-all" disabled>Print Semua <i class="fa fa-print"></i></button></td>
               </tr>
              <?php } ?>
                </tbody>
            </table>
          </div>
          <div class="form_print" id="lihatdata">
          
            
             <div class="tempat_bayar"><p class="p_print"><?=Yii::app()->pembayaran->tempatBayar()?></p></div>
             <div class="luas_tanah"><p class="p_print"><?=$data_op[0]['TOTAL_LUAS_BUMI']?></p></div>
             <div class="luas_bangunan"><p class="p_print"><?=$data_op[0]['TOTAL_LUAS_BNG']?></p></div>
             <div class="tahuns tahun-data"><p class="p_print"></p></div>
             <div class="namawjb"><p class="p_print"><?=$data_op[0]['NM_WP']?></p></div>
             <div class="kecamatan"><p class="p_print"><?=Yii::app()->report->kecamatanName($dataPembayaran[0]['KD_KECAMATAN'])?></p></div>
             <div class="kelurahan"><p class="p_print"><?=Yii::app()->report->kelurahanName($dataPembayaran[0]['KD_KECAMATAN'],$dataPembayaran[0]['KD_KELURAHAN'])?></p></div>
             <div class="nop nop-data"><p class="p_print"><?=$data[0]['NOP']?></p></div>
             <div class="sejumlahbyr sejumlah-total"><p class="p_print"></p></div>
             <div class="jatuhtempo "><p class="p_print"></p></div>
             <div class="denda denda-data"><p class="p_print">DENDA </p></div>
             <div class="text_tglpembayaran"><p class="p_print">TGL PEMBAYARAN  &nbsp  :</p></div>
             <div class="tanggalpembayaran"><p class="p_print"><?=$dataPembayaran[0]['TANGGAL_BAYAR']?></p></div>
             <div class="text_pembayaran"><p class="p_print">PEMBAYARAN &nbsp &nbsp&nbsp &nbsp:</p></div>
             <div class="pembayaran sejumlah-total"><p class="p_print"></p></div>
             <div class="text_denda"><p class="p_print">DENDA &nbsp ADM &nbsp &nbsp &nbsp:</p></div>
             <div class="text_totalbayar"><p class="p_print">TOTAL BAYAR &nbsp &nbsp&nbsp :</p></div>
             <div class="totalpembayaran jumbayar-total"><p class="p_print"></p></div>
             <div class="persentase persentase-data"><p class="p_print"></p></div>
             <div class="tglbyr"><p class="p_print"><?=$dataPembayaran[0]['TANGGAL_BAYAR']?></p></div>
             <div class="jumlahygdibyr jumbayar-total"><p class="p_print"></p></div>
             <div class="tempat_bayar2"><p class="p_print"><?=Yii::app()->pembayaran->tempatBayar()?></p></div>
             <div class="tahuns2 tahun-data"><p class="p_print">2018</p></div>
             <div class="namawjb2"><p class="p_print"><?=$data_op[0]['NM_WP']?></p></div>
             <div class="kecamatan2"><p class="p_print"><?=Yii::app()->report->kecamatanName($dataPembayaran[0]['KD_KECAMATAN'])?></p></div>
             <div class="kelurahan2"><p class="p_print"><?=Yii::app()->report->kelurahanName($dataPembayaran[0]['KD_KECAMATAN'],$dataPembayaran[0]['KD_KELURAHAN'])?></p></div>
             <div class="nop2 nop-data"><p class="p_print"><?=$data[0]['NOP']?></p></div>
             <div class="sejumlahbyr2 sejumlah-total"><p class="p_print"></p></div>
             <div class="tglbyr2"><p class="p_print"><?=$dataPembayaran[0]['TANGGAL_BAYAR']?></p></div>
             <div class="jumlahygdibyr2 jumbayar-total"><p class="p_print"></p></div>
             <div class="tglbyr3"><p class="p_print"><?=$dataPembayaran[0]['TANGGAL_BAYAR']?></p></div>
             <div class="tempat_bayar3"><p class="p_print"><?=Yii::app()->pembayaran->tempatBayar()?></p></div>
             <div class="jumlahygdibyr3 jumbayar-total"><p class="p_print"></p></div>
             <div class="tahuns4 tahun-data"><p class="p_print">2018</p></div>
             <div class="namawjb4"><p class="p_print"><?=$data_op[0]['NM_WP']?></p></div>
             <div class="kecamatan3"><p class="p_print"><?=Yii::app()->report->kecamatanName($dataPembayaran[0]['KD_KECAMATAN'])?></p></div>
             <div class="kelurahan3"><p class="p_print"><?=Yii::app()->report->kelurahanName($dataPembayaran[0]['KD_KECAMATAN'],$dataPembayaran[0]['KD_KELURAHAN'])?></p></div>
             <div class="nop4 nop-data"><p class="p_print"><?=$data[0]['NOP']?></p></div>
             <div class="sejumlahbyr4 sejumlah-total"><p class="p_print"></div>
             <div class="tglbyr4"><p class="p_print"><?=$dataPembayaran[0]['TANGGAL_BAYAR']?></p></div>
             <div class="jumlahygdibyr4 jumbayar-total"><p class="p_print"></p></div>
          </div>
      </div>
    </div>
    <style type="text/css">
   
    .rata-tengah {
            text-align: center;

        }
        .p_print{
          
          font-size: 9px;
          font-weight: bold;
          font-family: "Courier New";
          /*font-family:"Dot-Matrix",arial;*/
          letter-spacing: 2px;
          
        }
      .tempat_bayar{
           left: 167px;
           top: 36px;
           position: absolute;

        }

        .tahuns{
           left: 240px;
           top: 45px;
           position: absolute;

        }
        .namawjb{
           left: 167px;
           top: 55px;
           position: absolute;

        }
        .kecamatan{
           left: 260px;
           top: 65px;
           position: absolute;

        }
         .kelurahan{
           left: 260px;
           top: 74px;
           position: absolute;

        }
        .nop{
           left: 167px;
           top: 83px;
           position: absolute;

        }
        .sejumlahbyr{
           left: 167px;
           top: 93px;
           position: absolute;

        }
         .jatuhtempo{
           left: 175px;
           top: 110px;
           position: absolute;

        }
        .text_tglpembayaran{
           left: 160px;
           top: 146px;
           position: absolute;

        }
        .text_pembayaran{
           left: 160px;
           top: 155px;
           position: absolute;

        }
        .text_denda{
           left: 160px;
           top: 164px;
           position: absolute;

        }
        .text_presentase{
           left: 160px;
           top: 173px;
           position: absolute;

        }
        .text_totalbayar{
           left: 160px;
           top: 173px;
           position: absolute;

        }
        .tanggalpembayaran{
           left: 330px;
           top: 146px;
           position: absolute;

        }
        .pembayaran{
           left: 330px;
           top: 155px;
           position: absolute;

        }
        .denda{
           left: 330px;
           top: 164px;
           position: absolute;

        }
        .persentase{
           left: 253px;
           top: 164px;
           position: absolute;

        }
         .totalpembayaran{
           left: 330px;
           top: 173px;
           position: absolute;

        }
        
  
        .tglbyr{
           left: 167px;
           top: 247px;
           position: absolute;

        }
        .luas_tanah{
           left: 320px;
           top: 247px;
           position: absolute;

        }
         .jumlahygdibyr{
           left: 167px;
           top: 257px;
           position: absolute;

        }
         .luas_bangunan{
           left: 320px;
           top: 257px;
           position: absolute;

        }
        .nominalygdibyr{
           left: 167px;
           top: 266px;
           position: absolute;

        }
        .tempat_bayar2{
           left: 167px;
           top: 324px;
           position: absolute;

        }
        .tahuns2{
           left: 240px;
           top: 335px;
           position: absolute;

        }
        .namawjb2{
           left: 167px;
           top: 346px;
           position: absolute;

        }
        .kecamatan2{
           left: 260px;
           top: 355px;
           position: absolute;

        }
        .kelurahan2{
           left: 260px;
           top: 364px;
           position: absolute;

        }
        .nop2{
           left: 167px;
           top: 373px;
           position: absolute;

        }
        .sejumlahbyr2{
           left: 173px;
           top: 383px;
           position: absolute;

        }
         .tglbyr2{
           left: 190px;
           top: 393px;
           position: absolute;

        }
        .jumlahygdibyr2{
           left: 190px;
           top: 402px;
           position: absolute;

        }
        .tglbyr3{
           left: 190px;
           top: 496px;
           position: absolute;

        }
        .jumlahygdibyr3{
           left: 190px;
           top: 505px;
           position: absolute;

        }
        .tempat_bayar3{
           left: 167px;
           top: 574px;
           position: absolute;

        }
         .tahuns4{
           left: 238px;
           top: 582px;
           position: absolute;

        }
        .namawjb4{
           left: 167px;
           top: 592px;
           position: absolute;

        }

        .kecamatan3{
           left: 260px;
           top: 601px;
           position: absolute;

        }
         .kelurahan3{
           left: 260px;
           top: 610px;
           position: absolute;

        }
        .nop4{
           left: 167px;
           top: 619px;
           position: absolute;

        }
        .sejumlahbyr4{
           left: 173px;
           top: 631px;
           position: absolute;

        }
         .tglbyr4{
           left: 190px;
           top: 640px;
           position: absolute;

        }
        .jumlahygdibyr4{
           left: 190px;
           top: 650px;
           position: absolute;

        }
        

        .form_print{

          height: 30CM;
          width:13CM;
          background: lavender;
          position:relative;
       
      }
     @page {margin:0 -1cm;font-family:"Dot-Matrix" !important;}
      </style>
  </div>

</section>
<script>
  $("document").ready(function(){
    $("button.print-one").click(function(){
      var tahun = $(this).data('tahun');
      var nop = $(this).data('nop');
      var jumlah_bayar = $(this).data('jumlahbayar');
      var tagihan = $(this).data('tagihan');
      var denda = $(this).data('denda');
      var jatuhtempo = $(this).data('jatuhtempo');
      $("div.jatuhtempo p").text(jatuhtempo);
      $("div.tahun-data p").text(tahun);
      $("div.jumbayar-total p").text("Rp."+formatNumbers(jumlah_bayar));
      $("div.persentase-data p").text($(this).data('persentase')+"%");
      $("div.denda-data p").text("Rp."+formatNumbers(denda));
      $("div.sejumlah-total p").text("Rp."+formatNumbers(tagihan));
      $("#lihatdata").print();
    });
    $("button#print_invoice").click(function(){
      $("#lihatdata").print();
    })
  })
</script>