<section id="services" class="bg-light" >
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">INFORMASI PAJAK LAINNYA <?php echo $tahun?></h2>
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
						Pajak
						<span class="badge badge-success badge-pill" style="position:relative">
							<?php 
								$data_pajak = KetetapanKecamatanSimpatda::get_ketetapan_tahunan($tahun,KetetapanKecamatanSimpatda::TYPE_PAJAK,$kecamatan);
								echo "Rp. ".number_format($data_pajak['ketetapan']);
							?> 
							<span class="badge badge-danger badge-pill persen-right"><?=number_format($data_pajak['jumlah_objek'])?></span>
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Sanksi Adm Pajak
						<span class="badge badge-success badge-pill">
						  <?php 
							echo "Rp. ".number_format($data_pajak['sanksi_adm']);
						  ?>  
						</span>
					  </li>
					  
					  
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Retribusi
						<span class="badge badge-success badge-pill" style="position:relative">
						  <?php 
							$data_retribusi = KetetapanKecamatanSimpatda::get_ketetapan_tahunan($tahun,KetetapanKecamatanSimpatda::TYPE_PAJAK_RETRIBUSI,$kecamatan);
							echo "Rp. ".number_format($data_retribusi['ketetapan']);
						  ?> 
						  <span class="badge badge-danger badge-pill persen-right"><?=number_format($data_retribusi['jumlah_objek'])?></span>
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Sanksi Adm Retribusi
						<span class="badge badge-success badge-pill">
						  <?php 
							echo "Rp. ".number_format($data_retribusi['sanksi_adm']);
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
				
				<h4 class="service-heading">REALISASI PAJAK</h4>
				<?php $realisasi_pajak = RealisasiKecamatanSimpatda::get_realisasi_tahunan($tahun,KetetapanKecamatanSimpatda::TYPE_PAJAK,$kecamatan)?>
				<div class="list-group box-profile">
				  <ul class="list-group">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Realisasi
						<span class="badge badge-success badge-pill" style="position:relative">
						  <?= "Rp. ".number_format($realisasi_pajak['jumlah_bayar']);?> <span class="badge badge-danger badge-pill persen-right">(<?=number_format( Yii::app()->report->getPersentaseNotFormat($realisasi_pajak['jumlah_bayar'],$data_pajak['ketetapan']),2)."%";?>)</span>
						</span>
						
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Pembayaran Denda
						<span class="badge badge-success badge-pill">
						  <?php 
							echo "Rp. ".number_format($realisasi_pajak['jumlah_denda']);
						  ?> 
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Sanksi ADM
						<span class="badge badge-success badge-pill">
						  <?php 
							echo "Rp. ".number_format($realisasi_pajak['jumlah_sanksi_adm']);
						  ?> 
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Objek Pajak
						<span class="badge badge-success badge-pill" style="position:relative">
						  <?= number_format($realisasi_pajak['jumlah_objek']);?>  
						  <span class="badge badge-danger badge-pill persen-right">(
						  <?= number_format(Yii::app()->report->getPersentaseNotFormat($realisasi_pajak['jumlah_objek'],$data_pajak['jumlah_objek']),2)."%";?>)
						</span>
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
				  <i class="fa fa-calendar-check-o fa-stack-1x fa-inverse"></i>
				</span>
				
				<h4 class="service-heading">REALISASI RETRIBUSI</h4>
				<?php $realisasi_pajak = RealisasiKecamatanSimpatda::get_realisasi_tahunan($tahun,KetetapanKecamatanSimpatda::TYPE_PAJAK_RETRIBUSI,$kecamatan)?>
				<div class="list-group box-profile">
				  <ul class="list-group">
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Realisasi
						<span class="badge badge-success badge-pill" style="position:relative">
						  <?= "Rp. ".number_format($realisasi_pajak['jumlah_bayar']);?> <span class="badge badge-danger badge-pill persen-right">(<?=number_format(Yii::app()->report->getPersentaseNotFormat($realisasi_pajak['jumlah_bayar'],$data_retribusi['ketetapan']),2)."%";?>)</span>
						</span>
						
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Pembayaran Denda
						<span class="badge badge-success badge-pill">
						  <?php 
							echo "Rp. ".number_format($realisasi_pajak['jumlah_denda']);
						  ?> 
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Sanksi ADM
						<span class="badge badge-success badge-pill">
						  <?php 
							echo "Rp. ".number_format($realisasi_pajak['jumlah_sanksi_adm']);
						  ?> 
						</span>
					  </li>
					  <li class="list-group-item d-flex justify-content-between align-items-center">
						Objek Pajak
						<span class="badge badge-success badge-pill" style="position:relative">
						  <?= number_format($realisasi_pajak['jumlah_objek']);?>  
						  <span class="badge badge-danger badge-pill persen-right">(
						  <?= number_format(Yii::app()->report->getPersentaseNotFormat($realisasi_pajak['jumlah_objek'],$data_retribusi['jumlah_objek']))."%";?>)
						</span>
						</span>
					  </li>
					 
				  </ul>
				</div>
			</div>
            
          </div>
        </div>
      </div>
    </section>
