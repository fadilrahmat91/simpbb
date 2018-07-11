<!-- search-form -->
<?php $this->widget('RGridView', array(
'id'=>'evaluasi-nop-double',
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
          'name'=>'THN_PAJAK_SPPT',
          'header'=>'TAHUN PAJAK SPPT ',
        ),
        array(
          'name'=>'STATUS_NOP_ASAL',
          'header'=>'STATUS NOP ASAL ',
        ),
        array(
          'name'=>'NOP_ASAL',
          'header'=>'NOP ASAL ',
        ),
        array(
          'name'=>'NOP_PERUBAHAN',
          'header'=>'NOP PERUBAHAN',
        ),
        array(
          'name'=>'STATUS_NOP_PERUBAHAN',
          'header'=>'STATUS NOP PERUBAHAN ',
        ),
    ),
  )); ?>