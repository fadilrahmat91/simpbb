<!-- search-form -->
								<?php $this->widget('RGridView', array(
					'id'=>'data-grid',
					'ajaxUpdate' => true,
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
								'name'=>'NOP',
								'header'=>'NOP',
							),                        
							array(
								'name'=>'JALAN_OP',
								'header'=>'LETAK OBJEK PAJAK',
							),
							array(
								'name'=>'RT_RW',
								'header'=>'RT/RW',
							),
							array(
								'name'=>'NM_WP',
								'header'=>'NAMA WAJIB PAJAK',
							),
							array(
								'name' => 'TOTAL_LUAS_BUMI',                     
								'header'=>'LUAS BUMI'
							),  
							array(
								'name' => 'TOTAL_LUAS_BNG',                     
								'header'=>'LUAS BNG'
							),
							array(
								'name' => 'LATTITUDE',                     
								'header'=>'LATTITUDE'
							),
							array(
								'name' => 'LONGITUDE',                     
								'header'=>'LONGITUDE'
							),
							array(
								'name' => 'TGL_PENAMBAHAN_LOKASI',                     
								'header'=>'TGL PENAMBAHAN LOKASI'
							)
					),
				)); ?>