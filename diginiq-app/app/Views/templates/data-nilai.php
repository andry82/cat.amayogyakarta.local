<?php $width = $width ?? '100%'; ?>
<table width="<?=$width?>" class="sub-title">
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td colspan="2" class="grand-title">DATA NILAI SELEKSI PENYARINGAN CALON PERANGKAT DESA</td>
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
<?php
$prosentase = [
	'word'  => dot_array_search('0.prosentase_word', $peserta),
	'excel' => dot_array_search('0.prosentase_excel', $peserta),
	'ppt'   => dot_array_search('0.prosentase_ppt', $peserta),
	'email' => dot_array_search('0.prosentase_email', $peserta),
];
?>
	<table width='<?=$width?>' cellspacing="0">
		<thead>
			<tr>
				<th rowspan="3">No</th>
				<th rowspan="3">Nomor Registrasi</th>
				<th rowspan="3">Nama Lengkap</th>
				<th rowspan="3">Desa</th>
				<th rowspan="3">Nilai Tes Tertulis</th>
				<th colspan="17" class="text-center">Nilai Tes Praktik</th>
				<th colspan="4">Nilai Tes Wawancara</th>
			</tr>
			<tr>
			<th colspan="4">Word</th>
				<th colspan="4">Excel</th>
				<th colspan="4">PPT</th>
				<th colspan="4">Email</th>
				<th rowspan="2" width="150" align="center">N<br><small>(<?=$prosentase['word']?>% Word + <?=$prosentase['excel']?>% Excel + <?=$prosentase['ppt']?>% PPT + <?=$prosentase['email']?>% Email)</small></th>
				<th rowspan="2" width="25">1</th>
				<th rowspan="2" width="25">2</th>
				<th rowspan="2" width="25">3</th>
				<th rowspan="2" width="25">N</th>
			</tr>
			<tr>
			<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">x&#772;</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">x&#772;</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">x&#772;</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">x&#772;</th>
			</tr>
		</thead>
		<tbody id="detail-nilai">
			<?php $no = 1;
			foreach ($peserta as $row) : ?>
			<tr>
				<td><?=$no?></td>
				<td><?=$row['no_registrasi']?></td>
				<td><?=$row['nama_lengkap']?></td>
				<td><?=$row['nama_desa']?></td>
				<td class="center"><?=format_nilai($row['skor_tertulis'])?></td>
				<td class="center"><?=format_nilai($row['word1'])?></td>
				<td class="center"><?=format_nilai($row['word2'])?></td>
				<td class="center"><?=format_nilai($row['word3'])?></td>
				<td class="center"><?=format_nilai($row['skor_word'])?></td>
				<td class="center"><?=format_nilai($row['excel1'])?></td>
				<td class="center"><?=format_nilai($row['excel2'])?></td>
				<td class="center"><?=format_nilai($row['excel3'])?></td>
				<td class="center"><?=format_nilai($row['skor_excel'])?></td>
				<td class="center"><?=format_nilai($row['ppt1'])?></td>
				<td class="center"><?=format_nilai($row['ppt2'])?></td>
				<td class="center"><?=format_nilai($row['ppt3'])?></td>
				<td class="center"><?=format_nilai($row['skor_ppt'])?></td>
				<td class="center"><?=format_nilai($row['email1'])?></td>
				<td class="center"><?=format_nilai($row['email2'])?></td>
				<td class="center"><?=format_nilai($row['email3'])?></td>
				<td class="center"><?=format_nilai($row['skor_email'])?></td>
				<td class="center"><?=format_nilai($row['skor_praktik'])?></td>
				<td class="center"><?=format_nilai($row['interview1'])?></td>
				<td class="center"><?=format_nilai($row['interview2'])?></td>
				<td class="center"><?=format_nilai($row['interview3'])?></td>
				<td class="center"><?=format_nilai($row['skor_wawancara'])?></td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
	<?=form_close()?>
</td>