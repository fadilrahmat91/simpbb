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
				<td align='center' style="width: 100%;font-weight:bold;font-size:20px;text-align:center; font-family:Courier;">DAFTAR EVALUASI LAPORAN TAHUNAN</td>
			</tr>
			<tr>
				<td align='center' style="width: 100%;font-weight:bold;font-size:20px; font-family:Courier;">BADAN PENDAPATAN DAERAH</td>
			</tr>
			<tr>
				<td align='center' style="width: 100%;font-size:20px; font-family:Courier;">KABUPATEN SIMALUNGUN TAHUN <?= $_GET['tahun'];?></td>
			</tr>
		</table>
		<br>
		<br>
	<table class="table" border="1" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th style="width:20pt; text-align: center; font-family:Courier; ">NO</th>
				<th style="width:40pt;text-align: center;font-family:Courier;">TAHUN</th>
				<th style="width:100pt; text-align: center;font-family:Courier;">KECAMATAN</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">KELURAHAN</th>
				<th style="width:110pt;text-align: center;font-family:Courier;">JUMLAH OBJEK KETETAPAN</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">KETETAPAN</th>
				<th style="width:110pt;text-align: center;font-family:Courier;">JUMLAH OBJEK PIUTANG</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">PIUTANG</th>
				<th style="width:110pt;text-align: center;font-family:Courier;">JUMLAH OBJEK REALISASI</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">REALISASI</th>
				<th style="width:80pt; text-align: center;font-family:Courier;">SELISIH</th>
			</tr>
		</thead>
		<?php if( !empty($data) ){ ?>
			<tbody>
				<tr>
					<td style="widtd:20pt; text-align: center; font-family:Courier; ">0</td>
					<td style="widtd:40pt;text-align: center;font-family:Courier;">1</td>
					<td style="widtd:100pt; text-align: center;font-family:Courier;">2</td>
					<td style="widtd:80pt; text-align: center;font-family:Courier;">3</td>
					<td style="widtd:110pt;text-align: center;font-family:Courier;">4</td>
					<td style="widtd:80pt; text-align: center;font-family:Courier;">5</td>
					<td style="widtd:110pt;text-align: center;font-family:Courier;">6</td>
					<td style="widtd:80pt; text-align: center;font-family:Courier;">7</td>
					<td style="widtd:110pt;text-align: center;font-family:Courier;">8</td>
					<td style="widtd:800pt; text-align: center;font-family:Courier;">9</td>
					<td style="widtd:80pt; text-align: center;font-family:Courier;">10</td>
				</tr>
				<?php foreach( $data as $p ){ ?>
					
					<tr>
						<td style="widtd:20pt; text-align: center; font-family:Courier; "><?=$n?></td>
						<td style="widtd:40pt;text-align: center;font-family:Courier;"><?=$p['TAHUN']?></td>
						<td style="widtd:100pt; text-align: center;font-family:Courier;"><?=Yii::app()->report->kecamatanName($p['KD_KECAMATAN'])?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=Yii::app()->report->kelurahanName($p["KD_KECAMATAN"],$p["KD_KELURAHAN"])?></td>
						<td style="widtd:110pt;text-align: center;font-family:Courier;"><?=$p['JUM_OBJEK_KETETAPAN']?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=Yii::app()->report->uangFormat($p["KETETAPAN"])?></td>
						<td style="widtd:110pt;text-align: center;font-family:Courier;"><?=$p['JUM_OBJEK_PIUTANG']?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=Yii::app()->report->uangFormat($p["PIUTANG"])?></td>
						<td style="widtd:110pt;text-align: center;font-family:Courier;"><?=$p['JUM_OBJEK_REALISASI']?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=Yii::app()->report->uangFormat($p["REALISASI"])?></td>
						<td style="widtd:80pt; text-align: center;font-family:Courier;"><?=Yii::app()->report->uangFormat($p["SELISIH"])?></td>
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

