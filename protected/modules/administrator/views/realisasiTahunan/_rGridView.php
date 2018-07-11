<?php $this->widget('RGridView', array(
	'id'=>'realisasi-tahunan',
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
		'columns'=>RealisasiTahunan::_order($model->group_by,'rGrid'),
)); ?>