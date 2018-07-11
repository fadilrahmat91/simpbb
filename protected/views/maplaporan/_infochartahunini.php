<section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">INFORMASI PBB <?php echo $tahun?></h2>
            <h3 class="section-subheading text-muted">Data PBB untuk tahun <?php echo $tahun?>.</h3>
          </div>
        </div>
        <div class="row text-center owl-carousel owl-theme">
          <div class="item">
			<div class="border-light-grey" style="background: #e2e9bb;">
				<span class="fa-stack fa-4x">
				  <i class="fa fa-circle fa-stack-2x text-primary"></i>
				  <i class="fa fa-bar-chart fa-stack-1x fa-inverse"></i>
				</span>
				<h4 class="service-heading">KETETAPAN</h4>
				<div class="list-group box-profile">
				  <ul class="list-group">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Total
						<span class="badge badge-success badge-pill">
						  <?php 
							$datalaporanketetapantahun = TotalTargetPajakKabupaten::getlaporanketetapantahun($tahun);
							$hasillaporanketetapantahun = $datalaporanketetapantahun[0]['ketetapan'];
							echo "Rp. ".number_format($hasillaporanketetapantahun);
						  ?>  
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Objek Pajak
						<span class="badge badge-success badge-pill">
						  <?php 
							$datalaporanobjekpajaktahun = TotalTargetPajakKabupaten::getlaporanobjekpajaktahun($tahun);
							$hasillaporanobjekpajaktahun = $datalaporanobjekpajaktahun[0]['objekpajak'];
							echo number_format($hasillaporanobjekpajaktahun);
						  ?>  
						</span>
					  </li>
				  </ul>
				</div>
			</div>
            
          </div>
          <div class="item">
			<div class="border-light-grey" style="background: #e2e9bb;">
				<span class="fa-stack fa-4x">
				  <i class="fa fa-circle fa-stack-2x text-primary"></i>
				  <i class="fa fa-hourglass-3 fa-stack-1x fa-inverse"></i>
				</span>
				
				<h4 class="service-heading">REALISASI</h4>
				<?php $pembayaranRealisasi= TotalPembayaranPiutang::getRealisasiInfo($tahun)?>
				<?php $realisasi = $pembayaranRealisasi[0]['pembayaran_pokok'];?>
				<?php $denda = $pembayaranRealisasi[0]['pembayaran_denda'];?>
				<?php $total_objek = $pembayaranRealisasi[0]['total_objek'];?>
				<div class="list-group box-profile">
				  <ul class="list-group">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Total Realisasi
						<span class="badge badge-success badge-pill" style="position:relative">
						  <?= "Rp. ".number_format($realisasi);?> <span class="badge badge-danger badge-pill persen-right">(<?php 
							$datapersentaseketetapanrealisasi = ($realisasi/$hasillaporanketetapantahun)*100;
							echo number_format($datapersentaseketetapanrealisasi,2)."%";
						  ?>)</span>
						</span>
						
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Pembayaran Denda
						<span class="badge badge-success badge-pill">
						  <?php 
							echo "Rp. ".number_format($denda);
						  ?> 
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Objek Pajak
						<span class="badge badge-success badge-pill" style="position:relative">
						  <?php 
							echo number_format($total_objek);
						  ?>  
						  <span class="badge badge-danger badge-pill persen-right">(
						  <?= number_format(($total_objek/$hasillaporanobjekpajaktahun)*100,2)."%";?>)
						</span>
						</span>
					  </li>
					  <?php $datalaporan_piutang = TotalPembayaranPiutang::getlaporanpiutang($tahun); ?>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Pembayaran Piutang
						<span class="badge badge-success badge-pill">
						  <?= "Rp. ".number_format($datalaporan_piutang[0]['pembayaran_pokok']); ?>  
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Piutang Denda
						<span class="badge badge-success badge-pill">
						  <?= "Rp. ".number_format($datalaporan_piutang[0]['pembayaran_denda']); ?>  
						</span>
					  </li>
				  </ul>
				</div>
			</div>
            
          </div>
          <div class="item">
			<div class="border-light-grey" style="background: #e2e9bb;">
				<span class="fa-stack fa-4x">
				  <i class="fa fa-circle fa-stack-2x text-primary"></i>
				  <i class="fa fa-bank fa-stack-1x fa-inverse"></i>
				</span>
				<h4 class="service-heading">BUMI & BANGUNAN</h4>
				<div class="list-group box-profile">
				  <ul class="list-group">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Luas Bumi
						<span class="badge badge-success badge-pill">
						  <?php 
							$datalaporanbumitahun = TotalTargetPajakKabupaten::getlaporanbumitahun($tahun);
							$hasillaporanbumitahun = $datalaporanbumitahun[0]['ketetapanbumi'];
							echo number_format($hasillaporanbumitahun);
						  ?>  
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Luas Bangunan
						<span class="badge badge-success badge-pill">
						  <?php 
							$datalaporanbangunantahun = TotalTargetPajakKabupaten::getlaporanbangunantahun($tahun);
							$hasillaporanbangunantahun = $datalaporanbangunantahun[0]['ketetapanbangunan'];
							echo number_format($hasillaporanbangunantahun);
						  ?>  
						</span>
					  </li>
				  </ul>
				</div>
			</div>
          </div>
        </div>
      </div>
    </section>
