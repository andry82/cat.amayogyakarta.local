<?php $width = $width ?? '100%'; ?>
<table width="<?=$width?>" class="sub-title">
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td colspan="2" class="grand-title">REKAPITULASI NILAI SELEKSI PENYARINGAN CALON PERANGKAT DESA</td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td class="header-label" width="100">Kode Test</td>
		<td class="header-label">: <?=dot_array_search('0.kode_test', $peserta)?></td>
	</tr>
	<tr>
		<td class="header-label">Tanggal Test</td>
		<td class="header-label">: <?=date_id(dot_array_search('0.tanggal_test', $peserta))?></td>
	</tr>
	<tr>
		<td class="header-label">Desa</td>
		<td class="header-label">: <?=dot_array_search('0.nama_desa', $peserta)?></td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
</table>

	<table width='<?=$width?>' cellspacing="0">
		<thead>
		<tr>
				<th rowspan="3" width="40">No</th>
				<th rowspan="3" width="120">Nomor Registrasi</th>
				<th rowspan="3">Nama Lengkap</th>
				<th rowspan="3">Desa</th>
				<th colspan="6" class="center">Perolehan Nilai</th>
				<th rowspan="3" width="65">Jumlah Total Nilai</th>
			</tr>
			<tr>
				<th colspan="2">Ujian Tertulis</th>
				<th colspan="2">Ujian Praktik</th>
				<th colspan="2">Wawancara</th>
			</tr>
			<tr>
				<th width="65">N</th>
				<th width="65">N (<?=dot_array_search('0.prosentase_tertulis', $peserta)?>%)</th>
				<th width="65">N</th>
				<th width="65">N (<?=dot_array_search('0.prosentase_praktik', $peserta)?>%)</th>
				<th width="65">N</th>
				<th width="65">N (<?=dot_array_search('0.prosentase_wawancara', $peserta)?>%)</th>
			</tr>
		</thead>
		<tbody id="detail-nilai">
			<?php $no = 1;
			foreach ($peserta as $row) : 
				$nilaiTertulis  = floatval($row['skor_tertulis']) * floatval($row['prosentase_tertulis']) / 100;
				$nilaiPraktik   = floatval($row['skor_praktik']) * floatval($row['prosentase_praktik']) / 100;
				$nilaiWawancara = floatval($row['skor_wawancara']) * floatval($row['prosentase_wawancara']) / 100;

				$totalNilai = $nilaiTertulis + $nilaiPraktik + $nilaiWawancara;
			?>
			<tr>
				<td><?=$no?></td>
				<td><?=$row['no_registrasi']?></td>
				<td><?=$row['nama_lengkap']?></td>
				<td><?=$row['nama_desa']?></td>
				<td class="center"><?=format_nilai($row['skor_tertulis'])?></td>
				<td class="center"><?=format_nilai($nilaiTertulis)?></td>
				<td class="center"><?=format_nilai($row['skor_praktik'])?></td>
				<td class="center"><?=format_nilai($nilaiPraktik)?></td>
				<td class="center"><?=format_nilai($row['skor_wawancara'])?></td>
				<td class="center"><?=format_nilai($nilaiWawancara)?></td>
				<td class="center"><?=format_nilai($totalNilai)?></td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
	<?=form_close()?>
</td>