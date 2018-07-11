
    <!-- Team -->
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">KETETAPAN</h2>
            <h3 class="section-subheading text-muted"><?=Yii::app()->report->tahun_mulai()?> - <?= Yii::app()->report->tahun_akhir()?></h3>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="element_char_perubahan_ketetapan"></div>
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
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKelurahan/perubahanketetapan/kecamatan/'.$kecamatan.'/kelurahan/'.$kelurahan)?>", 'POST', {},function(response){
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
                    min: 0,
                    opposite: true
                }];
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_char_perubahan_ketetapan",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
        /*Ajax.run("<?=Yii::app()->createAbsoluteUrl('maplaporan/perubahanketetapan')?>", 'POST', {},function(response){
            //console.log(response.series);
            var tooltip = {
              headerFormat: '<span style="font-size:10px">Tahun : {point.key}</span><table>',
              pointFormat: '<tr><td style="padding:0"></td>' +
                  '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
            }
            Maps.oneChart("areaspline","element_char_perubahan_ketetapan",response.categories,response.series,response.title,response.subtitle,response.text,tooltip);
        })*/

  })
</script>
