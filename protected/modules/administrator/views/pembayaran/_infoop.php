<div class="box box-default">
	<div class="box-header with-border">
		<i class="fa fa-user"></i> 
		<h3 class="box-title">INFO WAJIB PAJAK & OBJEK PAJAK</h3>
	</div>
	<div class="box-body">
<table class="table table-striped ">
	<tbody>
		<tr>
			<td class="bg-info" style="width:180px;">NAMA</td>
			<td class="bg-info" style="width:5px;">:</td>
			<td><?= $data[0]['NM_WP']?></td>
			<td class="bg-success" style="width:180px;">RT/RW O.P</td>
			<td class="bg-success" style="width:5px;">:</td>
			<td><?= $data[0]['RT_OP']?>/<?= $data[0]['RW_OP']?></td>
		</tr>
		<tr>
			<td class="bg-info">KOTA</td>
			<td class="bg-info">:</td>
			<td><?= $data[0]['KOTA_WP']?></td>
			<td class="bg-success">JALAN O.P</td>
			<td class="bg-success">:</td>
			<td><?= $data[0]['JALAN_OP']?></td>
		</tr>
		<tr>
			<td class="bg-info">KELURAHAN</td>
			<td class="bg-info">:</td>
			<td><?= $data[0]['KELURAHAN_WP']?></td>
			<td class="bg-success">LUAS BUMI</td>
			<td class="bg-success">:</td>
			<td><?= $data[0]['TOTAL_LUAS_BUMI']?></td>
		</tr>
		<tr>
			<td class="bg-info">RT/RW</td>
			<td class="bg-info">:</td>
			<td><?= $data[0]['RT_WP']?>/<?= $data[0]['RW_WP']?></td>
			<td class="bg-success">LUAS BANGUNAN</td>
			<td class="bg-success">:</td>
			<td><?= $data[0]['TOTAL_LUAS_BNG']?></td>
		</tr>
		<tr>
			<td class="bg-info">JALAN</td>
			<td class="bg-info">:</td>
			<td><?= $data[0]['JALAN_WP']?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>
</div>
</div>