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
			<div id='headermodul' style='padding:5px;'>Kartu Rencana Studi (KRS)</div>
		</td>
	</tr>
	<tr class='sub_header'>
		<th>No</th>
		<th>Kode</th>
		<th>Matakuliah</th>
		<th>SKS</th>
		<th>Hari</th>
		<th>Waktu</th>
		<th>Ruang</th>
		<th>Kelas</th>
		<th>Dosen</th>
	</tr>
	<?php 
		$line = $tot_sks = 0;
		foreach ($krs as $row) : 
			$waktu = '';
			$line++;
			if ($row['Jam_Mulai']<>'00:00:00' && $row['Jam_Selesai']<>'00:00:00')
			{
				$waktu = substr($row['Jam_Mulai'], 0, 5) . ' - ' . substr($row['Jam_Selesai'], 0, 5) . ' WIB';
			} ?>
			<tr class="row">
				<td align="right"><?=$line?></td>
				<td align="center"><?=$row["kode_mk"]?></td>
				<td><?=$row["nama_mk"]?></td>
				<td align="center"><?=$row["SKS"]?></td>
				<td align="center"><?=$row["Hari"]?></td>
				<td align="center"><?=$waktu?></td>
				<td align="center"><?=$row["Ruang_id"]?></td>
				<td align="center"><?=$row["Kelas"]?></td>
				<td><?=$row["nama_dosen"]?></td>
			</tr>
			<?php $tot_sks += $row["SKS"];
		endforeach; ?>
	<tr class="sub_total">
		<td colspan="9">Jumlah Total SKS yang diambil : <?=$tot_sks?> SKS</td>
	</tr>
</table>