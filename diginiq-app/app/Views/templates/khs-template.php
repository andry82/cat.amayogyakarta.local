<table class="sub-title" width='<?=$width?>' cellspacing="0">
	<tr>
		<td class="label">Tahun Akademik :</td>
		<td class=isi><?=$tahunAkademik?></td>
	</tr>
	<tr>
		<td class="label">NIM :</td>
		<td class=isi><?=$NIM?></td>
	</tr>
	<tr>
		<td class="label">Nama :</td>
		<td class=isi><?=$nama?></td>
	</tr>							
	<tr>
		<td class="label">Jenjang / Program Studi :</td>
		<td class=isi>'<?=$jenjang . ' / '. $jurusan?></td>
	</tr>
</table>

<table class="sub-title" width='<?=$width?>' style='border-collapse:collapse;'> 
	<tr class="block">
		<td colspan=9> 
			<div id='headermodul' style='padding:5px;'>Kartu Hasil Studi (KHS)</div>
		</td>
	</tr>
	<tr class='sub_header'>
		<th width="50">No</th>
		<th>KODE</th>
		<th>MATAKULIAH</th>
		<th>SKS</th>
		<th>BOBOT</th>
		<th>BOBOT SKS</th>
		<th>NILAI HURUF</th>
	</tr>
	<?php
		$totalSKS   = sum_array($ips, 'totalSKS');
		$totalBobot = sum_array($ips, 'totalBobot');
		$line = $tot_sks = $tot_bobot = 0;

		foreach ($khs as $row) :
			$line++; ?>
			<tr class="row">
				<td align="right"><?=$line?></td>
				<td align="center"><?=$row["kode_mk"]?></td>
				<td><?=$row["nama_mk"]?></td>
				<td align="center"><?=$row["SKS"]?></td>
				<td align="center"><?=number_format($row['bobot'],1)?></td>
				<td align="center"><?=round($row['bobotSKS'],1)?></td>
				<td align="center"><?=$row['grade']?></td>
			</tr>
			<?php 
			$tot_sks += $row["SKS"];
			$tot_bobot += $row["bobotSKS"];
		endforeach;
		$ip_s = round($tot_bobot/$tot_sks, 2);
		$ip_s2 = $ips[$ta]['IPS'];
		?>
	<tr class="sub_total">
		<td colspan="3" align="right">Jumlah SKS : </td><td align="center"><?=$tot_sks?></td><td></td><td align="center"><?=$tot_bobot?></td><td></td>
	</tr>
	<tr class="sub_total">
		<td colspan="3" align="right">Jumlah SKS Kumulatif : </td><td align="center"><?=$totalSKS?></td><td></td><td align="center"></td><td></td>
	</tr>
	<tr class="sub_total">
		<td colspan="3" align="right">Index Prestasi Semester <?=$ips[$ta]['semester']?> : </td><td align="center"><?=$ip_s?></td><td colspan="3"></td>
	</tr>
	<tr class="sub_total">
		<td colspan="3" align="right">Index Prestasi Kumulatif : </td><td align=center><?=$ipk?></td><td colspan="3"></td>
	</tr>
	</tr>
</table>