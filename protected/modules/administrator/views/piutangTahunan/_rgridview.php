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
		'columns'=>LaporanPiutang::_order($model->group_by,'rGrid'),
	)); ?>