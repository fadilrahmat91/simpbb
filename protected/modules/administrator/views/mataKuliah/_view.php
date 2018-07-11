<body>
<div class="panel panel-heading">
					Daftar Matakuliah
					<a data-toggle="modal" data-target="#tambah-matakuliah" class="btn btn-success btn-sm tombol_kanan " href="javascript:void(0);" ><i class="glyphicon glyphicon-plus"></i> &nbsp;&nbsp;Tambah Matakuliah</a>
		
				</div>
<div class="panel-body ">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="3%">No</th>
								<th>Mata Kuliah</th>
								<th>Aksi</th>
							</tr>
						</thead>
							<?php $no =0; ?>
							<?php foreach($data as $dpt){ 
							$no++; ?>
								<tr>
								<td> <?= $no ?></td>
								<td> <?= $dpt['mata_kuliah']; ?></td>
								
								<td><div class="btn-group">
										<a  href="javascript:void(0)"
											data-id="<?= $dpt['id_matkul']; ?>"
											data-nama="<?= $dpt['mata_kuliah']; ?>"
											type="button" data-toggle="modal" data-target="#edit-data"				class="btn btn-info btn-xs "  >Edit</a>
										<a href="javascript:void(0)" data-set="<?= $dpt['id_matkul']; ?>"  class="btn btn-xs btn-danger hapus_matkul">hapus</a>
										
									</div>
								</tr>
							<?php } ?>
									
									
					</table>
			<!-- modal edit data -->
	<div id="edit-data" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Mata Kuliah</h4>
				</div>
				<div class="form">

				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'mata-kuliah-form-edit',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)); ?>

					<p class="note">Fields with <span class="required">*</span> are required.</p>

					<?php echo $form->errorSummary($model); ?>
					<div class="form-group ">
						
						<?php echo $form->hiddenField($model,'id_matkul',array('class'=>'form-control','id'=>'id_matkul')); ?>
						
					</div>

					<div class="form-group ">
						<?php echo $form->labelEx($model,'mata_kuliah'); ?>
						<div class="col-sm-9">
						<?php echo $form->textField($model,'mata_kuliah',array('class'=>'form-control','id'=>'nama_matakuliah','nama'=>'nama_matakuliah')); ?>
						<?php echo $form->error($model,'mata_kuliah'); ?>
					</div>
					</div>

					<div class="box-footer">
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Save',array('class'=>'btn btn-primary')); ?>
					</div>

				<?php $this->endWidget(); ?>

				</div><!-- form -->
			</div>
		</div>
	</div>
	<!-- modal tambah data -->
	<div id="tambah-matakuliah" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah Mata Kuliah</h4>
				</div>
				<div class="form">

				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'mata-kuliah-form',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// There is a call to performAjaxValidation() commented in generated controller code.
					// See class documentation of CActiveForm for details on this.
					'enableAjaxValidation'=>false,
				)); ?>

					<p class="note">Fields with <span class="required">*</span> are required.</p>

					<?php echo $form->errorSummary($model); ?>

					<div class="form-group ">
						<?php echo $form->labelEx($model,'mata_kuliah',array('class'=>'col-sm-3 control-label')); ?>
						<div class="col-sm-9">
						<?php echo $form->textField($model,'mata_kuliah',array('class'=>'form-control ')); ?>
						<?php echo $form->error($model,'mata_kuliah'); ?>
					</div>
					</div>

					<div class="box-footer">
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Save',array('class'=>'btn btn-primary')); ?>
					</div>

				<?php $this->endWidget(); ?>

				</div><!-- form -->
			</div>
		</div>
	</div>
	</div>
	
<script type="text/javascript">
	  $(document).ready(function modal_db() {
        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)
            // Isi nilai pada field
            modal.find('#id_matkul').attr("value",div.data('id'));
            modal.find('#nama_matakuliah').attr("value",div.data('nama')); 
			
			
        });
    });
	$(document).ready(function modal_edit_db(){
	$("#mata-kuliah-form-edit").submit(function(e){
		e.preventDefault();
		var data = $('#mata-kuliah-form-edit').serialize();
		
		$.ajax({
			type: 'POST',
			url: "<?= yii::app()->createAbsoluteUrl('administrator/matakuliah/update'); ?>",
			data: data,
			success: function(){

				
				$('.modal-body').html('<div class=" alert alert-success"></i><p class="text-center"><i class="glyphicon glyphicon-ok"></i> Berhasil diubah! </p></div>');
				window.location.reload();
		 }
		});
		
	});
	});
	 $(document).ready(function modal_tambah_matkul() {
        // Untuk sunting
        $('#edit-data').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)
        });
    });
	$(document).ready(function modal_tambah_matkul(){
	$("#mata-kuliah-form").submit(function(e){
		e.preventDefault();
		var data = $('#mata-kuliah-form').serialize();
		$.ajax({
			type: 'POST',
			url: "<?= yii::app()->createAbsoluteUrl('administrator/matakuliah/modal') ?>",
			data: data,
			success: function(){
				$('.modal-body').html('<div class=" alert alert-success"></i><p class="text-center"><i class="glyphicon glyphicon-ok"></i> Suksess </p></div>');
				window.location.reload();


		 }
		});
		
	});
	$(".hapus_matkul").click(function(){
		var id_m=$(this).attr("data-set");
		$(".panel-info").load(""+id_m);
	});
	});
</script>
	</body>
					
					