
    <!-- Team -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">KELURAHAN</h2>
            <h3 class="section-subheading text-muted">10 Kelurahan Terbaik.</h3>
          </div>
        </div>
        <div class="row">
            
			 <div class="col-lg-12">
                <div id="element_char_realisasi_persentase_kelurahan"></div>
            </div>
			<div class="col-lg-12"><hr></div>
			<div class="col-lg-12">
				<?php $this->renderPartial('_info10kelurahanketetapanterbesar',['tahun'=>$tahun]); ?>
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
       
		Ajax.run("<?=Yii::app()->createAbsoluteUrl('maplaporan/realisasipersentaseKelurahantahunini/tahun/'.$tahun.'/limit/10')?>", 'POST', {},function(response){
          var yAx = [{ // Primary yAxis
                    labels: {
                        format: '{value}%',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    title: {
                        text: 'Persentase (%)',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                }, { // Secondary yAxis
                    title: {
                        text: 'Ketetapan',
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
                },{ // Secondary yAxis
                    title: {
                        text: 'Realisasi',
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
                }];
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_char_realisasi_persentase_kelurahan",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
  })
</script>
