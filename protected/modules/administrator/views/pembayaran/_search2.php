<?php
/* @var $this ZoneController */
/* @var $model Zone */
/* @var $form CActiveForm */
?>

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
					<h3 class="box-title">Form Salinan Pembayaran</h3>
					<div class="box-tools">
						<?php echo CHtml::link("Data Pembayaran",array('admin'),array('class'=>"btn btn-primary btn-sm")) ?>
					</div>
				</div>
				
					<div class="form">
						<div class="box-body">
							<?php $form=$this->beginWidget('CActiveForm', array(
								// 'action'=>Yii::app()->createUrl($this->route),
								'id'=>'salinan-pembayaran',
								// 'method'=>'get',    
								'htmlOptions'=>array(
									'class'=>'form-horizontal',
									'role'=>'form'
								),
							)); ?> 
							<div class="form-group">
									<?php echo $form->labelEx($model,'nop',array('class'=>'col-sm-2 control-label')); ?>
									<div class="col-sm-5">
										<div class="input-group input-group-lg">
											<input type="text" name="PembayaranForm[nop]" value="<?php echo $model->nop ?>" class="form-control" data-inputmask="'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']" data-mask>
											<span class="input-group-btn">
											  <button class="btn btn-primary btn-sm" name="yt0" type="submit">Cari <i class="fa fa-search"></i></button>
											</span>
										</div>
									</div>
								</div>
						
						</div>
						
						<?php $this->endWidget(); ?>
					</div>
				
				
			</div>
			<div id="info-op-wp" style="display:none"></div>
			<div id="list-sppt" style="display:none"></div>
		</div>
	</div>
</section>
<script>
	$("document").ready(function(){
		$('[data-mask]').inputmask();
				var  in_array = function(needle, haystack) {
				for(var i in haystack) {
					if(haystack[i] == needle) return true;
				}
				return false;
		}

		$("form#salinan-pembayaran").submit(function(){
			var formx = $("form#salinan-pembayaran");
			Ajax.run(formx.attr('action'),'GET',formx.serialize(),function(response){
				if(response.status == 'ok-update' ){
					window.location.assign(response.url);
				}else if(response.status == 'ok' ){
					alert(response.msg);
					formx[0].reset();
				
				}else{
					// show eror login;
					//Ajax.run_error();
					alert(response.msg);
				}
			});
			return false;
		})
	});
</script>

