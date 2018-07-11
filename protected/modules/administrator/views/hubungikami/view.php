<section class="content-header">
	<h1>Data Pertanyaan
		<small>Tampilan</small>
	</h1>
</section>
<section class="content">
	<div  class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="fa fa-database"></i>
					<!-- <div class="box-tools">
						
					</div> -->
					<h3 class="box-title">Data Administrator</h3>
				</div>
					<div class="box-body">
					
					
					</div>


	<div class="box-body">


			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
				'nama',
				'email',
				'no_telp',
				'pertanyaan',
				'jawaban',
					array(
						'name'=>'status_jawab',
						'value'=>Hubungikami::status($model->status_jawab),
					),
				'tanggal_jawab',
					array(
						'name'=>'dijawab_oleh',
						'value'=>User::get_user_by_id($model["dijawab_oleh"],"nama_lengkap"),
					),
				'tanggal_kirim',
				),
			)); ?>
			<div class="box-tools">
						<a href="<?php echo Yii::app()->createUrl('administrator/hubungikami/create',array("id"=>$model->id))?>" class="btn btn-primary">Balas </a>
						
								
			</div>

</div>
</div>
</div>
</div>
</section>