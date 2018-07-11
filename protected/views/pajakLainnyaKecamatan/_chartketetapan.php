
    <!-- Team -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">KETETAPAn</h2>
            <h3 class="section-subheading text-muted">Data Ketetapan Pajak & Retribusi <?=$tahun?>.</h3>
          </div>
        </div>
        <div class="row">
			<div class="col-lg-7">
                <div id="ketetapan_pajak"></div>
            </div>
			<div class="col-lg-5">
                <div id="ketetapan_retribusi"></div>
            </div>
        </div>
        
      </div>
    </section>
<script>
$("document").ready(function(){
	var chartSerialize = function(response){
		return [{ // Secondary yAxis
				title: {
					text: 'Ketetapan',
					style: {
						color: Highcharts.getOptions().colors[0]
					}
				},
				labels: {
					formatter: function () {
						return Maps.formatLabels(this.value);
					},
					style: {
						color: Highcharts.getOptions().colors[0]
					}
				},
				min: 0
			},{ // Secondary yAxis
				title: {
					text: 'Sanksi Administrasi',
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
					text: 'Total Objek',
					style: {
						color: Highcharts.getOptions().colors[2]
					}
				},
				min: 0,
				opposite: true
			}];
	}
	Ajax.run("<?=Yii::app()->createAbsoluteUrl('pajakLainnyaKecamatan/ketetapanPajak/tahun/'.$tahun.'/kecamatan/'.$kecamatan)?>", 'GET', {},function(response){
		var yAx = chartSerialize(response);
		Maps.multyAxis("ketetapan_pajak",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
	});
	Ajax.run("<?=Yii::app()->createAbsoluteUrl('pajakLainnyaKecamatan/ketetapanRetribusi/tahun/'.$tahun.'/kecamatan/'.$kecamatan)?>", 'GET', {},function(response){
		var yAx = chartSerialize(response);
		Maps.multyAxis("ketetapan_retribusi",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
	});
});
</script>