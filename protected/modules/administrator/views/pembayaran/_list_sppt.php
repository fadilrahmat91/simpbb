<div class="box box-default">
	<div class="box-header with-border">
		<i class="fa fa-database"></i> 
		<h3 class="box-title">Data SPPT</h3>
		<div class="box-tools">
			<button type="button" class="btn btn-info btn-sm" id="check_uncheck" data-value="y" data-ischecklis="Jangan Pilih" data-unchecklis="Pilih Semua">Jangan Pilih</button>
		</div>
	</div>
	<div class="box-body">
		<table class="table table-bordered ">
			<thead>
				<tr>
					<th>NO</th>
					<th class="bg-primary" style="text-align:center">TAHUN</th>
					<th>LUAS BUMI</th>
					<th>LUAS BANGUNAN</th>
					<th class="bg-primary" style="text-align:center">KETETAPAN</th>
					<th class="bg-danger" style="text-align:center;background-color:red;color:#fff;">DENDA (<?=Yii::app()->report->persenDenda()?>%)</th>
					<th>TGL TERBIT</th>
					<th>TGL JTH TEMPO</th>
					<th>STATUS</th>
					<th  style="text-align:center">BAYAR</th>
				</tr>
			</thead>
			<tbody>
				<?php $n=1;?>
				<?php $total_ketetapan = 0; ?>
				<?php $total_denda = 0;?>
				<?php $_wajib_bayar = Yii::app()->pembayaran->limit_date_wajib_bayar(); ?>
				<?php $_max_wajib_bayar = Yii::app()->pembayaran->limit_max_wajib_bayar()?>
				<?php foreach( $data as $p ) { ?>
					<?php $ketetapan = Yii::app()->report->minimalketetapan($p['KETETAPAN'],$p['TAHUN']);?>
					<?php $is_denda = Yii::app()->report->isDenda($p['TGL_JTH_TEMPO'],date("m/d/y"));?>
					<?php $denda = ( $is_denda['status'] == true ? 0 : Yii::app()->report->getTotalDenda($ketetapan,$is_denda['denda_bulan'])); ?>
					<?php $total_ketetapan += round($ketetapan);?>
					<?php $total_denda += round($denda);?>
					
					<tr class="<?=( $is_denda['status'] == true ? 'bg-info' : 'bg-danger')?>">
						<td><?=$n++?></td>
						<th class="bg-success" style="text-align:center" ><span class="badge bg-green"><?=$p['TAHUN']?></span></th>
						<td><?=$p['LUAS_BUMI']?></td>
						<td><?=$p['LUAS_BNG']?></td>
						<th class="bg-info" style="text-align:center">Rp.<span class="badge bg-light-blue pull-right"><?=Yii::app()->format->formatNumber($ketetapan)?></span></th>
						<td> Rp.<?= Yii::app()->format->formatNumber($denda)?> <span class="badge bg-red pull-right"><?= ($is_denda['denda_bulan']) * Yii::app()->report->persenDenda()?> %</span></td>
						<td><?=$p['TGL_TERBIT']?></td>
						<td><?=$p['TGL_JTH_TEMPO']?></td>
						<td><?=$p['STATUS']?></td>
						<?php $wbayar = Yii::app()->pembayaran->is_wajib_bayar($p['TAHUN']);//($p['TAHUN'] >= $_wajib_bayar AND $p['TAHUN'] <= $_max_wajib_bayar ? true : false )?>
						<td style="text-align:center;<?=($wbayar ? 'text-align:center;background-color:red;color:#fff;':'')?>" ><input type="hidden" name="tahun_data" value="<?=$p['TAHUN']?>">
							<?php if($wbayar ){ ?>
							<label>
							  <div class="icheckbox_minimal-blue disabled checked" style="border:none;cursor:enabled">&nbsp;</div>
							</label>
							<input style="display:none" type="checkbox" <?=($wbayar ? 'readonly=true':'')?> data-wajibbayar="<?=($wbayar ? '1':'0')?>" data-tahun = "<?= $p['TAHUN'] ?>" data-ketetapan = "<?= $ketetapan ?>" data-denda= "<?= $denda ?>" class="minimal unallow_icheck tahun_pembayaran_sppt" id="sppt_<?=$p['TAHUN']?>" checked name="tahun_sppt[]" value="<?=$p['TAHUN']?>">
							<?php }else{ ?>
								<label>
									<input type="checkbox" <?=($wbayar ? 'readonly=true':'')?> data-wajibbayar="<?=($wbayar ? '1':'0')?>" data-tahun = "<?= $p['TAHUN'] ?>" data-ketetapan = "<?= $ketetapan ?>" data-denda= "<?= $denda ?>" class="minimal allow_ichek tahun_pembayaran_sppt" id="sppt_<?=$p['TAHUN']?>" checked name="tahun_sppt[]" value="<?=$p['TAHUN']?>">
								</label>
							<?php } ?>
						</td>
						
					</tr>
					
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-6 pull-right">
		<div class="box box-primary">
			<div class="box-header with-border">
				<i class="fa fa-credit-card"></i> 
				<h3 class="box-title">Detail Bayar</h3>
			</div>
			<?php $biayaAdministrasi = Yii::app()->report->biayaAdministrasi()?>
			<div class="box-body">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td>Total Ketetapan</td>
							<td class="bg-info" style="width:150px">Rp. <span class="badge bg-light-blue pull-right" id="total_ketetapan" data-hasil="<?=$total_ketetapan?>"><?=Yii::app()->format->formatNumber($total_ketetapan)?></span></td>
						</tr>
						<tr>
							<td>Total Denda</td>
							<td class="bg-danger">Rp. <span class="badge bg-red pull-right" id="total_denda" data-hasil="<?=$total_denda?>"><?=Yii::app()->format->formatNumber($total_denda)?></span></td>
						</tr>
						<tr>
							<td>Biaya Administrasi</td>
							<td class="bg-success">Rp. <span class="badge bg-light-blue pull-right" id="biaya_adm" data-hasil="<?=$biayaAdministrasi?>"><?=Yii::app()->format->formatNumber($biayaAdministrasi)?></span></td>
						</tr>
						
						<tr>
							<td>Total</td>
							<?php $total = $total_ketetapan + $total_denda + $biayaAdministrasi; ?>
							<td class="bg-primary">Rp . <span class="badge bg-green pull-right" id="total_bayar" data-hasil="<?=$total?>"><?=Yii::app()->format->formatNumber($total)?></span></td>
						</tr>
						<tr>
							<td colspan="2"><button class="btn btn-block btn-primary btn-sm" id="show-modal-konfirmation">Konfirmasi Pembayaran  &nbsp; &nbsp; <i class="fa fa-credit-card"></i> </button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
