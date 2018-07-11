
<section class="content" style="padding-top:0px;padding-bottom:0px;">
	<!-- Info boxes -->
    <div class="row">
		<div class="box-body" style="padding-top:0px;padding-bottom:0px;">
			<div class="row" style="position:relative">
				<div class="col-md-12" id="element_peta" style="height:680px;"></div>
				<div class="search-element" style="width:301px">
					<div class="input-group input-group-lg">
						<input type="text" name="nopform" style="width:250px" class="form-control" data-inputmask="'mask': ['99.99.999.999.999-9999.9', '99 99 999 999 999 9999 9']" data-mask>
						<span class="input-group-btn">
						  <button id="search-nop" type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		 <!--div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  
                </div>
                
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  
                </div>
                
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  
                </div>
                
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  
                </div>
              </div>
              <!-- /.row -->
            </div>
    </div>
</section>
<script src="//maps.googleapis.com/maps/api/js?key=<?=Yii::app()->params['mapApiKey']?>"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/maps/geoxml3.js"></script>
<script>
  $(document).ready(function(){
	$('[data-mask]').inputmask();
	var peta;
	var marker;
	var markers = [];
	var mapStyle = [
					  {
						featureType: "administrative",
						elementType: "labels",
						stylers: [
						  { visibility: "off" }
						]
					  },{
						featureType: "water",
						elementType: "labels",
						stylers: [
						  { visibility: "off" }
						]
					  },{
						featureType: "road",
						elementType: "labels",
						stylers: [
						  { visibility: "off" }
						]
					  }
					];
	
	function infoWindowsmaps(infowindow, peta, marker, $data){
		//d[i].NOP,d[i].KOTA_WP,d[i].KELURAHAN_WP,d[i].RT_WP+'/'+d[i].RW_WP,d[i].JALAN_OP
		/**/
			Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/petaSimalungun/getInfo')?>", 'GET', {nop:$data.NOP},function(response){
				var data =  '<div id="content">'+
					'<div id="siteNotice">'+
					'</div>'+
					'<h1 id="firstHeading" class="firstHeading">'+$data.NOP+' &nbsp; <span class="badge bg-red pull-right">'+response.data.KD_ZNT+'</span></h1>'+
					'<div id="bodyContent">'+
					'<p>'+
						'<table class="table table-striped "> '+
						'<tbody> '+
							'<tr> '+
								'<td class="bg-info"> NAMA</td> <td> '+response.data.NM_WP+'</td>'+
								'<td class="bg-success"> RT/RW O.P</td> <td> '+$data.RT_OP+'/'+$data.RW_OP+'</td>'+
							'</tr> '+
							'<tr> '+
								'<td class="bg-info"> KOTA</td> <td> '+response.data.KOTA_WP+'</td>'+
								'<td class="bg-success"> JALAN O.P</td> <td> '+$data.JALAN_OP+'</td>'+
							'</tr> '+
							'<tr> '+
								'<td class="bg-info"> KELURAHAN</td> <td> '+response.data.KELURAHAN_WP+'</td>'+
								'<td class="bg-success"> LUAS BUMI</td> <td> '+$data.TOTAL_LUAS_BUMI+' &nbsp; <span class="badge bg-light-blue pull-right">NJOP : '+formatNumbers(response.data.NJOP_BUMI)+'</span></td>'+
							'</tr> '+
							'<tr> '+
								'<td class="bg-info"> RT/RW</td> <td> '+response.data.RT_WP+'/'+response.data.RW_WP+'</td>'+
								'<td class="bg-success"> LUAS BANGUNAN</td> <td> '+$data.TOTAL_LUAS_BNG+' &nbsp; <span class="badge bg-light-blue pull-right">NJOP : '+formatNumbers(response.data.NJOP_BNG)+'</span></td>'+
							'</tr> '+
							'<tr> '+
								'<td class="bg-info"> JALAN</td> <td> '+$data.JALAN_OP+'</td>'+
								'<td class="bg-success"> LAT,LNG</td> <td> '+$data.LATTITUDE+','+$data.LONGITUDE+'</td>'+
							'</tr> '+
						'</tbody> '+
						'</table> '+
					'</p>'+
					'</div>'+
					'</div>';
				infowindow.setContent(data);
								
				infowindow.open(peta,marker);
			});
			

	}
	function load_map(){
		var simalungun = new google.maps.LatLng(2.96523716, 98.861902571);
		var petaoption = {
			zoom: 13,
			center: simalungun,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		peta = new google.maps.Map(document.getElementById("element_peta"),petaoption);
		peta.set('styles', mapStyle);
		/** disini kita panggil function dari geoXML3 untuk memparsing file kml */
		var geoXml = new geoXML3.parser({map: peta});
		/** letak file kml */
		geoXml.parse("<?php echo Yii::app()->request->baseUrl; ?>/asset/maps/simalungun.kml");
		google.maps.event.addListener(peta,'click',function(event){
			kasihtanda(event.latLng);
		});
		

		/*peta.addListener('center_changed', function() {
          // 3 seconds after the center of the map has changed, pan back to the
          // marker.
          window.setTimeout(function() {
            peta.panTo(marker.getPosition());
          }, 3000);
        });*/
	}
	function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

	function go_load($params){
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/petaSimalungun/getData')?>", 'GET', $params,function(response){
			if(response.status == 'ok'){
				var d = response.data;
				var prev_infowindow = false; 
				setMapOnAll(null);
				if(parseInt(response.jumdata) > 0 ){
					Ajax.show_alert("info","ditemukan sebanyak "+response.jumdata+" data");
					$(d).each(function(i){
						var lat = d[i].LATTITUDE;
						var log = d[i].LONGITUDE;
						var mymarker = new google.maps.LatLng(lat,log);
						window.setTimeout(function() {
						  marker = new google.maps.Marker({
							position: mymarker,
							map: peta,
							animation: google.maps.Animation.DROP,
						});
						
						
						if(parseInt(response.jumdata) == 1 ){
							var hasilLatLng = new google.maps.LatLng(response.data[0].LATTITUDE, response.data[0].LONGITUDE);
							//var latlng = new google.maps.LatLng(-24.397, 140.644);
							marker.setPosition(hasilLatLng);
							peta.setCenter(hasilLatLng);
							peta.setZoom(18);
							peta.setMapTypeId('satellite');
						}else{
							//var hasilLatLng = new google.maps.LatLng(response.data[0].LATTITUDE, response.data[0].LONGITUDE);
							//var latlng = new google.maps.LatLng(-24.397, 140.644);
							//marker.setPosition(hasilLatLng);
							//peta.setCenter(hasilLatLng);
							peta.setZoom(10);
							peta.setMapTypeId(google.maps.MapTypeId.ROADMAP);
						}
						
						markers.push(marker);
						var infowindow = new google.maps.InfoWindow();
						var content;
						google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
							
						return function() {
							if( prev_infowindow ) {
							   prev_infowindow.close();
							}
							prev_infowindow = infowindow;
							infoWindowsmaps(infowindow,peta,marker,d[i]);
						};
					})(marker,content,infowindow)); 
						}, i * 100);
					});
					
				}else{
					Ajax.show_alert("error","Tidak ada data ditemukan");
				}
			}
		});
	}
	go_load({});
	load_map();
	
	
	$("button#search-nop").click(function(){
		var nop = $("input[name=nopform]").val();
		go_load({nop:nop});
	});
  })
</script>
<style>
.search-element{
	position: absolute;
	right: 13px;
	top: 6px;
}
</style>