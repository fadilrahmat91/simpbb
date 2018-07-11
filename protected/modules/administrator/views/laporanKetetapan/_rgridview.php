<!-- search-form -->
<?php $this->widget('RGridView', array(
'id'=>'laporan-ketetapan',
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
			'name'=>'KECAMATAN',
			'header'=>'KECAMATAN',
			'value' => 'Yii::app()->report->kecamatanName($data["KD_KECAMATAN"])',
		),
		array(
			'name'=>'KEL_DESA',
			'header'=>'KEL/DESA',
			'value'=>'Yii::app()->report->kelurahanName($data["KD_KECAMATAN"],$data["KD_KELURAHAN"])',
		),
		array(
			'name' => 'KETETAPAN',
			'header'=>'KETETAPAN',
			'value'=>'Yii::app()->report->minimalketetapan($data["KETETAPAN"],$data["TAHUN"])',			
		),  
		array(
			'name' => 'STATUS',                     
			'header'=>'STATUS'
		),  
		array(
			'name' => 'TGL_TERBIT',                     
			'header'=>'TGL TERBIT'
		),
		array(
			'name' => 'TGL_JTH_TEMPO',                     
			'header'=>'TGL JTH TEMPO'
		),
		
),
)); ?>