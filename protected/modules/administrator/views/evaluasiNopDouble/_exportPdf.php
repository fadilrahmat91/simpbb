<?php $slice = ( count($data) > 0 ? array_chunk($data, 36) : '' )?>
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
				<td align='center' style="width: 100%;font-weight:bold;font-size:20px;text-align:center; font-family:Courier;">DAFTAR EVALUASI NOP DOUBLE</td>
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
				<th style="width:120pt;text-align: center;font-family:Courier;">TAHUN PAJAK SPPT</th>
				<th style="width:150pt;text-align: center;font-family:Courier;">NOP ASAL</th>
				<th style="width:30pt;text-align: center;font-family:Courier;">STATUS NOP ASAL</th>
				<th style="width:150pt; text-align: center;font-family:Courier;">NOP PERUBAHAN</th>
				<th style="width:50pt;text-align: center;font-family:Courier;">STATUS NOP PERUBAHAN</th>
			</tr>
		</thead>
		<?php if( !empty($data) ){ ?>
			<tbody>
				<tr>
					<td style="width:20pt;text-align: center;font-family:Courier;" >0</td>
					<td style="width:120pt;text-align: center;font-family:Courier;">1</td>
					<td style="width:80pt;text-align: center;font-family:Courier;">2</td>
					<td style="width:30pt;text-align: center;font-family:Courier;">3</td>
					<td style="width:150pt;text-align: center;font-family:Courier;">4</td>
					<td style="width:50pt;text-align: center;font-family:Courier;">5</td>
				</tr>
				<?php foreach( $data as $p ){ ?>
					
					<tr>
						<td style="width:20pt; text-align: center;font-family:Courier;"><?= $n?></td>
						<td style="width:120pt; text-align: center;font-family:Courier;"><?=$p['THN_PAJAK_SPPT']?></td>
						<td style="width:150pt;text-align: left;font-family:Courier;"><?=$p['NOP_ASAL']?></td>
						<td style="width:30pt;text-align: left;font-family:Courier;"><?=$p['STATUS_NOP_ASAL']?></td>
						<td style="width:150pt; text-align: right;font-family:Courier;"><?=$p['NOP_PERUBAHAN']?></td>
						<td style="width:50pt;text-align: left;font-family:Courier;"><?=$p['STATUS_NOP_PERUBAHAN']?></td>
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

