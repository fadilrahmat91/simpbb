<?php $this->widget('RGridView', array(
					//'buttonExport'=>CHtml::link("Export Excel",array('export','tahun'=>$model->tahun,'kecamatan'=>$model->kecamatan),array('class'=>"btn btn-primary btn-export-excel")),
					'id'=>'data-grid',
					'dataProvider'=>$model->search(),
					//'filter'=>$model,
					'ajaxUpdate' => true,
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
								'value' => 'Yii::app()->report->get_nama_alamat($data["SUBJEK_ID"],"NM_WP")',
							),	
							array(
								'name'=>'JALAN_WP',
								'header'=>'ALAMAT WP',
								'value' =>'Yii::app()->report->get_nama_alamat($data["SUBJEK_ID"],"JALAN_WP")',
							),                      
							array(
								'name'=>'KECAMATAN',
								'header'=>'KECAMATAN',
								'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
							),
							array(
								'header'=>'KEL/DESA',
								'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',						
							),
							array(
								'name' => 'PIUTANG',
								'header'=>'PIUTANG',
								'value'=>'Yii::app()->report->minimalketetapan($data["PIUTANG"],$data["TAHUN"])'
							),
							array(
								'name' => 'TAHUN',                     
								'header'=>'TAHUN'
							),
							array(
								'name' => 'TGL_TERBIT',                     
								'header'=>'TGL_TERBIT'
							),
							array(
								'name' => 'TGL_JTH_TEMPO',                     
								'header'=>'TGL JTH TEMPO'
							)
					),
				)); ?>