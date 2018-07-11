<?php
/* @var $this TableKegiatanController */
/* @var $model TableKegiatan */
/* @var $form CActiveForm */
?>

<div class="form">
	<div class="box-body">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'table-kegiatan-form',
			'htmlOptions'=>array(
				'class'=>'form-horizontal',
				'role'=>'form'
			),
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
			<div class="form-group">
				<?php echo $form->labelEx($model,'nop',array('class'=>'col-sm-2 control-label')); ?>
				<div class="col-sm-5">
					<div class="input-group input-group-lg">
						<input type="text" name="nopform" class="form-control" data-inputmask="'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']" data-mask>
						<span class="input-group-btn">
						  <button id="search-pajak" type="button" class="btn btn-info btn-flat">Cari <i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<!-- Modal -->
<div class="modal fade" id="modal-confirmation-split" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Konfirmasi Pembayaran</h4>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-md-7" >
				<table class="table table-bordered table-striped" id="list-payment-data">
					<thead>
						<tr>
							<th>NO</th>
							<th class="bg-primary" style="text-align:center">TAHUN</th>							
							<th class="bg-primary" style="text-align:center">KETETAPAN</th>
							<th class="bg-danger" style="text-align:center;background-color:red;color:#fff;">DENDA (<?=Yii::app()->report->persenDenda()?>%)</th>
							<th style="text-align:center">TOTAL</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="col-md-5">
				<?php $biayaAdministrasi = Yii::app()->report->biayaAdministrasi()?>
				<table class="table table-striped">
					<tbody>
						<tr>
							<td>Total Ketetapan</td>
							<td class="bg-info" style="width:150px">Rp. <span class="badge bg-light-blue pull-right" id="total_ketetapan_konfirmasi">0</span></td>
						</tr>
						<tr>
							<td>Total Denda</td>
							<td class="bg-danger">Rp. <span class="badge bg-red pull-right" id="total_denda_konfirmasi">0</span></td>
						</tr>
						<tr>
							<td>Biaya ADM</td>
							<td class="bg-success">Rp. <span class="badge bg-light-blue pull-right" id="total_denda_konfirmasi"><?=Yii::app()->format->formatNumber($biayaAdministrasi)?></span></td>
						</tr>
						
						<tr>
							<td>Total</td>
							<td class="bg-primary">Rp . <span class="badge bg-green pull-right" id="total_bayar_konfirmasi">0</span></td>
						</tr>
						<tr id="tr_calculator_bayar">
							<td colspan="2"><button class="btn btn-block btn-primary btn-sm" id="btn_calculator_bayar">BAYAR  &nbsp; &nbsp; <i class="fa fa-credit-card"></i> </button></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-striped" id="table_calculator_bayar" style="display:none">
					<tbody>
						<tr>
							<td>Total Tagihan</td>
							<td>Rp. <span class="badge bg-light-blue pull-right" id="total_tagihan">0</span></td>
						</tr>
						<tr>
							<td>Total Bayar</td>
							<td>
								<div class="input-group">
									<span class="input-group-addon">Rp.</span>
									<input type="text" class="form-control" name="total_bayar_tagihan" style="text-align: right;">
								</div>
							</td>
						</tr>
						<tr>
							<td>Uang Kembalian</td>
							<td>Rp. <span class="badge bg-light-blue pull-right" id="total_kembalian">0</span></td>
						</tr>
						<tr>
							<td colspan="2"><button class="btn btn-block btn-primary btn-sm" id="do_bayar">BAYAR  &nbsp; &nbsp; <i class="fa fa-credit-card"></i> </button></td>
						</tr>
					</body>
				</table>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <!--button type="button" class="btn btn-primary">Save changes</button-->
      </div>
    </div>
  </div>
