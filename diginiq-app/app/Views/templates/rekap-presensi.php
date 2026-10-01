<div class="container">
<?php
	if (count_array($data)>0) :
	echo form_open('', 'class="form"'); ?>
	<div class="col mx-auto">
		<div class="d-flex justify-content-center h5 font-weight-bold">PRESENSI KULIAH</div>
		<div class="d-flex justify-content-center h5 font-weight-bold"><?=$thnAkademik['nama']?></div>

		<div class="d-flex justify-content-center h5 font-weight-bold mt-4">DOSEN : <?=$data['nama_dosen']?></div>
		<div class="d-flex justify-content-center h5 font-weight-bold">MATAKULIAH : <?=$data['kode_mk']?> <?=$data['nama_mk']?></div>
		<div class="d-flex justify-content-center h5 font-weight-bold mb-4">KELAS : <?=$data['Kelas']?></div>
	</div>

	<div class="row justify-content-center elevation-2 m-2 p-3">
		<div class="col-lg-4 col-sm-6">
			<div class="row">
				<div class="col-lg-2">SEMESTER</div><div class="col"> : <?=$data['Semester']?></div>
			</div>
			<div class="row">
				<div class="col-lg-2">JURUSAN</div><div class="col"> : <?=$data['jenjang_id'] . ' ' . $data['nama_jurusan']?></div>
			</div>
		</div>
		<div class="col-lg-4"></div>
		<div class="col-lg-4 col-sm-6">
			<div class="row">
				<div class="col-lg-2">JAM</div><div class="col"> : <?=range_waktu($data['Jam_Mulai'], $data['Jam_Selesai'])?></div>
			</div>
			<div class="row">
				<div class="col-lg-2">RUANG</div><div class="col"> : <?=$data['nama_ruang']?></div>
			</div>
		</div>
	</div>
	<div class="row justify-content-center mb-3">
		<div class="card elevation-3 col p-3 m-3">

			<div class="table-responsive">
				<table class="table datatable-grid table-striped table-responsive-stack" data-info="false" data-paging="false" id="grid-rekap">
					<thead>
						<tr class="bg-primary">
							<th width="20">Pertemuan Ke</th>
							<th width="100">Tanggal</th>
							<th>Pokok Bahasan</th>
							<th width="100">Jumlah Peserta</th>
							<th width="100">Data Presensi</th>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ($rekap as $ke => $row)
					{
						$statClass = empty($row) ? '' : 'class="bg-grey"';
						?>
						<tr <?=$statClass?>>
							<td><a href="<?=site_url('admin/perkuliahan/presensi/' . $data['id'] . '/' . $ke)?>" onclick="loadingInfo('Cek detail presensi...', 30);"><i class="fa fa-edit mr-1"></i> <?=$ke?></a></td>
							<?php if (! empty($row)) : ?>
							<td><?=date_id($row['tgl'])?></td>
							<td><?=nl2br($row['pokok']) . '<br>' . nl2br($row['sub_pokok'])?></td>
							<td><?=$row['peserta']?></td>
							<td>
								<div class="btn-block px-2 btn-success <?=empty($row['hadir']) ? 'd-none' : ''?>">Hadir : <?=$row['hadir']?></div>
								<div class="btn-block px-2 btn-info <?=empty($row['ijin']) ? 'd-none' : ''?>">Ijin : <?=$row['ijin']?></div>
								<div class="btn-block px-2 btn-warning <?=empty($row['sakit']) ? 'd-none' : ''?>">Sakit : <?=$row['sakit']?></div>
								<div class="btn-block px-2 btn-danger <?=empty($row['alpa']) ? 'd-none' : ''?>">Alpa : <?=$row['alpa']?></div>
							</td>
							<?php else : ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<?php endif; ?>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php 
	echo form_close();
	else :
	echo alert('danger', 'Jadwal tidak valid.', 'Tidak ada jadwal terpilih', false);
	endif;
	?>
</div>