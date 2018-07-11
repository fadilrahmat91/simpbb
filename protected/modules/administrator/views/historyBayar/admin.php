<section class="content-header">
    <h1>
        History
        <small>Bayar </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo Yii::app()->createAbsoluteUrl('administrator/admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">History Bayar</a></li>
  </ol>
</section>
<section class="content">
    <div class="row">
    <div class="col-md-12">
      
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-search-plus"></i>
          <h3 class="box-title">
            Form Pencarian History Bayar
          </h3>
        </div>
        <div class="box-body">
        <?php 
          $this->renderPartial('_search',array('model'=>$model)); 
        ?>
        </div>
      </div>
      <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-database"></i> 
          <h3 class="box-title">Data Evaluasi Tahunan</h3>
          
        </div>
        <div class="box-body">
          <?php $this->renderPartial('_rgridview',array('model'=>$model)); ?>
        </div>
      </div>
    
    </div>
  </div>
</section>

