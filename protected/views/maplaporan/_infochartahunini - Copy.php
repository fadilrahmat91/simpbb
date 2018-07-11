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
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-shield fa-stack-1x fa-inverse"></i>
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
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-xing-square fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">REALISASI</h4>
            <div class="list-group box-profile">

              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total
                    <span class="badge badge-success badge-pill">
                      <?php 
                        $datalaporanrealisasitahun = TotalRealisasiPajakKabupaten::getlaporanrealisasitahun($tahun);
                        $hasillaporanrealisasitahun = $datalaporanrealisasitahun[0]['realisasitahun'];
                        echo "Rp. ".number_format($hasillaporanrealisasitahun);
                      ?> 
                    </span>
                    <span class="badge badge-danger badge-pill">
                      <?php 
                        $datapersentaseketetapanrealisasi = ($hasillaporanrealisasitahun/$hasillaporanketetapantahun)*100;
                        echo number_format($datapersentaseketetapanrealisasi,2)." %";
                      ?> 
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Objek Pajak
                    <span class="badge badge-success badge-pill">
                      <?php 
                        $datalaporanrealisasiobjekpajaktahun = TotalRealisasiPajakKabupaten::getlaporanrealisasiobjekpajaktahun($tahun);
                        $hasillaporanrealisasiobjekpajaktahun = $datalaporanrealisasiobjekpajaktahun[0]['objekpajak'];
                        echo number_format($hasillaporanrealisasiobjekpajaktahun);
                      ?>  
                    </span>
                    <span class="badge badge-danger badge-pill">
                      <?php 
                        $datapersentaseketetapanrealisasiobjek = ($hasillaporanrealisasiobjekpajaktahun/$hasillaporanobjekpajaktahun)*100;
                        echo number_format($datapersentaseketetapanrealisasiobjek,2)." %";
                      ?> 
                    </span>
                  </li>
                  <!--
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Piutang & Denda
                    <span class="badge badge-success badge-pill">
                      <?php 
                        /*
                          $datalaporanrealisasiPPtahun = TotalRealisasiPajakKabupaten::getlaporanrealisasiPPtahun($tahun);
                          $hasillaporanrealisasiPPtahun = $datalaporanrealisasiPPtahun[0]['pp'];
                          echo "Rp. ".number_format($hasillaporanrealisasiPPtahun);
                        */
                      ?>  
                    </span>
                    <span class="badge badge-danger badge-pill">
                      <?php 
                        /*
                          $datalaporanrealisasiPDtahun = TotalRealisasiPajakKabupaten::getlaporanrealisasiPDtahun($tahun);
                          $hasillaporanrealisasiPDtahun = $datalaporanrealisasiPDtahun[0]['pd'];
                          echo "Rp. ".number_format($hasillaporanrealisasiPDtahun);
                        */
                      ?> 
                    </span>
                  </li>
                  -->
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Piutang
                    <span class="badge badge-success badge-pill">
                      <?php 
                        $datalaporanrealisasiPPtahun = TotalRealisasiPajakKabupaten::getlaporanrealisasiPPtahun($tahun);
                        $hasillaporanrealisasiPPtahun = $datalaporanrealisasiPPtahun[0]['pp'];

                        $datalaporanrealisasiPDtahun = TotalRealisasiPajakKabupaten::getlaporanrealisasiPDtahun($tahun);
                        $hasillaporanrealisasiPDtahun = $datalaporanrealisasiPDtahun[0]['pd'];

                        echo "Rp. ".number_format($hasillaporanrealisasiPPtahun + $hasillaporanrealisasiPDtahun);
                      ?>  
                    </span>
                  </li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-cubes fa-stack-1x fa-inverse"></i>
            </span>
            <h4 class="service-heading">BUMI & BANGUNAN</h4>
            <div class="list-group box-profile">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Luas Bumi
                    <span class="badge badge-success badge-pill">
                      <?php 
                        $datalaporanbumitahun = TotalTargetPajakKabupaten::getlaporanbumitahun($tahun);
                        $hasillaporanbumitahun = $datalaporanbumitahun[0]['ketetapanbumi'];
                        echo number_format($hasillaporanbumitahun);
                      ?>  
                    </span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Luas Bangunan
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
    </section>
