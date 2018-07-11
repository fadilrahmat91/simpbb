<div id="element_char_10_kelurahan_ketetapan_terbesar"></div>
<script>
  $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('maplaporan/kelurahanketetapanterbesar/tahun/'.$tahun.'/limit/10')?>", 'POST', {},function(response){
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
                        text: 'Total Realisasi',
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
                    min: 0,
                    opposite: true
                }, { // Secondary yAxis
                    title: {
                        text: 'Persentase(%)',
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
          Maps.multyAxis("element_char_10_kelurahan_ketetapan_terbesar",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
  })
</script>
