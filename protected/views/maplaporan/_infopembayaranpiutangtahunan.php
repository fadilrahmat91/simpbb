
    <!-- Team -->
    <section class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ">
            <h2 class="section-heading text-uppercase text-center"> PEMBAYARAN PIUTANG</h2>
			<h3 class="section-subheading text-muted text-center">Informasi Pembayaran Piutang</h3>
          </div>
        </div>
        <div class="row">
			
			<!--div class="col-lg-4 div-pembayaran-piutang">
				<table class="table table-striped table-bordered" style="width:100%;table-layout: fixed;" id="table-pembayaran-piutang">
					<thead>
						<tr>
							<th colspan="4" class="text-center">DATA PEMBAYARAN PIUTANG</th>
						</tr>
						<tr>
							<th>Tahun</th>
							<th>Jumlah Objek</th>
							<th>Pokok</th>
							<th>Denda</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div-->
            <div class="col-lg-12">
                <?php $this->renderPartial('_infochartpembayaranpiutang',['tahun'=>$tahun]); ?>
            </div>
			
        </div>
		</div>
    </section>
<style>
.row-margin{
	margin-left:10px;
	margin-right:10px;
}
.dataTables_info{
	display:none;
}
</style>