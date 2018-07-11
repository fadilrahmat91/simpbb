<!-- search-form -->
<?php $this->widget('RGridView', array(
'id'=>'evaluasi-laporan-tahunan',
'dataProvider'=>$model->search(),
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
          'name'=>'SUBJEK_PAJAK_ID',
          'header'=>'SUBJEK PAJAK ID',
        ),
        array(
          'name'=>'NM_WP',
          'header'=>'NAMA WP',
        ),
        array(
          'name'=>'JALAN_WP',
          'header'=>'JALAN WP',
        ),
        array(
          'name'=>'BLOK_KAV_NO_WP',
          'header'=>'BLOK KAV NO WP',
        ),
        array(
          'name'=>'RW_WP',
          'header'=>'RW WP',
        ),
        array(
          'name'=>'RT_WP',
          'header'=>'RT WP',
        ),
        array(
          'name'=>'KELURAHAN_WP',
          'header'=>'KELURAHAN WP',
        ),
        array(
          'name'=>'KOTA_WP',
          'header'=>'KOTA WP',
        ),
        array(
          'name'=>'KD_POS_WP',
          'header'=>'KODE POS WP',
        ),
        array(
          'name'=>'TELP_WP',
          'header'=>'TELP WP',
        ),
        array(
          'name'=>'NPWP',
          'header'=>'NPWP',
        ),
        array(
          'name'=>'STATUS_PEKERJAAN_WP',
          'header'=>'STATUS PEKERJAAN WP',
          'value'=>'Lookup::status_pekerjaan_wp($data["STATUS_PEKERJAAN_WP"])',
        ),
        array(
                'header'=>'AKSI',
                'class'=>'CButtonColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>array(
                  'view'=>array(
                      'label'=>' ',
                      'options' => array('class'=>'fa fa-eye fa-lg'),
                      'url'=>'Yii::app()->createUrl("administrator/subjekpajak/view",array())',
                      'imageUrl'=>false,
                  ),
                  'update'=>array(
                      'label'=>' ',
                      'options' => array('class'=>'fa fa-edit fa-lg'),
                      'url'=>'Yii::app()->createUrl("administrator/subjekpajak/update",array())',
                      'imageUrl'=>false,
                  ),
                  'delete'=>array(
                      'label'=>' ',
                      'options' => array('class'=>'fa fa-trash-o fa-lg'),
                      'url'=>'Yii::app()->createUrl("administrator/hubungikami/delete",array())',
                      'imageUrl'=>false,
                  ),
                
                )
              ),
    ),
  )); 
  ?>