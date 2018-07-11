<section class="content-header">
		<h1>
			Hubungi Kami
				<small>pertanyaan</small>
		</h1>
		<ol class="breadcrumb">
				<li><a href=""><i class="fa fa-dashboard"></i>Balas</a></i>
				<li class="active">Pertanyaan</li>
		</ol>
</section>
	<section class="content">
	    <div class="row">
			<div class="col-md-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4> <i class="fa fa-drivers-license-o"></i>
							<?php echo $model->nama; ?></h3>
					</div>
					<div class="box-header with-border">	
						<div><h5><u>Pertanyaan ??</u></h5>	
							<div cols="80" rows="10">
							<?php echo $model->pertanyaan ?>
							</div>
						</div>
					</div>
					
					<?php $this->renderPartial('_form', array('model'=>$model)); ?>
				</div>
		   </div>
		</div>