
    <!-- Team -->
    <section  class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">REALISASI</h2>
            <h3 class="section-subheading text-muted">Data Realisasi Pajak & Retribusi <?=$tahun?>.</h3>
          </div>
        </div>
        <div class="row">
			<div class="col-lg-7">
                <div id="realisasi_pajak"></div>
            </div>
			<div class="col-lg-5">
                <div id="realisasi_retribusi"></div>
            </div>
			
        </div>
        
      </div>
    </section>
<script>
$("document").ready(function(){
	var chartSerialize = function(response){
		return [{ // Secondary yAxis
				title: {
					text: 'Jumlah Bayar',
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
			},
			{ // Secondary yAxis
				title: {
					text: 'Jumlah Denda & Sanksi Administrasi',
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
			},
			{ // Primary yAxis
				labels: {
					format: '{value}%',
					style: {
						color: Highcharts.getOptions().colors[3]
					}
				},
				title: {
					text: 'Persentase(%)',
					style: {
						color: Highcharts.getOptions().colors[3]
					}
				},
				min: 0,
				opposite: true
			}];
	}
	Ajax.run("<?=Yii::app()->createAbsoluteUrl('pajakLainnyaKecamatan/realisasiPajak/tahun/'.$tahun.'/kecamatan/'.$kecamatan)?>", 'GET', {},function(response){
		var yAx = chartSerialize(response);
		Maps.stackMultyAxis("realisasi_pajak","column",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
	});
	Ajax.run("<?=Yii::app()->createAbsoluteUrl('pajakLainnyaKecamatan/realisasiRetribusi/tahun/'.$tahun.'/kecamatan/'.$kecamatan)?>", 'GET', {},function(response){
		var yAx = chartSerialize(response);
		Maps.stackMultyAxis("realisasi_retribusi","column",response.categories,yAx,response.series,response.title,response.subtitle,response.text);
	});
});
</script>