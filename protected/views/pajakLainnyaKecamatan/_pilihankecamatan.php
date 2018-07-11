<section>
    <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">INFORMASI PAJAK LAINNYA</h2>
            <h3 class="section-subheading text-muted">KECAMATAN</h3>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-inline" action="<?php echo Yii::app()->createAbsoluteUrl('pajakLainnyaKecamatan/laporan')?>">
					<?php $kec = KecamatanSimpatda::model()->findAll();?>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-top:20px">
						<div class="form-group">
						<select class="form-control" name="kecamatan">
							<option>Pilih Kecamatan</option>
							<?php foreach($kec as $p ){ ?>
								<option <?=($kecamatan == $p['kdkecamatan'] ? 'selected' : '')?> value="<?=$p['kdkecamatan']?>"><?=$p['nama_kecamatan']?></option>
							<?php } ?>
						</select>
					</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4" style="margin-top:20px">
					<div class="form-group">
						<select class="form-control" name="tahun">
							<option>Pilih Tahun</option>
							<?php for( $xn = Yii::app()->report->tahun_akhir(); $xn >= Yii::app()->report->tahun_mulai(); $xn-- ){ ?>
								<option <?=($tahun == $xn ? 'selected' : '')?> value="<?=$xn?>"> <?=$xn?></option>
							<?php } ?>
						</select>
					</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4" style="margin-top:20px">
					<button type="submit" class="btn btn-primary">Cari</button>
					</div>
				</form> 
            </div>
        </div>
      </div>
    </section>
