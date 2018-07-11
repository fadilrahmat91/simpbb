
    <!-- Team -->
    <!--section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">KETETAPAN DAN OBJEK PAJAK KECAMATAN</h2>
            <h3 class="section-subheading text-muted">Informasi Realisasi dan Denda Kecamatan.</h3>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="element_char_realisasi_kecamatan"></div>
            </div>
        </div>
      </div>
    </section-->
 <div id="element_char_realisasi_kecamatan"></div>
<script>
  $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('maplaporan/realisasitahunini/tahun/'.$tahun)?>", 'POST', {},function(response){
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
                        text: 'Total Realisasi',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Total Denda',
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
                },
				{ // Secondary yAxis
                    title: {
                        text: 'Realisasi Piutang',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    labels: {
                        formatter: function () {
							return Maps.formatLabels(this.value);
						},
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    opposite: true
                },
				{ // Secondary yAxis
                    title: {
                        text: 'Realisasi Piutang Denda',
                        style: {
                            color: Highcharts.getOptions().colors[3]
                        }
                    },
                    labels: {
                        formatter: function () {
							return Maps.formatLabels(this.value);
						},
                        style: {
                            color: Highcharts.getOptions().colors[3]
                        }
                    },
                    opposite: true
                }];
          
          Maps.multyAxis("element_char_realisasi_kecamatan",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
  })
</script>
