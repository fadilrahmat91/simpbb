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
								'name'=>'BLOK_KD_JENIS',
								'header'=>'BLOK-NOMOR URUT',
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
								'name' => 'KD_ZNT',
								'header'=>'KODE ZNT',				
							),  
							array(
								'name' => 'LUAS_BUMI',                     
								'header'=>'LUAS BUMI'
							),  
							array(
								'name' => 'LUAS_BNG',                     
								'header'=>'LUAS BNG'
							),
							array(
								'name' => 'NJOP_BUMI',                     
								'header'=>'NJOP BUMI'
							),
							array(
								'name' => 'TOTAL_BNG',                     
								'header'=>'NJOP BANGUNAN'
							),
							array(
								'name' => 'TOTAL_NJOP',                     
								'header'=>'TOTAL NJOP'
							),
							
					),
				)); ?>