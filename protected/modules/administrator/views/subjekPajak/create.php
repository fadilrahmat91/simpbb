<section class="content-header">
    <h1>
        Data
        <small>Subjek Pajak</small>
    </h1>
    <ol class="breadcrumb">
	    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/subjekpajak/admin')?>">Data Subjek Pajak</a></li>
	    <li class="active">Tambah</li>
	</ol>
</section>
<section class="content">
    <div class="row">
    	<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</section>