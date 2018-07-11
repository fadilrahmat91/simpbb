
    <!-- Team -->
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">KETETAPAN & REALISASI KELURAHAN</h2>
            <h3 class="section-subheading text-muted">10 Data Ketetapan & Realisasi Terbesar <?=$tahun?>.</h3>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php $this->renderPartial('_info10kelurahanketetapanterbesar',['tahun'=>$tahun]); ?>
            </div>
			<!--div class="col-lg-12"><br></div>
			 <div class="col-lg-12">
                <?php /*$this->renderPartial('_info10kelurahanrealisasiterbesar',['tahun'=>$tahun]); */ ?>
            </div-->
        </div>
        <!--div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
          </div>
        </div-->
      </div>
    </section>
