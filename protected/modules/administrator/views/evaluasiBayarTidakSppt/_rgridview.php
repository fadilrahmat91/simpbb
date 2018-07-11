<!-- search-form -->
<?php $this->widget('RGridView', array(
'id'=>'evaluasi-pembayaran-tidakmemiliki-sppt',
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
          'name'=>'KD_BLOK',
          'header'=>'KODE BLOK',
        ),
        array(
          'name'=>'NO_URUT',
          'header'=>'NOMOR URUT',
        ),
        array(
          'name'=>'KD_JENIS_OP',
          'header'=>'KODE JENIS OP',
        ),
        array(
          'name'=>'THN_PAJAK_SPPT',
          'header'=>'TAHUN PAJAK SPPT',
        ),
    ),
  )); ?>