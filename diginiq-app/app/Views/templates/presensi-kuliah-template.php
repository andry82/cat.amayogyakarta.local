<table style="border:none;" width='<?=$width?>' cellspacing="0" class="sub-title">
	<tr>
		<td align="center" colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" colspan="4"><h3>DAFTAR HADIR PERKULIAHAN<br><?=$jadwal['ta']?></h3></td>
	</tr>
	<tr>
		<td class="label-thin">Program</td>
		<td class="content col-7p"> : <?=$jadwal['Program_id'] . ' - ' . $jadwal['nama_program']?></td>
		<td class="label-thin">Hari</td>
		<td class="content"> : <?=$jadwal['hari']?></td>
	</tr>
	<tr>
		<td class="label-thin">Semester/ Kelas</td>
		<td class="content"> : <?php echo $jadwal['Semester']?> / <?=$jadwal['Kelas']?></td>
		<td class="label-thin">Waktu</td>
		<td class="content"> : <?=range_waktu($jadwal['Jam_Mulai'], $jadwal['Jam_Selesai']); ?></td>
	</tr>
	<tr>
		<td class="label-thin">Program Studi</td>
		<td class="content"> : <?=$jadwal['kode_jurusan'] . ' - ' . $jadwal['jenjang_id'] . ' ' . $jadwal['nama_jurusan']?></td>
		<td class="label-thin">Ruang</td>
		<td class="content"> : <?=$jadwal['nama_ruang']?></td>
	</tr>
	<tr>
		<td class="label-thin">Mata Kuliah/SKS</td>
		<td class="content"> : <?=$jadwal['kode_mk'] . ' - ' . $jadwal['nama_mk'] . ' / '. $jadwal['SKS'] . ' SKS'?></td>
		<td class="label-thin">Dosen</td>
		<td class="content"> : <?=$jadwal['nama_dosen']?></td>
	</tr>
	<tr>
		<td align="center" colspan="4">&nbsp;</td>
	</tr>
</table>

<?php $maks = intval($jadwal['maxmeet']); ?>

<table class="table-presensi" width='<?=$width?>' style='border-collapse:collapse;'>
	<tr class='sub_header'>
		<th rowspan="4" width="10" align="center">No</th>
		<th rowspan="4" align="center">NIM</th>
		<th rowspan="4" align="center">Nama Mahasiswa</th>
		<th colspan="<?=$maks?>" align="center">Pertemuan Ke</th>
	</tr>
	<tr class='sub_header'>
		<?php for($a = 1; $a <= $maks; $a++) : ?>
		<th><?=$a?></th>
		<?php endfor; ?>
	</tr>
	<tr class='sub_header'>
		<?php for($a = 1; $a <= $maks; $a++) : ?>
		<th>Tgl</th>
		<?php endfor; ?>      
	</tr>
	<tr class='sub_header' style="height:30px">
		<?php for($a = 1; $a <= $maks; $a++) : ?>
		<th><?=dot_array_search('0.tgl' . $a, $list)?></th>
		<?php endfor; ?>      
	</tr>
      
	<?php $i = 1; 
	foreach ($list as $row) : ?>
	<tr style="height:25px">
		<td align="right"><?=$i?></td>
		<td align="center"><?=$row['NIM']?></td>
		<td><?=$row['nama_mhs']?></td>
		<?php for($a = 1; $a <= $maks; $a++) : ?> 
		<td align="center"><?=$row['ke' . $a]?></td>
		<?php endfor; ?>
	</tr>
	<?php $i++;
	endforeach; ?>	
</table>