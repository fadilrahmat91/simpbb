<!-- search-form -->
<?php $this->widget('RGridView', array(
'id'=>'laporan-ketetapan',
'dataProvider'=>new CArrayDataProvider($model->SiswabyJurusan()),
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
          'name'=>'npm',
          'header'=>'npm',
          //'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ), 
           array(
          'name'=>'jurusan',
          'header'=>'jurusan',
          //'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ), 
             array(
          'name'=>'tgl_masuk',
          'header'=>'tgl_masuk',
          //'value' => 'Yii::app()->report->uangFormat($data["KETETAPAN"])',
        ),
       
       
         


    ),
  )); ?>