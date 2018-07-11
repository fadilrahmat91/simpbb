<!-- About -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">REALISASI</h2>
            <h3 class="section-subheading text-muted"><?=Yii::app()->report->tahun_mulai()?> - <?= Yii::app()->report->tahun_akhir()?></h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
              <div id="element_char_realisasi_tahunan"></div>
          </div>
        </div>
      </div>
    </section>

    <script>
      $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKelurahan/realisasitahunan/kecamatan/'.$kecamatan.'/kelurahan/'.$kelurahan)?>", 'POST', {},function(response){
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
                        text: 'Realisasi',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Denda',
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
				{ // Primary yAxis
                    labels: {
                        formatter: function () {
							return Maps.formatLabels(this.value);
						},
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    title: {
                        text: 'Piutang Realisasi',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
					opposite: true
                }, { // Secondary yAxis
                    title: {
                        text: 'Piutang Denda',
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
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_char_realisasi_tahunan",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
      })
    </script>
