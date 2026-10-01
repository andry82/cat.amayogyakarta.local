<div class="card p-4">
	<div class="mb-4 d-none">
		<a href="<?=site_url('admin/penilaian/cetak')?>" class="btn btn-success edit" data-id="print">
			<i class="fas fa-print mr-3"></i>CETAK NILAI
		</a>
	</div>
	<table class="table table-striped datatable-grid">
		<thead>
			<tr>
				<th>Kode Test</th>
				<th>Nama Test</th>
				<th>Tanggal Test</th>
				<th>Desa</th>
				<th>Peserta</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list as $row) : ?>
			<tr>
				<td><?=$row['kode_test']?></td>
				<td><?=$row['nama_test']?></td>
				<td><?=date_id($row['tanggal_test'])?></td>
				<td><?=$row['desa']?></td>
				<td>
					<?php if (! empty($row['peserta'])) : ?>
					<a href="<?=site_url('wawancara/list/' . $row['kode_test'])?>" class="text-blue mb-2"><?=$row['peserta']?> Orang</a>
					<?php else : ?>
						-
					<?php endif; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>