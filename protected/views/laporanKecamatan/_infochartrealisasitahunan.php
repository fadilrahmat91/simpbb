 <div id="element_char_realisasi_tahunan"></div>
    <script>
      $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKecamatan/realisasitahunan/kecamatan/'.$kecamatan)?>", 'POST', {},function(response){
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
