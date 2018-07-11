<!-- search-form -->
<?php


$nopnya =$model->nop;
$nopx = str_replace("-",".",$model->nop);
        list($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$no_urut,$kd_jenis) = explode(".",$nopx);
         $data = Yii::app()->objekPajak->getObjekPajak($kd_propinsi,$kd_dati2,$kd_kecamatan,$kd_kelurahan,$kd_blok,$no_urut,$kd_jenis);
         
?>
<div class="box box-default">
  <div class="box-header with-border">
    <i class="fa fa-user"></i> 
    <h3 class="box-title">INFO WAJIB PAJAK & OBJEK PAJAK</h3>
  </div>
  <div class="box-body">
<table class="table table-striped ">
  <tbody>
    <tr>
      <td class="bg-info" style="width:180px;">NAMA</td>
      <td class="bg-info" style="width:5px;">:</td>
      <td><?= $data[0]['NM_WP']?></td>
      <td class="bg-success" style="width:180px;">RT/RW O.P</td>
      <td class="bg-success" style="width:5px;">:</td>
      <td><?= $data[0]['RT_OP']?>/<?= $data[0]['RW_OP']?></td>
    </tr>
    <tr>
      <td class="bg-info">KOTA</td>
      <td class="bg-info">:</td>
      <td><?= $data[0]['KOTA_WP']?></td>
      <td class="bg-success">JALAN O.P</td>
      <td class="bg-success">:</td>
      <td><?= $data[0]['JALAN_OP']?></td>
    </tr>
    <tr>
      <td class="bg-info">KELURAHAN</td>
      <td class="bg-info">:</td>
      <td><?= $data[0]['KELURAHAN_WP']?></td>
      <td class="bg-success">LUAS BUMI</td>
      <td class="bg-success">:</td>
      <td><?= $data[0]['TOTAL_LUAS_BUMI']?></td>
    </tr>
    <tr>
      <td class="bg-info">RT/RW</td>
      <td class="bg-info">:</td>
      <td><?= $data[0]['RT_WP']?>/<?= $data[0]['RW_WP']?></td>
      <td class="bg-success">LUAS BANGUNAN</td>
      <td class="bg-success">:</td>
      <td><?= $data[0]['TOTAL_LUAS_BNG']?></td>
    </tr>
    <tr>
      <td class="bg-info">JALAN</td>
      <td class="bg-info">:</td>
      <td><?= $data[0]['JALAN_WP']?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</div>
</div>
<?php $this->widget('RGridView', array(
'id'=>'laporan-ketetapan',
'dataProvider'=>$model->searchRekapitulasi(),
//'filter'=>$model,
  'itemsCssClass' => 'table table-striped table-hover',
  'pagerCssClass'=>'text-center',    
  'pager'=>array(    
    'header'=>'',
    'prevPageLabel'=>'<',
    'nextPageLabel'=>'>',
      'selectedPageCssClass' => 'active',         
      'hiddenPageCssClass' => '',                        
      'htmlOptions'=>array(
        'class'=>'pagination',
      ),                  
    ),
    'columns'=>array(
        array(
          'name'=>'NOP',
          'header'=>'NOP',
          //'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ), 
        array(
          'name'=>'TAHUN',
          'header'=>'TAHUN',
          //'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ), 
        array(
          'name'=>'KETETAPAN',
          'header'=>'KETETAPAN',
          'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ),
        array(
          'name'=>'DENDA_SPPT',
          'header'=>'DENDA_SPPT',
          //'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ),
        array(
          'name'=>'REALISASI',
          'header'=>'REALISASI',
          'value' => 'Yii::app()->report->uangFormat($data["REALISASI"])',
        ),
        array(
          'name'=>'PIUTANG',
          'header'=>'PIUTANG',
        ),
        array(
          'name'=>'TGL_TERBIT',
          'header'=>'TANGGAL TERBIT',
        ),
         array(
          'name'=>'TGL_JATUH_TEMPO',
          'header'=>'TANGGAL JATUH TEMPO',
        ),
        array(
          'name'=>'SELISIH',
          'header'=>'SELISIH',
          
        ),
        array(
                  'name'=>'STATUS_BAYAR',
                  'type'=>'raw',
                  'value'=>function($model){
                    
                       if($model['STATUS_BAYAR'] == 'BAYAR'){

                        
                          return CHtml::link('Bayar', '#', array('class'=>'btn btn-success btn-xs'));

                        }
                          return CHtml::link('Belum Bayar', '#', array('class'=>'btn btn-danger btn-xs'));
                    },
                  
        ),
      ),
    )
  ); 

  ?>