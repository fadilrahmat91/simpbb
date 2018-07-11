<?php
/* @var $this TableKegiatanController */
/* @var $model TableKegiatan */
/* @var $form CActiveForm */
?>

<div class="form">
	<div class="box-body">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'data-form-daftar-op',
			'htmlOptions'=>array(
				
				'role'=>'form'
			),
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>
		<div class="row" style="position:relative">
			<div class="col-md-12" id="element_peta" style="height:400px;"></div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<?php echo $form->labelEx($model,'nop',array('class'=>'control-label')); ?>
					<?php echo $form->textField($model,'nop',array('class'=>'form-control','size'=>60,'maxlength'=>255,'data-inputmask'=> "'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']","data-mask"=>"")); ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<?php echo $form->labelEx($model,'lattitude',array('class'=>'control-label')); ?>
					<?php echo $form->textField($model,'lattitude',array('class'=>'form-control','size'=>60,'maxlength'=>255,'readonly'=>'readonly')); ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
				<?php echo $form->labelEx($model,'longitude',array('class'=>'control-label')); ?>
				<?php echo $form->textField($model,'longitude',array('class'=>'form-control','size'=>60,'maxlength'=>255,'readonly'=>'readonly')); ?>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<?php echo CHtml::submitButton('Simpan',array('id'=>'simpandata','class'=>'btn btn-primary','name'=>'simpanmenu')); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script src="//maps.googleapis.com/maps/api/js?key=<?=Yii::app()->params['mapApiKey']?>"></script>
<script>
$("document").ready(function(){
	$('[data-mask]').inputmask();
	var peta;
	var marker;
	function geocodePosition(lat,lng){
		console.log(lat+"-"+lng);
		$("input#ObjekPajakForm_lattitude").val(lat);
		$("input#ObjekPajakForm_longitude").val(lng);
	}
	function load_map(){ //2°57'56.3"N 98°51'43.6"E
		var simalungun = new google.maps.LatLng(2.96523716, 98.861902571);
		var petaoption = {
			zoom: 18,
			center: simalungun,
			mapTypeId: google.maps.MapTypeId.HYBRID,//google.maps.MapTypeId.ROADMAP,
			
		};

		peta = new google.maps.Map(document.getElementById("element_peta"),petaoption);
		marker = new google.maps.Marker({
			position: simalungun,
			map: peta,
			draggable: true,
			animation: google.maps.Animation.DROP,

		});
		google.maps.event.addListener(marker, 'dragend', function () {
			console.log(this.getPosition().lat());
			peta.setCenter(this.getPosition()); // Set map center to marker position
			//updatePosition(this.getPosition().lat(), this.getPosition().lng()); // update position display
			$("input#ObjekPajakForm_lattitude").val(this.getPosition().lat());
			$("input#ObjekPajakForm_longitude").val(this.getPosition().lng());
		});

		google.maps.event.addListener(peta, 'drag', function () {
			marker.setPosition(this.getCenter()); // set marker position to map center
			//updatePosition(this.getCenter().lat(), this.getCenter().lng()); // update position display
			$("input#ObjekPajakForm_lattitude").val(this.getCenter().lat());
			$("input#ObjekPajakForm_longitude").val(this.getCenter().lng());
		});
		
		/*google.maps.event.addListener(peta, 'dragend', function () {
			console.log(this.getPosition().lat());
			marker.setPosition(this.getCenter()); // set marker position to map center
			updatePosition(this.getCenter().lat(), this.getCenter().lng()); // update position display
		});*/

		function updatePosition(lat, lng) {
			//document.getElementById('dragStatus').innerHTML = '<p> Current Lat: ' + lat.toFixed(4) + ' Current Lng: ' + lng.toFixed(4) + '</p>';
		}
	}
	load_map();
	$("form#data-form-daftar-op").submit(function(){
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/penambahanLokasi/create')?>", 'POST', $(this).serialize(),function(response){
			if( response.status == "info"){
				$("input#ObjekPajakForm_nop").val(response.NOP);
				$("input#ObjekPajakForm_lattitude").val("");
				$("input#ObjekPajakForm_longitude").val("");
			}
		});
		return false;
	});
	$("input[name=pencariantype]").click(function(){
		var v = $(this).val();
		if( v == 'lokasi'){
			$("div#cari-berdasarkan-lokasi").show();
			$("div#cari-berdasarkan-nop").hide();
		}else{
			$("div#cari-berdasarkan-lokasi").hide();
			$("div#cari-berdasarkan-nop").show();
		}
	});
	$("form#search-form-lokasi").submit(function(){
		var v = $("input[name=pencariantype]:checked").val();
		console.log(v);
		if( v == 'lokasi' ){
			var lat = $("input#ObjekPajakForm_pencarian_lat").val();
			var lng = $("input#ObjekPajakForm_pencarian_lng").val();
			if( lat != "" && lng != "" ){
				var pencarian = new google.maps.LatLng(lat, lng);
				//var latlng = new google.maps.LatLng(-24.397, 140.644);
				marker.setPosition(pencarian);
				peta.setCenter(pencarian);
				$("input#ObjekPajakForm_lattitude").val(lat);
				$("input#ObjekPajakForm_longitude").val(lng);
			}
		}else{
			var nop = $("input#ObjekPajakForm_pencarian_nop").val();
			Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/penambahanLokasi/create')?>", 'POST', {noppencarian:nop},function(response){
			if( response.status == "info"){
				var hasilLatLng = new google.maps.LatLng(response.LATTITUDE, response.LONGITUDE);
				//var latlng = new google.maps.LatLng(-24.397, 140.644);
				marker.setPosition(hasilLatLng);
				peta.setCenter(hasilLatLng);
				
				$("input#ObjekPajakForm_nop").val(response.NOP);
				$("input#ObjekPajakForm_lattitude").val(response.LATTITUDE);
				$("input#ObjekPajakForm_longitude").val(response.LONGITUDE);
			}
		});
		}
		return false;
	});
});
</script>