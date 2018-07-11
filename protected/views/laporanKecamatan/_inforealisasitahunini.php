
    <!-- Team -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <!--h2 class="section-heading text-uppercase">KETETAPAN DAN OBJEK PAJAK KECAMATAN</h2-->
            <h3 class="section-subheading text-muted">Informasi Realisasi dan Denda Kecamatan.</h3>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="element_char_realisasi_kecamatan"></div>
            </div>
        </div>
        <!--div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
          </div>
        </div-->
      </div>
    </section>
<script>
  $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('maplaporan/realisasitahunini/tahun/'.$tahun)?>", 'POST', {},function(response){
          var yAx = [{ // Primary yAxis
                    labels: {
                        format: '{value}',
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
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    min: 0,
                    opposite: true
                }];
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_char_realisasi_kecamatan",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
  })
</script>
