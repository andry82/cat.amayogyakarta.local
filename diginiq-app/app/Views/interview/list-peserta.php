<div class="card p-4">
	<?=form_open()?>
	<div class="my-4 d-none">
		<a href="#" class="btn btn-primary edit" data-id="ubah">
			<i class="fas fa-pencil-alt mr-3"></i>INPUT NILAI
		</a>
		<a href="<?=site_url('admin/penilaian/cetak')?>" class="btn btn-success edit" data-id="print">
			<i class="fas fa-print mr-3"></i>CETAK NILAI
		</a>
	</div>
	<table class="table table-striped table-bordered form-nilai" id="table-nilai">
		<thead>
			<tr>
				<th rowspan="2" width="30">No</th>
				<th rowspan="2" width="130">Nomor Registrasi</th>
				<th rowspan="2">Nama Lengkap</th>
				<th rowspan="2">Desa</th>
				<th colspan="3">Nilai Tes Wawancara</th>
				<th rowspan="2" width="30"></th>
			</tr>
			<tr>
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
				<td><?=$row['interview1']?></td>
				<td><?=$row['interview2']?></td>
				<td><?=$row['interview3']?></td>
				<td>
					<a href="<?=site_url('wawancara/form/' . $row['id'])?>" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
				</td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
	<?=form_close()?>
</div>