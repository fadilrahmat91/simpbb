
    <!-- Team -->
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase"> TAHUNAN</h2>
            <h3 class="section-subheading text-muted"><?=Yii::app()->report->tahun_mulai()?> - <?= Yii::app()->report->tahun_akhir()?></h3>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php $this->renderPartial('_infochartperubahanketetapan',['tahun'=>$tahun,'kecamatan'=>$kecamatan]); ?>
            </div>
			<div class="col-lg-12"><hr></div>
			 <div class="col-lg-12">
                <?php $this->renderPartial('_infochartrealisasitahunan',['tahun'=>$tahun,'kecamatan'=>$kecamatan]); ?>
            </div>
			<div class="col-lg-12"><hr></div>
			 <div class="col-lg-12">
                <?php $this->renderPartial('_infochartbumidanbangunan',['tahun'=>$tahun,'kecamatan'=>$kecamatan]); ?>
            </div>
        </div>
        <!--div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
          </div>
        </div-->
      </div>
    </section>
