<section class="content-header">
    <h1>
        Menu Detail
        <small>Pengaturan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=Yii::app()->createAbsoluteUrl('administrator/backendMenus/admin')?>"><i class="fa fa-dashboard"></i> Backend Menu </a></li>
        <li class="active">Penambahan</li>
    </ol>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Data Aksi => Nama menu / Controller </h3>
					<div class="box-tools">
						<a href="#" class="add-new-data btn btn-primary pull-right"> Tambah aksi </a>
					</div>
				</div>
				<div class="box-body no-padding">
					<div class="add-new-data-form" style="display:none">
						<?php $this->renderPartial('_add_detail_form',array(
						'model'=>$model,
					  )); ?>
					 </div>
					<table id="table-html" class="table">
						<thead>
							<tr>
								<th>No</th>
								<th class="text-center">Nama Aksi</th>
								<th class="text-center">Metode Aksi</th>
								<th colspan="2" class="text-center"></th>
							</tr>
						</thead>
						<tbody>
							<?php $this->renderPartial('_list_item',array(
								'details'=>$details,
								'id' => $id
							)); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
          Yii::app()->clientScript->registerScript('search', "
          $('.add-new-data').click(function(){
            $('.add-new-data-form').toggle();
            $('input.btn-btn-data').val('Create');
            $('input[name=id_details]').val('0');
            $('form#application-register-detail-form')[0].reset();
            return false;
          });
          ");
          ?>