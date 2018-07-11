Maps = {
  oneChart : function($type,$lement,$category,$series,$title,$subtitle,$text,$tooltip){
    Highcharts.chart($lement, {
        chart: {
            type: $type //'areaspline'
        },
		
        title: {
            text: $title
        },
        subtitle: {
            text: $subtitle
        },
        xAxis: {
            categories: $category,
            crosshair: true
        },
        credits: {
          enabled: false
        },
        yAxis: {
            min: 0,
            title: {
                text: $text
            },
			labels: {
				formatter: function () {
					return this.value / 1000000 + 'MM';
				}
			},
        },
        tooltip: $tooltip,
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: $series
    });
  },
  multyAxis:function($lement,$category,$yAxis,$series,$title,$subtitle,$text){

      Highcharts.chart($lement, {
        chart: {
            zoomType: 'x'
        },
        title: {
            text: $title
        },
        credits: {
          enabled: false
        },
        subtitle: {
            text: $subtitle
        },
        xAxis: [{
            categories: $category,
            crosshair: true
        }],
        yAxis: $yAxis,
        tooltip: {
            shared: true
        },

        series: $series
      });
  },
  stackMultyAxis:function($lement,$type,$category,$yAxis,$series,$title,$subtitle,$text){

      Highcharts.chart($lement, {
        chart: {
            zoomType: 'x',
			type: $type //'areaspline'
        },
        title: {
            text: $title
        },
        credits: {
          enabled: false
        },
        subtitle: {
            text: $subtitle
        },
        xAxis: [{
            categories: $category,
            crosshair: true
        }],
        yAxis: $yAxis,
        tooltip: {
            shared: true
        },
		plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
        series: $series
      });
  },
  formatLabels:function(value){
	if (value >= 1E6) {
		return (value / 1000000).toFixed(2) + 'M';
	}
	return value / 1000 + 'k';
  }
}
