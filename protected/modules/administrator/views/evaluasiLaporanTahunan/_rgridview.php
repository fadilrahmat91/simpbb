<!-- search-form -->
<?php $this->widget('RGridView', array(
'id'=>'evaluasi-laporan-tahunan',
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
          'name'=>'TAHUN',
          'header'=>'TAHUN',
        ),
        array(
          'name'=>'KD_KECAMATAN',
          'header'=>'KECAMATAN',
          'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
        ),
        array(
          'name'=>'KD_KELURAHAN',
          'header'=>'KELURAHAN',
          'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',
        ),
        array(
          'name'=>'JUM_OBJEK_KETETAPAN',
          'header'=>'JUMLAH OBJEK KETETAPAN',
        ),
        array(
          'name'=>'KETETAPAN',
          'header'=>'KETETAPAN',
          'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ),
        array(
          'name'=>'JUM_OBJEK_PIUTANG',
          'header'=>'JUMLAH OBJEK PIUTANG',
        ),
        array(
          'name'=>'PIUTANG',
          'header'=>'PIUTANG',
          'value' => 'Yii::app()->report->uangFormat($data["PIUTANG"])',
        ),
        array(
          'name'=>'JUM_OBJEK_REALISASI',
          'header'=>'JUMLAH OBJEK REALISASI',
        ),
        array(
          'name'=>'REALISASI',
          'header'=>'REALISASI',
          'value' => 'Yii::app()->report->uangFormat($data["REALISASI"])',
        ),
        array(
          'name'=>'SELISIH',
          'header'=>'SELISIH',
          'value' => 'Yii::app()->report->uangFormat($data["SELISIH"])',
        ),
    ),
  )); ?>