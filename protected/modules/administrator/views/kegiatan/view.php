 <section class="content-header">
    <h1>
        View
        <small>Kegiatan</small>
    </h1>
    <ol class="breadcrumb">
	    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/kegiatan/admin')?>">Kegiatan</a></li>
	    <li class="active">Lihat</li>
	</ol>
      
</section>
<section class="content">
    <div class="row">
    <div class="col-md-8">
	      <div class="box box-primary">
	        <div class="box-header with-border">
	          	<i class="ion ion-clipboard"></i>
	          	<h3 class="box-title">View Data Kegiatan</h3>
	          	<div class="box-tools">
	            	<?php echo CHtml::link("Data Konten Kegiatan",array('admin'),array('class'=>"btn btn-primary btn-sm")) ?>
	          	</div>
	        </div>
	        <div class="box-body table-responsive no-padding">
	        	<?php $this->renderPartial('_view', array('model'=>$model)); ?>
	        </div>
	      </div>
    	</div>
  	</div>
</section>