<section class="content-header">
    <h1>
        Konten
        <small>Kegiatan</small>
    </h1>
    <ol class="breadcrumb">
	    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/kegiatan/admin')?>">Kegiatan</a></li>
	    <li class="active">Perbarui</li>
	</ol>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Form Update Kegiatan</h3>
					<div class="box-tools">
						<?php echo CHtml::link("Data Konten Kegiatan",array('admin'),array('class'=>"btn btn-primary btn-sm")) ?>
					</div>
				</div>
				<div class="box-body">
					<?php $this->renderPartial('_form', array('model'=>$model)); ?>
				</div>
			</div>
		</div>
	</div>
</section>