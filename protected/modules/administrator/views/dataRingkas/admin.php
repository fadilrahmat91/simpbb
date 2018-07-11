<section class="content-header">
    <h1>
        DATA
        <small>RINGKAS</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">FORM RINGKAS</h3>
				</div>
				<div class="box-body">
				<?php 
					$this->renderPartial('_search',array('model'=>$model,'keloption'=>$keloption)); 
				?>
				</div>
			</div>
			<div class="box box-default">
				<div class="box-header with-border">
					<i class="fa fa-database"></i> 
					<h3 class="box-title">DATA RINGKAS</h3>
				</div>
				<div class="box-body">
					<?php $this->renderPartial('_rgriddata',array('model'=>$model)); ?>
				</div>
			</div>
		</div>
	</div>
</section>

