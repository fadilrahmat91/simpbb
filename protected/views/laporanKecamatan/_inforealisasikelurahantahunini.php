 <div id="element_char_realisasi_kelurahan"></div>
<script>
  $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('laporanKecamatan/realisasikelurahantahunini/tahun/'.$tahun.'/kecamatan/'.$kecamatan)?>", 'POST', {},function(response){
          var yAx = [{ // Primary yAxis
                    labels: {
                        format: '{value}',
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
					min: 0,
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
                }, { // Secondary yAxis
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
                    min: 0,
                    opposite: true
                }];
          //,$category,$yAxis,$series,$title,$subtitle,$text
          Maps.multyAxis("element_char_realisasi_kelurahan",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
        });
  })
</script>
