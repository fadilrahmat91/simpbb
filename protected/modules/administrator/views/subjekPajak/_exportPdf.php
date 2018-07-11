<?php $slice = ( count($data) > 0 ? array_chunk($data, 19) : '' )?>
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
				<td align='center' style="width: 100%;font-weight:bold;font-size:20px;text-align:center; font-family:Courier;">DAFTAR SUBJEK PAJAK</td>
			</tr>
			<tr>
				<td align='center' style="width: 100%;font-weight:bold;font-size:20px; font-family:Courier;">BADAN PENDAPATAN DAERAH</td>
			</tr>
			<tr>
				<td align='center' style="width: 100%;font-size:20px; font-family:Courier;">KABUPATEN SIMALUNGUN</td>
			</tr>
		</table>
		<br>
		<br>
	<table class="table" border="1" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th style="width:20pt; text-align: center; font-family:Courier; ">NO</th>
				<th style="width:40pt;text-align: center;font-family:Courier;">SUBJEK PAJAK ID</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">NAMA WP</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">JALAN WP</th>
				<th style="width:40pt;text-align: center;font-family:Courier;">BLOK KAV NO WP</th>
				<th style="width:30pt; text-align: center;font-family:Courier;">RW WP</th>
				<th style="width:30pt;text-align: center;font-family:Courier;">RT WP</th>
				<th style="width:50pt; text-align: center;font-family:Courier;">KELURAHAN WP</th>
				<th style="width:60pt;text-align: center;font-family:Courier;">KOTA WP</th>
				<th style="width:20pt; text-align: center;font-family:Courier;">KODE POS WP</th>
				<th style="width:40pt; text-align: center;font-family:Courier;">TELP WP</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">NPWP</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">STATUS PEKERJAAN WP</th>
			</tr>
		</thead>
		<?php if( !empty($data) ){ ?>
			<tbody>
				<tr>
					<td style="widtd:20pt; text-align: center; font-family:Courier; ">0</td>
					<td style="widtd:40pt;text-align: center;font-family:Courier;">1</td>
					<td style="widtd:80pt; text-align: center;font-family:Courier;">2</td>
					<td style="widtd:80pt; text-align: center;font-family:Courier;">3</td>
					<td style="widtd:40pt;text-align: center;font-family:Courier;">4</td>
					<td style="widtd:30pt; text-align: center;font-family:Courier;">5</td>
					<td style="widtd:30pt;text-align: center;font-family:Courier;">6</td>
					<td style="widtd:50pt; text-align: center;font-family:Courier;">7</td>
					<td style="widtd:60pt; text-align: center;font-family:Courier;">8</td>
					<td style="widtd:20pt;text-align: center;font-family:Courier;">9</td>
					<td style="widtd:40pt; text-align: center;font-family:Courier;">10</td>
					<td style="widtd:80pt; text-align: center;font-family:Courier;">11</td>
					<td style="widtd:80pt; text-align: center;font-family:Courier;">12</td>
				</tr>
				<?php foreach( $data as $p ){ ?>
					
					<tr>
						<td style="widtd:20pt; text-align: center; font-family:Courier; "><?=$n?></td>
						<td style="widtd:40pt;text-align: center;font-family:Courier;"><?=$p['SUBJEK_PAJAK_ID']?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=$p['NM_WP'])?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=$p["JALAN_WP"]?></td>
						<td style="widtd:40pt;text-align: center;font-family:Courier;"><?=$p['BLOK_KAV_NO_WP']?></td>
						<td style="widtd:30pt; text-align: center;font-family:Courier;"><?=$p["RW_WP"]?></td>
						<td style="widtd:30pt;text-align: center;font-family:Courier;"><?=$p['RT_WP']?></td>
						<td style="widtd:50pt; text-align: center;font-family:Courier;"><?=$p["KELURAHAN_WP"]?></td>
						<td style="widtd:60pt;text-align: center;font-family:Courier;"><?=$p['KOTA_WP']?></td>
						<td style="widtd:20pt; text-align: center;font-family:Courier;"><?=$p["KD_POS_WP"]?></td>
						<td style="widtd:40pt; text-align: center;font-family:Courier;"><?=$p["TELP_WP"]?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=$p["NPWP"]?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=$p["STATUS_PEKERJAAN_WP"]?></td>
					</tr>
				<?php $n++; ?>
				<?php } ?>
				
			</tbody>
		<?php } ?>
			
	</table>
	</div>
	
	<!--div style="page-break-after:always; clear:both"></div-->
	<?php } ?>
	
<?php } ?>

