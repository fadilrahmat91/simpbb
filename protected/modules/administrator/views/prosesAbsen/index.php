
<section class="content-header">
    <h1>
        Absen
        <small>Proses </small>
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
            Proses absen
          </h3>
        </div>
       <div class="panel panel-heading">
			<form class="form-inline" action="<?= yii::app()->createAbsoluteUrl('administrator/prosesabsen/create'); ?>" method="post">
			  <div class="form-group">
			    <label for="jurusan">Jurusan</label>
			    <?php $models =Jurusan::model()->findAll(); ?>
			    <select type="text" class="form-control" id="jurusan" name="jurusan">
			    	<option>pilih</option>
			    	<?php foreach($models as $dpt){ ?>
			    	<option value="<?= $dpt['id']; ?>"><?= $dpt['jurusan']; ?></option>
			    	<?php } ?>
			    </select>
			  </div>
			  

			 
			  <button type="submit" class="btn btn-default">cari</button>
			</form>
		</div>
      </div>
      <div class="box box-default">
        <div class="box-header with-border">
          <i class="fa fa-database"></i> 
          <h3 class="box-title">Data Siswa</h3>
          
        </div>
        <div class="box-body">
            <?php $this->renderPartial('_Rgrid_view',array('model'=>$model)); ?>
        </div>
      </div>
    
    </div>
  </div>
</section>
