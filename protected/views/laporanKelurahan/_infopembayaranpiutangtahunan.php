<section class="bg-light">
    <div class="container">
        <div class="row">
          <div class="col-lg-12 ">
            <h2 class="section-heading text-uppercase text-center"> PEMBAYARAN PIUTANG</h2>
			<h3 class="section-subheading text-muted text-center">Informasi Pembayaran Piutang</h3>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php $this->renderPartial('_infochartpembayaranpiutang',['tahun'=>$tahun,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]); ?>
            </div>
			
        </div>
	</div>
</section>