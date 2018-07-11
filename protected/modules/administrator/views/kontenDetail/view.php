
<section class="content-header">
	<h1> Konten 
	<small>Detail</small>
	</h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-database"></i>
					<!-- <div class="box-tools">
						<a href="" class="btn btn-primary"></a>
					</div> -->
					<h3 class="box-title">Detail View</h3>

				</div>
					<div class="box-body">				
						<div class="container">
							<h1> Judul : <?php echo $model->judul; ?></h1>
							<table class="table table-bordered">
								<thead>
									<tr >
										
										<td><?php echo CHtml::encode($model->getAttributeLabel('judul')); ?></td>
										<td><?php echo CHtml::encode($model->getAttributeLabel('tgl_buat')); ?></td>
										<td><?php echo CHtml::encode($model->getAttributeLabel('isi_konten')); ?></td>
										<td><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></td>
										<td><?php echo CHtml::encode($model->getAttributeLabel('gambar')); ?></td>
										<td><?php echo CHtml::encode($model->getAttributeLabel('konten_id')); ?></td>
									</tr>
								</thead>
								<tbody>
							      <tr>
							     
							        <td><?php echo  $model->judul ?></td>
							        <td><?php echo $model->tgl_buat ?></td>
							        <td><?php echo $model->isi_konten ?></td>
							        <td><?php echo $model->status ?></td>
							        <td><?php echo $model->gambar ?></td>
							        <td><?php echo $model->konten_id ?></td>
							      </tr>
							     
							    </tbody>
							  </table>
							</div>

					</div>
		   </div>
		</div>
	</div>
</section>
