<?php $slice = ( count($data) > 0 ? array_chunk($data, 36) : '' )?>
<?php $tgl_bayar = explode("-",$tanggal_bayar);?>
<?php $total_ketetapan = 0;?>
<?php $total_denda = 0;?>
<?php $total = 0;?>
<?php $n = 1; ?>
<style>
.table{width:95%; margin-bottom:15px; }
.table tbody tr td{
	padding-top:5pt;
	padding-bottom:5pt;
	border-bottom:1px solid #ccc;
}

</style>
<?php if( !empty($slice) ) { ?>
	<?php foreach( $slice as $data ){ ?>
		<div>
		<table style="width: 100%;margin-bottom:40px;">
			<tr>
				<td align='center' style="width: 100%;font-weight:bold;font-size:20px;text-align:center; font-family:Courier;">DAFTAR WP YANG MEMBAYAR PBB PERDESAAN DAN PERKOTAAN</td>
			</tr>
			<tr>
				<td align='center' style="width: 100%;font-weight:bold;font-size:20px; font-family:Courier;">BADAN PENDAPATAN DAERAH</td>
			</tr>
			<tr>
				<td align='center' style="width: 100%;font-size:20px; font-family:Courier;">KABUPATEN SIMALUNGUN TAHUN <?= date("Y")?></td>
			</tr>
			<tr>
				<td align='center' style="width: 100%;font-size:15px; font-family:Courier;"><?=$tgl_bayar[1]?> <?=Yii::app()->report->monthNumber($tgl_bayar[0])?> <?= end($tgl_bayar)?></td>
			</tr>
		</table>
		<br>
		<br>
	<table class="table" border="1" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th style="width:10pt; text-align: center; font-family:Courier; ">NO</th>
				<th style="width:150pt;text-align: center;font-family:Courier;">NOP</th>
				<th style="width:40pt; text-align: center;font-family:Courier;">TAHUN</th>
				<th style="width:130pt;text-align: center;font-family:Courier;">NAMA WAJIB PAJAK</th>
				<th style="width:70pt; text-align: center;font-family:Courier;">KET. PBB</th>
				<th style="width:60pt; text-align: center;font-family:Courier;">DENDA</th>
				<th style="width:70pt; text-align: center;font-family:Courier;">TOTAL</th>
			</tr>
		</thead>
		<?php if( !empty($data) ){ ?>
			<tbody>
				<tr>
			<td style="width:10pt;text-align: center;font-family:Courier;" >0</td>
			<td style="width:150pt;text-align: center;font-family:Courier;">1</td>
			<td style="width:40pt;text-align: center;font-family:Courier;">2</td>
			<td style="width:130pt;text-align: center;font-family:Courier;">3</td>
			<td style="width:70pt;text-align: center;font-family:Courier;">4</td>
			<td style="width:60pt;text-align: center;font-family:Courier;">5</td>
			<td style="width:70pt;text-align: center;font-family:Courier;">6</td>
		</tr>
				<?php foreach( $data as $p ){ ?>
					<?php $total_ketetapan = $total_ketetapan + $p['KETETAPAN'];?>
					<?php $total_denda = $total_denda + $p['PEMBAYARAN_DENDA'];?>
					<?php $total = $total + $p['PEMBAYARAN_POKOK'];?>
					<tr>
						<td style="width:15pt; text-align: center;font-family:Courier;"><?= $n?></td>
						<td style="width:150pt;text-align: center;font-family:Courier;"><?= $p['NOP']?></td>
						<td style="width:40pt; text-align: center;font-family:Courier;"><?= $p['TAHUN']?></td>
						<td style="width:130pt;text-align: left;font-family:Courier;"><?= $p['NAMA_WP']?></td>
						<td style="width:70pt; text-align: right;font-family:Courier;"><?= Yii::app()->report->uangFormat($p['KETETAPAN'])?></td>
						<td style="width:60pt; text-align: right;font-family:Courier;"><?= Yii::app()->report->uangFormat($p['PEMBAYARAN_DENDA'])?></td>
						<td style="width:70pt; text-align: right;font-family:Courier;"><?= Yii::app()->report->uangFormat($p['PEMBAYARAN_POKOK'])?></td>
					</tr>
				<?php $n++; ?>
				<?php } ?>
				
			</tbody>
		<?php } ?>
			
	</table>
	</div>
	
	<!--div style="page-break-after:always; clear:both"></div-->
	<?php } ?>
	<table class="table" border="1" cellpadding="0" cellspacing="0">
	<tbody>
				<tr>
						<td style="width:15pt; text-align: center;font-family:Courier;">&nbsp;</td>
						<td style="width:150pt;text-align: center;font-family:Courier;">Total</td>
						<td style="width:40pt; text-align: center;font-family:Courier;">&nbsp;</td>
						<td style="width:130pt;text-align: left;font-family:Courier;">&nbsp;</td>
						<td style="width:70pt; text-align: right;font-family:Courier;"><?= Yii::app()->report->uangFormat($total_ketetapan)?></td>
						<td style="width:60pt; text-align: right;font-family:Courier;"><?= Yii::app()->report->uangFormat($total_denda)?></td>
						<td style="width:70pt; text-align: right;font-family:Courier;"><?= Yii::app()->report->uangFormat($total)?></td>
					</tr>
			</tbody>
	</table>
	<div style="margin-top:60px;">
		<table style="width: 100%; ">
        <tr>
            <td style="width: 50%; text-align: left;font-family:Courier;">DIKETAHUI OLEH <br> PLT KASUBBID PELAYANAN DAN KEBERATAN <br> <br> <br> <br><p> <?=LaporanPembayaranNik::PENANGGUNG_JAWAB?> <br><?=LaporanPembayaranNik::NIP_PENAGGUNG_JAWAB?></p></td>
            <td style="width: 50%; text-align: center;font-family:Courier;">YANG MEMBUAT DAFTAR <br><br> <br> <br> <br><p> <?=Yii::app()->user->nama_lengkap?> <br><?= $nip_perekam; ?></p></td>
        </tr>
        
    </table>
	</div>
<?php } ?>

