<section class="content-header">
    <h1>
        Pembayaran
        <small>Pajak</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Form Pembayaran</h3>
					<div class="box-tools">
						<?php echo CHtml::link("Data Pembayaran",array('admin'),array('class'=>"btn btn-primary btn-sm")) ?>
					</div>
				</div>
				<div class="box-body">
					<?php $this->renderPartial('_form', array('model'=>$model)); ?>
				</div>
				
			</div>
			<div id="info-op-wp" style="display:none"></div>
			<div id="list-sppt" style="display:none"></div>
		</div>
	</div>
</section>
