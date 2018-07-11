<?php
/* @var $this ZoneController */
/* @var $model Zone */
/* @var $form CActiveForm */
$tahun = [];
?>
<?php for( $xn = Yii::app()->report->tahun_akhir(); $xn >= Yii::app()->report->tahun_mulai(); $xn-- ){ ?>
	<?php $tahun[$xn] = $xn?>
<?php } ?>
<div class="form">
	<div class="box-body">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'action'=>Yii::app()->createUrl($this->route),
			'method'=>'get',    
			'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'role'=>'form'
			),
		)); ?> 
		<div class="form-group">
				<?php echo $form->labelEx($model,'nop',array('class'=>'col-sm-2 control-label')); ?>
				<div class="col-sm-5">
					<div class="input-group input-group-lg">
						<input type="text" name="nopform" value="<?php echo $model->nop ?>" class="form-control" data-inputmask="'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']" data-mask>
						<span class="input-group-btn">
						  <button id="search-pajak" type="button" class="btn btn-info btn-flat">Cari <i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
	
	</div>
	
	<?php $this->endWidget(); ?>
</div>
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
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/historybayar/Ceknop')?>", 'POST', {nop:nop},function(response){
			if(response.status == 'nop_berubah'){
				if( confirm("Ada Perubahan NOP Tanggal "+response.tanggal+"\nMenjadi "+response.nop) == true){
					$("input[name=nopform]").val(response.nop);
					search_nop(response.nop);
				}
			}else if(response.status == 'ok-update' ){
					//alert(response.msg);
					window.location.assign(response.url);
				
			}else{
					// show eror login;
					//Ajax.run_error();
					alert(response.msg);
				}
		});
	}
	

	$("#search-pajak").click(function(){
		$("div#list-sppt").html("").hide();
		$("div#info-op-wp").html("").hide();
		var nop = $("input[name=nopform]").val();
		search_nop(nop);
	});
	
	$("input[name=nopform]").keypress(function(e) {
		if(e.which == 13) {
			$("div#list-sppt").html("").hide();
			$("div#info-op-wp").html("").hide();
			var nop = $(this).val();
			search_nop(nop);
		}
		return false;
	});
})
			
</script>
