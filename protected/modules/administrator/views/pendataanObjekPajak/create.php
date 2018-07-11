<section class="content-header">
    <h1>
        Pendataan
        <small>SPOP dan LSPOP</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=Yii::app()->createAbsoluteUrl('administrator/backendMenus/admin')?>"><i class="fa fa-dashboard"></i> Backend Menu </a></li>
        <li class="active">Pendataan</li>
    </ol>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-5">
			<div class="box box-primary">
				<div class="box-header with-border">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">SPOP dan LSPOP</h3>
				</div>
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
		<div class="col-md-7" id="element-content-detail">
		</div>
	</div>
</section>

<script>
	$("document").ready(function(){
		$('[data-mask]').inputmask();
		$("select#PendataanObjekPajak_jenis_formulir").change(function(){
			var _val = $(this).val();
			Pendataan.jenis_transaksi( _val, $("div.jns_transaksi").data('jnstransaksi'), $('select#PendataanObjekPajak_jenis_transaksi') );
			Pendataan.handlingPage2("<?=Yii::app()->createAbsoluteUrl('administrator/pendataanObjekPajak/handling_page2')?>",{jenis_formulir:_val},"#element-content-detail" );
		});
		$("form#pendataan-op-baru").submit(function(){
			var _form = $("form#pendataan-op-baru");
			Ajax.run(_form.attr('action'),'POST',_form.serialize(),function(response){
				Pendataan.handlingPage1(response);
			});
			return false;
		})
	});
</script>