<div id="element_char_10_kelurahan_realisasi_terbesar"></div>
<script>
  $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('maplaporan/kelurahanrealisasiterbesar/tahun/'.$tahun.'/limit/10')?>", 'POST', {},function(response){
          var yAx = [{ // Primary yAxis
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    title: {
                        text: 'Total Ketetapan & Realisasi',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Ketetapan',
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
                }, { // Secondary yAxis
                    title: {
                        text: 'Total Objek Pajak',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    labels: {
                        format: '{value}',
                        style: {
                            color: Highcharts.getOptions().colors[2]
                        }
                    },
                    min: 0,
                    opposite: true
                }];
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_char_10_kelurahan_realisasi_terbesar",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
  })
</script>
