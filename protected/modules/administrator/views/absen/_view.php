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
							
							
								<tr>
								<td> </td>
								<td></td>
								<td><div class="btn-group">
										<a  href="javascript:void(0)"
											data-id=""
											data-nama=""
											type="button" data-toggle="modal" data-target="#edit-data"				class="btn btn-info btn-xs "  >Edit</a>
										<a href="javascript:void(0)" data-set=""  class="btn btn-xs btn-danger hapus_matkul">hapus<a>
										
									</div>
								</tr>
									
									
					</table>
			<!-- modal edit data -->
	<div id="edit-data" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Mata Kuliah</h4>
				</div>
				<form  id="form_edit_matkul">
				<div class="modal-body">
						<div class="form-group">
							<input class="form-control" type="hidden" value=" "id="id_matkul" name="id_matkul"></input>
							<label> Mata Kuliah</label>
							<input class="form-control"  id="nama_matakuliah" name="nama_matakuliah" required> </input>
						</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary edit_matkul" >Simpan</button>
					<button type="button"  class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
				</div>
				</form>
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
				<form  id="form_tambah_matkul">
				<div class="modal-body">
						<div class="form-group">
							<label> Mata Kuliah </label>
							<input class="form-control"   name="nama_matakuliah" required> </input>
						</div>
				</div>
				<div class="modal-footer">
					<button     class="btn btn-primary tambah_matkul" >Simpan</button>
					<button type="button"  class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
				</div>
				</form>
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
	$("#form_edit_matkul").submit(function(e){
		e.preventDefault();
		var data = $('#form_edit_matkul').serialize();
		$.ajax({
			type: 'POST',
			url: "",
			data: data,
			success: function(){
				$('.modal-body').html('<div class=" alert alert-success"></i><p class="text-center"><i class="glyphicon glyphicon-ok"></i> Berhasil diubah! </p></div>');
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
	$("#form_tambah_matkul").submit(function(e){
		e.preventDefault();
		var data = $('#form_tambah_matkul').serialize();
		$.ajax({
			type: 'POST',
			url: "",
			data: data,
			success: function(){
				$('.modal-body').html('<div class=" alert alert-success"></i><p class="text-center"><i class="glyphicon glyphicon-ok"></i> Suksess </p></div>');
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
					
					