<!-- search-form -->
<?php $this->widget('RGridView', array(
'id'=>'evaluasi-rekapbayar-tahunan',
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
        ),
        array(
          'name'=>'NM_WP',
          'header'=>'NAMA WP',
        ),
        array(
          'name'=>'KD_KECAMATAN_P',
          'header'=>'KECAMATAN ',
          'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
        ),
        array(
          'name'=>'KD_KELURAHAN_P',
          'header'=>'KELURAHAN',
          'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',
        ),
        array(
          'name'=>'THN_PAJAK_SPPT',
          'header'=>'TAHUN PAJAK SPPT',
        ),
    ),
  )); ?>