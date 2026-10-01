<div class="card p-4">
	<div class="mb-4">
		<a href="<?=site_url('admin/user/form');?>" class="btn btn-success"><i class="fa fa-plus mr-3"></i> Tambah User Baru</a>
	</div>
	<table class="table table-striped datatable-grid">
		<thead>
			<tr>
				<th width="220">Email</th>
				<th width="300">Nama</th>
				<th>Level</th>
				<th>Status</th>
				<th width="100"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $row) : ?>
			<tr <?= empty($row['active']) ? 'class="bg-warning"' : ''?>>
				<td><?=$row['email']?></td>
				<td><?=$row['fullname']?></td>
				<td><?=$row['role']?></td>
				<td><?=$status[$row['active']]?></td>
				<td>
					<a href="<?=site_url('admin/user/form/' . $row['id'])?>" class="text-blue mb-2"><i class="fa fa-pencil-alt"></i></a>
					<a href="#" data-id="<?=$row['id']?>" class="text-danger mb-2 ml-2 del-user" title="Hapus User"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>