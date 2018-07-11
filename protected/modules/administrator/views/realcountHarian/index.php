<section class="content-header">
    <h1>
        Real data
        <small>Harian</small>
    </h1>
    <!--ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol-->
</section>
<section class="content">
	 <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-stats-bars"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ketetapan & Objek Pajak</span>
              <span class="info-box-number" id="ketetapan_template">0</span>
			  <span class="info-box-number" id="objek_template">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bank"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Realisasi + Denda & Objek Pajak</span>
              <span class="info-box-number" id="realisasi_template">0</span>
			  <span class="info-box-number" id="realisasi_objek_pajak">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-hourglass-3"></i></span>

            <div class="info-box-content">
				<span class="info-box-text">Pembayaran Piutang & Denda</span>
				<span class="info-box-number" id="piutang_template">0</span>
				<span class="info-box-number" id="denda_template">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-pie-chart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Pembayaran & Objek Pajak</span>
              <span class="info-box-number" id="total_template">0</span>
			  <span class="info-box-number" id="all_ob_pajak">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
				<i class="fa fa-line-chart"></i>
              <h3 class="box-title">Data Perkecamatan</h3>
					<div class="box-tools">
						
                <div class="form-group" style="width:200px;">
                

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" value="<?=$c_date?>" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
                
              
					</div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6" id="element_chart_data">
					
                </div>
                <!-- /.col -->
                <div class="col-md-6" id="element_chart_data2">
					
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
			
			 <div class="box-body">
              <div class="row">
                <div class="col-md-12" id="element_chart_data3">
					
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
</section>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/highcharts/code/highcharts.js"></script>
 <script src="<?php echo Yii::app()->request->baseUrl; ?>/asset/js/maps.js"></script>
 <script>
  $(document).ready(function(){
       var auto_get_info = function($date){
		   Ajax.run("<?=Yii::app()->createAbsoluteUrl('administrator/realcountHarian/datamaps')?>", 'GET', {tanggal:$date},function(response){
			$("#ketetapan_template").text("Rp."+formatNumbers(response.ketetapan));
			$("span#objek_template").text(response.objek_pajak);
			$("span#realisasi_objek_pajak").text(response.total_objek_pajak);
			$("span#all_ob_pajak").text(response.total_objek_pajak + response.total_objek_pajak_piutang);
			$("#realisasi_template").text("Rp."+formatNumbers(response.pembayaran_pokok+response.pembayaran_denda));
			$("#piutang_template").text("Rp."+formatNumbers(response.piutang_pokok));
			$("#denda_template").text("Rp."+formatNumbers(response.piutang_denda));
			$("#total_template").text("Rp."+formatNumbers(response.piutang_denda + response.piutang_pokok + response.pembayaran_pokok+response.pembayaran_denda));
           var yAx = [{ // Primary yAxis
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    title: {
                        text: 'Total Ketetapan',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Total Objek Pajak',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    
                    opposite: true
                }];
		
			var _response = response.response;
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_chart_data",_response.categories,yAx,_response.series,_response.title,_response.subtitle,_response.text);
		  
		  var yAxRealisasi = [{ // Primary yAxis
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    title: {
                        text: 'Total Ketetapan',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Total Objek Pajak',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    
                    opposite: true
                }];
			var _response1 = response.realisasi;
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_chart_data2",_response1.categories,yAxRealisasi,_response1.series,_response1.title,_response1.subtitle,_response1.text);
		  
		   //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_chart_data",_response.categories,yAx,_response.series,_response.title,_response.subtitle,_response.text);
		  
		  var yAxRealisasi = [{ // Primary yAxis
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    title: {
                        text: 'Total Ketetapan',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Total Objek Pajak',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    
                    opposite: true
                }];
			var _response1 = response.pembayaran_piutang;
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_chart_data3",_response1.categories,yAxRealisasi,_response1.series,_response1.title,_response1.subtitle,_response1.text);
        });
	   }
	$('#datepicker').datepicker({
		autoclose: true
    });
	$('#datepicker').change(function(){
		var tanggal = $(this).val();
		if(tanggal != "" ){
			auto_get_info(tanggal);
		}
	});
	auto_get_info($('#datepicker').val());
	setInterval(function(){ auto_get_info($('#datepicker').val()); }, 680000);
  })
</script>