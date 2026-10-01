<div class="card p-4">
	<div class="my-4 text-center">
		<h4>DATA NILAI SELEKSI PENYARINGAN CALONG PERANGKAT DESA</h4>
	</div>
	<div class="row mb-4">
		<div class="col-2">Kode Test</div>
		<div class="col-2"><?=dot_array_search('*.0.kode_test', $peserta)?></div>
	</div>
	<div class="row mb-4">
		<div class="col-2">Tanggal Test</div>
		<div class="col-2"><?=date_id(dot_array_search('*.0.tanggal_test', $peserta))?></div>
	</div>
	<div class="row mb-4">
		<div class="col-2">Desa</div>
		<div class="col-2"><?=dot_array_search('*.0.nama_desa', $peserta)?></div>
	</div>
	<table class="table table-striped table-bordered datatable-grid form-nilai" data-ordering="false" id="table-nilai">
		<thead>
			<tr>
				<th rowspan="3">No</th>
				<th rowspan="3">Nomor Registrasi</th>
				<th rowspan="3">Nama Lengkap</th>
				<th rowspan="3">Desa</th>
				<th rowspan="3">Nilai Tes Tertulis</th>
				<th colspan="12" class="text-center">Nilai Tes Praktik</th>
				<th colspan="3">Nilai Tes Wawancara</th>
			</tr>
			<tr>
				<th colspan="3">Word</th>
				<th colspan="3">Excel</th>
				<th colspan="3">PPT</th>
				<th colspan="3">Email</th>
				<th rowspan="2" width="45">1</th>
				<th rowspan="2" width="45">2</th>
				<th rowspan="2" width="45">3</th>
			</tr>
			<tr>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
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
				<td><?=$row['skor_tertulis']?></td>
				<td><?=$row['word1']?></td>
				<td><?=$row['word2']?></td>
				<td><?=$row['word3']?></td>
				<td><?=$row['excel1']?></td>
				<td><?=$row['excel2']?></td>
				<td><?=$row['excel3']?></td>
				<td><?=$row['ppt1']?></td>
				<td><?=$row['ppt2']?></td>
				<td><?=$row['ppt3']?></td>
				<td><?=$row['email1']?></td>
				<td><?=$row['email2']?></td>
				<td><?=$row['email3']?></td>
				<td><?=$row['interview1']?></td>
				<td><?=$row['interview2']?></td>
				<td><?=$row['interview3']?></td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
	<?=form_close()?>
</div>