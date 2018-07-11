<section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">INFORMASI PBB <?php echo $tahun?></h2>
            <h3 class="section-subheading text-muted">Data PBB untuk tahun <?php echo $tahun?>.</h3>
          </div>
        </div>
        <div class="row text-center">
          
		   <div class="col-md-4">
			<div class="element-div-info yellow-themes">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-bar-chart fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading" style="color: #4e974f !important">KETETAPAN</h4>
			<table class="table table-info-chart">
				<tbody>
					<tr>
						<td style="text-align:left">Total</td>
						<td  colspan="2" style="text-align:right">
							 <span class="badge badge-success badge-pill"><?php 
                        $datalaporanketetapantahun = TotalTargetPajakKabupaten::getlaporanketetapantahun($tahun);
                        $hasillaporanketetapantahun = $datalaporanketetapantahun[0]['ketetapan'];
                        echo "Rp. ".number_format($hasillaporanketetapantahun);
                      ?> 
					  </span>
						</td>
					</tr>
					<tr>
						<td style="text-align:left">Objek Pajak</td>
						<td  colspan="2" style="text-align:right">
						<span class="badge badge-success badge-pill">
						<?php 
                       
                        
                        $datalaporanobjekpajaktahun = TotalTargetPajakKabupaten::getlaporanobjekpajaktahun($tahun);
                        $hasillaporanobjekpajaktahun = $datalaporanobjekpajaktahun[0]['objekpajak'];
                        echo number_format($hasillaporanobjekpajaktahun);
                      ?>
                      </span>
					  </td>
					</tr>
				</tbody>
			</table>
            
          </div>
		  </div>
          <div class="col-md-4">
			<div class="element-div-info blue-themes">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary" ></i>
              <i class="fa fa-hourglass-3 fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading" style="color:#fff !important;">REALISASI</h4>
			<table class="table table-info-chart">
				<tbody>
					<tr>
						<td style="text-align:left">Total Realisasi</td>
						<td style="text-align:right"><?php 
                        $datalaporanrealisasitahun = TotalRealisasiPajakKabupaten::getlaporanrealisasitahun($tahun);
                        $hasillaporanrealisasitahun = $datalaporanrealisasitahun[0]['realisasitahun'];
                        echo "Rp. ".number_format($hasillaporanrealisasitahun);
                      ?> </td>
					  <td style="text-align:right">
						 <span class="badge badge-danger badge-pill"><?php 
                        $datapersentaseketetapanrealisasi = ($hasillaporanrealisasitahun/$hasillaporanketetapantahun)*100;
                        echo number_format($datapersentaseketetapanrealisasi,2)." %";
                      ?> 
					  </span>
					  </td>
					</tr>
					<tr>
						<td style="text-align:left">Objek Pajak</td>
						<td style="text-align:right">
							<b><?php 
                        $datalaporanrealisasiobjekpajaktahun = TotalRealisasiPajakKabupaten::getlaporanrealisasiobjekpajaktahun($tahun);
                        $hasillaporanrealisasiobjekpajaktahun = $datalaporanrealisasiobjekpajaktahun[0]['objekpajak'];
                        echo number_format($hasillaporanrealisasiobjekpajaktahun);
                      ?>  </b>
						</td>
						<td style="text-align:right">
						<span class="badge badge-danger badge-pill">
						
							 <?php 
                        $datapersentaseketetapanrealisasiobjek = ($hasillaporanrealisasiobjekpajaktahun/$hasillaporanobjekpajaktahun)*100;
                        echo number_format($datapersentaseketetapanrealisasiobjek,2)." %";
                      ?> 
					  </span>
						</td>
					</tr>
					<tr>
						<td style="text-align:left;background-color:#dff0d8;">Pembayaran Piutang</td>
						<td colspan="2" style="text-align:right;background-color:#dff0d8;">
							<span class="badge badge-success badge-pill"><?php 
                        $datalaporanrealisasiPPtahun = TotalRealisasiPajakKabupaten::getlaporanrealisasiPPtahun($tahun);
                        $hasillaporanrealisasiPPtahun = $datalaporanrealisasiPPtahun[0]['pp'];

                        $datalaporanrealisasiPDtahun = TotalRealisasiPajakKabupaten::getlaporanrealisasiPDtahun($tahun);
                        $hasillaporanrealisasiPDtahun = $datalaporanrealisasiPDtahun[0]['pd'];

                        echo "Rp. ".number_format($hasillaporanrealisasiPPtahun + $hasillaporanrealisasiPDtahun);
                      ?> 
							</span>
						</td>
					</tr>
				</tbody>
			</table>
            
          </div>
		  </div>
		  <div class="col-md-4">
			<div class="element-div-info yellow-themes">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x " style="color:#4e974f !important;"></i>
              <i class="fa fa-bank fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading" style="color: #4e974f !important">BUMI & BANGUNAN</h4>
			<table class="table table-info-chart">
				<tbody>
					<tr>
						<td style="text-align:left">Luas Bumi</td>
						<td  style="text-align:right">
						<span class="badge badge-success badge-pill">
						<?php 
                        $datalaporanbumitahun = TotalTargetPajakKabupaten::getlaporanbumitahun($tahun);
                        $hasillaporanbumitahun = $datalaporanbumitahun[0]['ketetapanbumi'];
                        echo number_format($hasillaporanbumitahun);
                      ?> </span></td>
					</tr>
					<tr>
						<td style="text-align:left;">Luas Bangunan</td>
						<td   style="text-align:right;">
						<span class="badge badge-success badge-pill">
						<?php 
                       
                        $datalaporanbangunantahun = TotalTargetPajakKabupaten::getlaporanbangunantahun($tahun);
                        $hasillaporanbangunantahun = $datalaporanbangunantahun[0]['ketetapanbangunan'];
                        echo number_format($hasillaporanbangunantahun);
                      
                      ?> </span></td>
					</tr>
				</tbody>
			</table>
            
          </div>
		  </div>
          
        </div>
      </div>
    </section>
<style>
div.element-div-info{
	border:1px solid rgba(0,0,0,.125);
	
}
div.blue-themes{
	background-color:#468847;
}
div.yellow-themes{
	background-color:#fff;
	
}
table.table-info-chart tbody tr > td{
	padding-left:5px !important;
	padding-right:5px !important;
}
table.table-info-chart tbody tr:last-child  > td{
	
}
table.table-info-chart{
	background-color: #fff;
	margin-bottom: 0px;
}
</style>