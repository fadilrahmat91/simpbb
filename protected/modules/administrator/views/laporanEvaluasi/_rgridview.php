<!-- search-form -->
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
          'name'=>'KETETAPAN',
          'header'=>'KETETAPAN',
          'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ),
           array(
          'name'=>'KD_KECAMATAN',
          'header'=>'KD_KECAMATAN',
         // 'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ),
             array(
          'name'=>'KD_KELURAHAN',
          'header'=>'KD_KELURAHAN',
         // 'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
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
       
         


    ),
  )); ?>