<!-- search-form -->
	        <?php $this->widget('zii.widgets.grid.CGridView', array(
	            'id'=>'user-grid',
	            'dataProvider'=>$model->search(),
	            'filter'=>$model,
	            'itemsCssClass' => 'table table-striped table-hover',
	            'pagerCssClass'=>'text-center',    
	            'pager'=>array(  
	            	'pageSize'=>3,  
	                'header'=>'',
	                'prevPageLabel'=>'< Previous',
	                'nextPageLabel'=>'Next >',
	                  	'selectedPageCssClass' => 'active',         
	                  	'hiddenPageCssClass' => '',                        
	                  	'htmlOptions'=>array(
	                    	'class'=>'pagination',
	                  	),                  
	            ),
	            'columns'=>array(
	                array(
		                'name'=>'id',
		                'header'=>'ID',
		                'filter' => false,
	                ), 
	                array(
	                  	'name'=>'cover_image',
	                  	'header'=>'COVER IMAGE',
	                  	'value'=>function($model){
										$data=$model->cover_image;
										$data_id = $model->id;
										if($data >= 1){
											$namafile =FileLokasi::model()->findByAttributes(array("id"=>$data))->nama_file;
											$imageUrl = Yii::app()->request->baseUrl.'/upload/kegiatan/'.$data_id.'/'.$namafile;
											$image = '<img class="img-fluid" src="'.$imageUrl.'" alt="" style="width:50px; height: 50px;" />';
											echo CHtml::link($image);
										}
									},
	                  	'filter' => false,
	                  	'sortable'=>false,
	                ),
	                array(
	                  	'name'=>'nama_kegiatan',
	                  	'header'=>'NAMA KEGIATAN',
	                  	'filter' => false,
	                  	'sortable'=>false,
	                ),
	                array(
	                  	'name'=>'dropcaps',
	                  	'header'=>'Dropcaps',
	                  	'filter' => false,
	                  	'sortable'=>false,
	                ),
	                array(
	                  	'name'=>'keterangan_kegiatan',
	                  	'header'=>'KETERANGAN KEGIATAN',
	                  	'filter' => false,
	                  	'sortable'=>false,
	                ),
	                array(
	                  	'name'=>'tanggal_kegiatan',
	                  	'header'=>'TANGGAL KEGIATAN',
	                  	'value'=>'Yii::app()->dateFormatter->format("d MMM y",strtotime($data->tanggal_kegiatan))',
	                  	'filter' => false,
	                  	'sortable'=>false,
	                ),
	                array(
	                  	'name'=>'dibuat_oleh',
	                  	'value'=>'User::model()->findByAttributes(array("id"=>$data["dibuat_oleh"]))->nama_lengkap',
	                  	'filter'=>CHtml::listData(User::model()->findAll(),'id','nama_lengkap'),
	                  	'header'=>'DIBUAT OLEH',
	                  	//'filter' => false,
	                  	'sortable'=>false,
	                ),
	                array(
	                  	'header'=>'ACTION',
	                  	'class'=>'CButtonColumn',
	                  	'template'=>'{view} {update} {delete} {upload}',
	                    'buttons'=>array(
		                    'view'=>array(
		                      	'label'=>' ',
		                      	'options' => array('class'=>'fa fa-eye fa-lg'),
		                      	'imageUrl'=>false,
		                    ),
		                    'update'=>array(
		                      	'label'=>' ',
		                      	'options' => array('class'=>'fa fa-edit fa-lg'),
		                      	'imageUrl'=>false,
		                    ),
		                    'delete'=>array(
		                      	'label'=>' ',
		                      	'options' => array('class'=>'fa fa-trash-o fa-lg'),
		                      	'imageUrl'=>false,
		                    ),
		                    'upload'=>array(
		                      	'label'=>' ',
		                      	'options' => array('class'=>'fa fa-image fa-lg'),
		                      	'imageUrl'=>false,
		                      	'url'=>'Yii::app()->createUrl("/administrator/kegiatan/upload",array("id"=>$data->id))',
		                    ),
	                     ),
	                  		'deleteConfirmation'=>"js:'Apakah Anda ingin menghapus data dengan ID '+$(this).parent().parent().children(':nth-child(1)').text()+'?'",
	                ), 
	            ),
	          )); 
	        ?>