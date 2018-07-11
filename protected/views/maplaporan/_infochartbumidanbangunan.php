 <div id="element_char_luas_bumi_bangunan"></div>
<script>
  $(document).ready(function(){
        Ajax.run("<?=Yii::app()->createAbsoluteUrl('maplaporan/luasbumidanbangunan')?>", 'POST', {},function(response){
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
                        text: 'Bumi',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: 'Bangunan',
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
          Maps.multyAxis("element_char_luas_bumi_bangunan",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
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