</div>
<script>
$("document").ready(function(){
	var wajib_bayar = "<?=Yii::app()->pembayaran->limit_date_wajib_bayar()?>";
	var max_wajib_bayar = "<?=Yii::app()->pembayaran->limit_max_wajib_bayar()?>";
	var arrays_tahun = [];
	var p_nop;
	var total_tagihan = 0;
	$('[data-mask]').inputmask();
	var  in_array = function(needle, haystack) {
		for(var i in haystack) {
			if(haystack[i] == needle) return true;
		}
		return false;
	}
	var auto_count_total = function(_this,ketetapan,denda,e_tahun){
		var e_total_ketetapan = $("#total_ketetapan");
		var e_total_denda = $("#total_denda");
		var e_total_bayar = $("#total_bayar");
		var e_biaya_adm   = $("#biaya_adm");
		
		var a_total = ketetapan + denda;
		
		var total_ketetapan = e_total_ketetapan.data('hasil');
		//alert(total_ketetapan);
		///
		var total_denda = e_total_denda.data('hasil');
		var biaya_adm = e_biaya_adm.data('hasil');
		var total_bayar = e_total_bayar.data('hasil');
		
		if ( _this.is(":checked") ){
			//console.log(" Checked : "+e_tahun + " - "+ total_ketetapan + " - "+ ketetapan + " - " + denda);
			e_total_ketetapan.data("hasil",parseInt(total_ketetapan) + parseInt(ketetapan));
			e_total_denda.data("hasil",parseInt(total_denda) + parseInt(denda));
			e_total_ketetapan.text( formatNumbers(parseInt(total_ketetapan) + parseInt(ketetapan)));
			e_total_denda.text( formatNumbers(parseInt(total_denda) + parseInt(denda)));
		}else{
			//console.log(" UN Checked : "+e_tahun + " - "+ total_ketetapan + " - "+ ketetapan + " - " + denda);
			e_total_ketetapan.data("hasil",parseInt(total_ketetapan) - parseInt(ketetapan));
			e_total_denda.data("hasil",parseInt(total_denda) - parseInt(denda));
			e_total_ketetapan.text( formatNumbers(parseInt(total_ketetapan) - parseInt(ketetapan)));
			e_total_denda.text( formatNumbers(parseInt(total_denda) - parseInt(denda)));
		}
		var total_ketetapan = e_total_ketetapan.data('hasil');
		var total_denda = e_total_denda.data('hasil');
		var biaya_adm = e_biaya_adm.data('hasil');
		var total_bayar = parseInt(total_ketetapan) + parseInt(total_denda) + parseInt(biaya_adm);
		e_total_bayar.text(formatNumbers(total_bayar));
		e_total_bayar.data("hasil",total_bayar);
		
	}
	var search_nop = function(nop){
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/pembayaran/searchpajak')?>", 'POST', {nop:nop},function(response){
			if(response.status == 'nop_berubah'){
				if( confirm("Ada Perubahan NOP Tanggal "+response.tanggal+"\nMenjadi "+response.nop) == true){
					$("input[name=nopform]").val(response.nop);
					search_nop(response.nop);
				}
			}else if(response.status == 'ok'){
				p_nop = nop;
				$("div#list-sppt").html(response.html).show();
				$("div#info-op-wp").html(response.infoop).show();
				$('input[type="checkbox"].allow_ichek').iCheck({
				  checkboxClass: 'icheckbox_minimal-blue',
				  radioClass   : 'iradio_minimal-blue'
				});
				$("input[type='checkbox'].tahun_pembayaran_sppt").on('ifChanged', function (e) {
					var ketetapan = $(this).data('ketetapan'); 
					var denda     = $(this).data('denda');
					var e_tahun   = $(this).data('tahun');
					if(parseInt(e_tahun) >= parseInt(wajib_bayar) && parseInt(e_tahun) <= parseInt(max_wajib_bayar)){
						return false;
					}
					auto_count_total($(this),ketetapan,denda,e_tahun);
				});
			}
		});
	}
	
	$('body').on('click','button#check_uncheck',function(){
		var _c_value = $(this).data('value');
		var is_check_att = $(this).data('ischecklis');
		var un_check_att = $(this).data('unchecklis');
		if( _c_value == 'y' ){
			$(this).data('value','n');
			$(this).text(un_check_att);
			//$('input[type="checkbox"].allow_ichek').
			$("input[type=checkbox].allow_ichek").prop("checked",false);
		}else {
			$(this).data('value','y');
			$(this).text(is_check_att);
			$("input[type=checkbox].allow_ichek").prop("checked",true);
		} 
		$('input[type="checkbox"].allow_ichek').iCheck({
		  checkboxClass: 'icheckbox_minimal-blue',
		  radioClass   : 'iradio_minimal-blue'
		});
		$("input[type='checkbox'].tahun_pembayaran_sppt").on('ifChanged', function (e) {
			var ketetapan = $(this).data('ketetapan'); 
			var denda     = $(this).data('denda');
			var e_tahun   = $(this).data('tahun');
			if(parseInt(e_tahun) >= parseInt(wajib_bayar) && parseInt(e_tahun) <= parseInt(max_wajib_bayar)){
				return false;
			}
			auto_count_total($(this),ketetapan,denda,e_tahun);
		});

		var t_ketetapan = 0;
		var t_denda = 0;
		$(".tahun_pembayaran_sppt").each(function(){
			if ( $(this).is(":checked") ){
				t_ketetapan = t_ketetapan + $(this).data('ketetapan');
				t_denda    = t_denda + $(this).data('denda');
			}
		});
		t_denda = parseInt(t_denda);
		t_ketetapan = parseInt(t_ketetapan);
		//t_denda = Math.round(t_denda);
		console.log("denda 2 " + t_denda);
		var e_total_ketetapan = $("#total_ketetapan");
		var e_total_denda = $("#total_denda");
		var e_total_bayar = $("#total_bayar");
		var e_biaya_adm   = $("#biaya_adm");
		var biaya_adm = e_biaya_adm.data('hasil');
		e_total_ketetapan.text( formatNumbers(parseInt(t_ketetapan) ));
		e_total_denda.text( formatNumbers(t_denda));
		e_total_denda.data( 'hasil',t_denda);
		e_total_ketetapan.data( 'hasil',t_ketetapan);
		//console.log("ketetapan "+t_ketetapan+" denda "+t_denda);
		
		var total_bayar = parseInt(t_ketetapan) + parseInt(t_denda) + parseInt(biaya_adm);
		e_total_bayar.text(formatNumbers(total_bayar));
		e_total_bayar.data("hasil",total_bayar);
		
	});
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
	$('body').on('click','button#show-modal-konfirmation',function(){
		total_tagihan = 0;
		var str = "";
		arrays_tahun = [];
		arrays_tahun_2 = [];
		var tahun_data = [];
		var n = 1;
		var have_data = false;
		$("input[name=total_bayar_tagihan]").val("");
		$("span#total_kembalian").text("0");
		$("input[type='checkbox'].tahun_pembayaran_sppt").each(function(){
			if ( $(this).is(":checked") ){
				var _this = $(this);
				var ketetapan 	= _this.data('ketetapan');
				var denda 		= _this.data('denda');
				var total       = parseInt(ketetapan)+parseInt(denda);
				var tahun		= _this.data('tahun');
				str += "<tr>";
					str += "<td>"+n+"</td>";
					str += "<td>"+_this.data('tahun')+"</td>";
					str += "<td>Rp."+formatNumbers(ketetapan)+"</td>";
					str += "<td>Rp."+formatNumbers(denda)+"</td>";
					str += "<td>Rp."+formatNumbers(total)+"</td>";
				str += "</tr>";
				n++;
				have_data = true;
				arrays_tahun.push(parseInt(tahun));
				if(parseInt(tahun) < parseInt(wajib_bayar)){
					arrays_tahun_2.push(tahun);
				}
			}
		});
		$("input[name=tahun_data]").each(function(){
			tahun_data.push(parseInt($(this).val()));
		});
		
		
		if( arrays_tahun.length ){
			var array_un_selected = [];
			for (var i = 0; i < tahun_data.length; i++) {
				
				if( in_array(parseInt(tahun_data[i]),arrays_tahun) == false ){
					array_un_selected.push(parseInt(tahun_data[i]));
				}
			}
			console.log(array_un_selected);
			if( array_un_selected.length ){
				var max_array = Math.max(...arrays_tahun);
				var $msg_error = "";
				for (var i = 0; i < array_un_selected.length; i++) {
					var e_tahun = array_un_selected[i];
					if( parseInt(e_tahun) >= parseInt(wajib_bayar) && parseInt(e_tahun) <= parseInt(max_wajib_bayar)){
						$msg_error += "<p>Tahun "+e_tahun+" Harus Bayar</p>";
					}
					if( arrays_tahun_2.length){
						var max_array2 = Math.max(...arrays_tahun_2);
						if( parseInt(e_tahun) < parseInt(max_array2) ){
							$msg_error += "<p>Pilih Pembayaran Tahun "+e_tahun+", untuk membayar diatas "+e_tahun+"</p>";
						}
					}
				}
				if( $msg_error != ""){
					Ajax.show_alert('error',$msg_error);
					return;
				}
			}
			str += "</table>";
			if( have_data == true ){
				total_tagihan = $("#total_bayar").data('hasil');
				$("#total_ketetapan_konfirmasi").text(formatNumbers($("#total_ketetapan").data('hasil')));
				$("#total_denda_konfirmasi").text(formatNumbers($("#total_denda").data('hasil')));
				$("#total_bayar_konfirmasi").text(formatNumbers($("#total_bayar").data('hasil')));
				$("#total_tagihan").text(formatNumbers($("#total_bayar").data('hasil')));
				$("#total_tagihan").data("hasil",$("#total_bayar").data('hasil'));
				$("table#list-payment-data tbody").html(str);
				$("#modal-confirmation-split").modal('show');
			}
		}
	});
	var calculate_bayar = function(t_bayar){
		var t_tagihan = $("#total_tagihan").data("hasil");

		t_tagihan = Math.round(t_tagihan);
		t_bayar = Math.round(t_bayar);
		
		$("#total_kembalian").text(formatNumbers(parseInt(t_bayar) - parseInt(t_tagihan)));
	}
	$('body').on('keyup','input[name=total_bayar_tagihan]',function(){
		calculate_bayar($(this).val());
	});
	$('body').on('change','input[name=total_bayar_tagihan]',function(){
		calculate_bayar($(this).val());
	});
	$('body').on('click','button#btn_calculator_bayar',function(){
		$("tr#tr_calculator_bayar").hide();
		$("table#table_calculator_bayar").show();
	});
	$('body').on('click','button#do_bayar',function(){
		var total_bayar = $("input[name=total_bayar_tagihan]").val();
		if( parseInt(total_bayar) <= 0 ){
			return;
		}
		if(confirm("Apakah Anda akan melanjutkan ini?") == true ){
			// run for payment here
			Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/pembayaran/dobayar')?>", 'POST', {nop:p_nop,tahun:arrays_tahun,total_bayar:total_bayar,total_tagihan:total_tagihan},function(response){
				if(response.status == 'error'){
					//alert(response.msg);
				}else if( response.status == 'info' ){
					if( response.url){
						setInterval(function(){ window.location.href = response.url; }, 3000);
					}
					
				}else if(response.status == 'nop_berubah'){
					if( confirm("Ada Perubahan NOP Tanggal "+response.tanggal+"\nMenjadi "+response.nop) == true){
						$("input[name=nopform]").val(response.nop);
						$("tr#tr_calculator_bayar").hide();
						$("table#table_calculator_bayar").hide();
						$("table#list-payment-data tbody").html("");
						$("#modal-confirmation-split").modal('hide');
						search_nop(response.nop);
					}
				}
			})
		}
	});
})

</script>