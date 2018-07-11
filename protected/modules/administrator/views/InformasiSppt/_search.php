
<section class="content-header">
    <h1>
        History
        <small>Informasi SPPT</small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Form Pencarian SPPT </h3>
					<div class="box-tools">
						
					</div>
				</div>
				<div class="box-body">
				<div class="form">
					<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'informasi-sppt',
					'enableAjaxValidation'=>true,
					'htmlOptions'=>array(
						'class'=>'form-horizontal',
						'role'=>'form'),

					)); ?>
						<div class="form-group">
							<?php echo $form->labelEx($model,'nop',array('class'=>'col-sm-2 control-label')); ?>
							<div class="col-sm-5">
								<div class="input-group input-group-lg">
									<input type="text" name="nopform" value="" class="form-control" data-inputmask="'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']" data-mask>
									<span class="input-group-btn">
									  <button id="form-nya" type="button" class="btn btn-info btn-flat">Cari <i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
					</div>
				
				</div>
				
				<?php $this->endWidget(); ?>
				
				</div>
				
			</div>
			
		</div>
	</div>
</section>
			
				
	
<script type="text/javascript">
		$("document").ready(function(){
		$('[data-mask]').inputmask();
			var  in_array = function(needle, haystack) {
				for(var i in haystack) {
					if(haystack[i] == needle) return true;
				}
				return false;
			}

		var search_nop = function(nop){
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/InformasiSppt/Ceknop')?>", 'GET', {nop:nop},function(response){
			if(response.status == 'nop_berubah'){
				if( confirm("Ada Perubahan NOP Tanggal "+response.tanggal+"\nMenjadi "+response.nop) == true){
					$("input[name=nopform]").val(response.nop);
					search_nop(response.nop);
				}
			}else if(response.status == 'ok-update' ){
					//alert("testdulu");
					window.location.assign(response.url);
					
				
			}else{
					
					alert(response.msg);
				}
		});
	}
		$("#form-nya").click(function(){
			var nop = $("input[name=nopform]").val();
			search_nop(nop);
		});
		
		});
			
</script>
