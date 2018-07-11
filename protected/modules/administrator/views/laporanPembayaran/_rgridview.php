
				<?php $this->widget('RGridView', array(
					'id'=>'laporan-pembayaran',
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
								'name'=>'NM_WP',
								'header'=>'NAMA WP',
								'value' => 'Yii::app()->report->get_nama_alamat($data["NOMOR_ID"],"NM_WP")',
							),	
							array(
								'name'=>'JALAN_WP',
								'header'=>'ALAMAT WP',
								'value' =>'Yii::app()->report->get_nama_alamat($data["NOMOR_ID"],"JALAN_WP")',
							),
							
							array(
								'header'=>'KECAMATAN',
								'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
							),
							array(
								'name' => 'KETETAPAN',
								'header'=>'KETETAPAN',				
							),
							 			
							array(
								'name' => 'PEMBAYARAN_POKOK',                     
								'header'=>'PEMBAYARAN POKOK'
							),
							array(
								'name' => 'PEMBAYARAN_DENDA',
								'header'=>'PEMBAYARAN DENDA',				
							),
							array(
								'name' => 'LEBIH_BAYAR',
								'header'=>'LEBIH BAYAR',				
							),
							array(
								'name' => 'KURANG_BAYAR',
								'header'=>'KURANG BAYAR',				
							),
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),			
							array(
								'name' => 'TGL_BAYAR',                     
								'header'=>'TGL BAYAR'
							)
					),
				)); ?>