<div class="card p-4">
	<div class="mb-4">
		<a href="<?=site_url('admin/test/form');?>" class="btn btn-success"><i class="fa fa-plus mr-3"></i> Buat Test Baru</a>
	</div>
	<table class="table table-striped datatable-grid">
		<thead>
			<tr>
				<th>Kode Test</th>
				<th>Nama Test</th>
				<th>Tanggal Test</th>
				<th>Desa</th>
				<th width="100"></th>
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
					<a href="<?=site_url('admin/test/form/' . $row['id'])?>" class="text-blue mb-2"><i class="fa fa-search"></i></a>
					<a href="#" data-id="<?=$row['id']?>" data-kode="<?=$row['kode_test']?>" class="text-danger mb-2 ml-2 del-test" title="Hapus Test"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>