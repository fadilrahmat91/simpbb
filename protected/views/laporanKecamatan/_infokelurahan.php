
    <!-- Team -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">KELURAHAN</h2>
            <h3 class="section-subheading text-muted">Data Ketetapan & Realisasi <?=$tahun?>.</h3>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php $this->renderPartial('_infoketetapankelurahantahunini',['tahun'=>$tahun,'kecamatan'=>$kecamatan]); ?>
            </div>
			<div class="col-lg-12"><hr></div>
			 <div class="col-lg-12">
                <?php $this->renderPartial('_inforealisasikelurahantahunini',['tahun'=>$tahun,'kecamatan'=>$kecamatan]); ?>
            </div>
        </div>
        <!--div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
          </div>
        </div-->
      </div>
    </section>
