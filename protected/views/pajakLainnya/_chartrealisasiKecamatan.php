
    <!-- Team -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">REALISASI KECAMATAN</h2>
            <h3 class="section-subheading text-muted">Data Realisasi Pajak & Retribusi <?=$tahun?>.</h3>
          </div>
        </div>
        <div class="row">
			<div class="col-lg-12">
                <div id="realisasi_kecamatan_pajak"></div>
            </div>
			<div class="col-lg-12">
                <hr>
            </div>
			<div class="col-lg-12">
                <div id="realisasi_kecamatan_retribusi"></div>
            </div>
        </div>
        
      </div>
    </section>
<script>
$("document").ready(function(){
	var chartSerialize = function(response,$color){
		return [{ // Secondary yAxis
				title: {
					text: 'Realisasi + Sanksi Administrasi & Denda',
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
				}
			},
			{ // Primary yAxis
				labels: {
					formatter: function () {
						return Maps.formatLabels(this.value);
					},
					style: {
						color: Highcharts.getOptions().colors[$color]
					}
				},
				title: {
					text: 'Total Objek',
					style: {
						color: Highcharts.getOptions().colors[$color]
					}
				},
				min: 0,
				opposite: true
			},
			{ // Primary yAxis
				labels: {
					format:'{value}%',
					style: {
						color: Highcharts.getOptions().colors[$color+1]
					}
				},
				title: {
					text: 'Persentase(%)',
					style: {
						color: Highcharts.getOptions().colors[$color+1]
					}
				},
				min: 0,
				opposite: true
			}];
	}
	Ajax.run("<?=Yii::app()->createAbsoluteUrl('pajakLainnya/realisasiPajakKecamatan/tahun/'.$tahun)?>", 'GET', {},function(response){
		var yAx = chartSerialize(response,6);
		Maps.multyAxis("realisasi_kecamatan_pajak",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
	});
	Ajax.run("<?=Yii::app()->createAbsoluteUrl('pajakLainnya/realisasiRetribusiKecamatan/tahun/'.$tahun)?>", 'GET', {},function(response){
		var yAx = chartSerialize(response,3);
		Maps.multyAxis("realisasi_kecamatan_retribusi",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
	});
});
</script>