<section class="content-header">
    <h1>
        Role Administrator
        <small>Pengaturan</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active">Role menu</li>
    </ol>
</section>

<section class="content">
    <div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-database"></i> 
					<div class="  box-tools">
						<a href="<?=Yii::app()->createAbsoluteUrl('/administrator/userrole/create')?>"  class=" btn btn-primary btn-sm "><i class="fa fa-plus"></i> Tambah</a>
					</div>
					<h3 class="box-title">Data user Role</h3>
				</div>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Role</th>
							<th>Alamat Url home</th>
							<th>Aksi</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach( $model as $p ){
							?>
								<tr>
									<td><?=$p->id?></td>
									<td><?=$p->nama_akses?></td>
									<td><?=$p->alamat_utama?></td>
									<td><a class="btn btn-default btn-sm" href="<?=Yii::app()->createAbsoluteUrl('administrator/userRole/menuAkses/id/'.$p->id)?>">Atur menu Akses</a></td>
									<td><a class="btn btn-primary btn-xs" href="<?=Yii::app()->createAbsoluteUrl('administrator/userRole/update/id/'.$p->id)?>"><i class="fa fa-edit"></i>Edit</td>
								</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

