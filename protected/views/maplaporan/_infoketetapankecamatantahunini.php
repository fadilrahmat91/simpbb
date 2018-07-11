<!-- Team -->
<!--section class="bg-light">
  <div class="container">
	<div class="row">
	  <div class="col-lg-12 text-center">
		<h2 class="section-heading text-uppercase">KETETAPAN DAN OBJEK PAJAK KECAMATAN</h2>
		<h3 class="section-subheading text-muted">Informasi Ketetapan Dan Objek Pajak KECAMATAN.</h3>
	  </div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div id="element_char_perubahan_ketetapan_kecamatan"></div>
		</div>
	</div>
	
  </div>
</section-->
<div id="element_char_perubahan_ketetapan_kecamatan"></div>
<script>
  $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('maplaporan/ketetapankecamatan/tahun/'.$tahun)?>", 'POST', {},function(response){
          var yAx = [{ // Primary yAxis
                    labels: {
                        formatter: function () {
							return Maps.formatLabels(this.value);
						},
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
                        formatter: function () {
							return Maps.formatLabels(this.value);
						},
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    
                    opposite: true
                }];
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_char_perubahan_ketetapan_kecamatan",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
  })
</script>
