<script>
	var input_krs_Url = '<?=$inputURL?>';
</script>
<?php
if (count($krs)>0 ) :
?>
<?=form_hidden('total_sks', post_data('total_sks', $krs));?>
	<div class="mb-4">
		<div class="d-flex justify-content-center h5 font-weight-bold">KARTU RENCANA STUDI</div>
		<div class="d-flex justify-content-center h5 font-weight-bold"><?=$thnAkademik['nama']?></div>
		<div class="d-flex justify-content-center h5 font-weight-bold">PROGRAM STUDI : <?=$jurusan[$user['kode_jurusan']]['jenjang']?> <?=$jurusan[$user['kode_jurusan']]['nama']?></div>
		<div class="d-flex justify-content-center h5 font-weight-bold">
			<?=$kelas[$krs[0]['Program_id']]?>
		</div>
	</div>
	<div class="mb-3 d-flex justify-content-end">
		<a class="btn btn-lg text-green" title="Ubah" href="<?=$ubahURL?>"><i class="fa fa-pencil-alt"></i> <span class="ml-2 d-sm-inline d-none">Ubah</span></a>
		<a class="btn btn-lg text-blue" title="Cetak" onclick="show_popup('<?=site_url('cetak/krs/' . $nim . '/'. $tahunId)?>');"><i class="fa fa-print"></i> <span class="ml-2 d-sm-inline d-none">Cetak</span></a>
		<a class="btn btn-lg text-red" title="Unduh" href="<?=site_url('cetak/krsPDF/' . $nim . '/'. $tahunId)?>" target="_blank"><i class="fa fa-file-pdf"></i> <span class="ml-2 d-sm-inline d-none">Unduh</span></a>
	</div>
	<table class="table totalwin-grid table-striped table-bordered table-responsive-stack elevation-4" id="table-krs">
		<thead>
			<tr>
				<th width="50">No</th>
				<th>KODE</th>
				<th>MATAKULIAH</th>
				<th>SKS</th>
				<th>HARI</th>
				<th>WAKTU</th>
				<th>RUANG</th>
				<th>KELAS</th>
				<th>DOSEN</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = $total_sks = 0;
			foreach ($krs as $row) :
				$no++;
				$total_sks += $row['SKS'];

				$waktu = '';
				if ($row['Jam_Mulai']<>'00:00:00' && $row['Jam_Selesai']<>'00:00:00')
				{
					$waktu = substr($row['Jam_Mulai'], 0, 5) . ' - ' . substr($row['Jam_Selesai'], 0, 5) . ' WIB';
				}?>
				<tr>
					<td class="text-md-center text-sm-left"><?=$no?></td>
					<td class="text-md-center text-sm-left"><?=$row['kode_mk']?></td>
					<td><?=$row['nama_mk']?></td>
					<td class="text-md-right text-sm-left"><?=$row['SKS']?></td>
					<td class="text-md-center text-sm-left"><?=$row['Hari']?></td>
					<td class="text-md-center text-sm-left"><?=$waktu?></td>
					<td class="text-md-center text-sm-left"><?=$row['Ruang_id']?></td>
					<td class="text-md-center text-sm-left"><?=$row['Kelas']?></td>
					<td><?=$row['nama_dosen']?></td>
				</tr>
				<?php
			endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9" class="h5 alert-secondary">Total SKS yang diambil : <span id="total-sks"><?=$total_sks?></span> SKS</td>
			</tr>
		</tfoot>
	</table>
<?php else :
	echo alert('danger', '<h5>Data K R S untuk kelas ' . $krs['Program_id'] . ' tidak ditemukan!</h5>', 'Jika kamu yakin sudah mengisi KRS, Silakan hubungi Admin untuk melakukan konfirmasi.</p>');
endif; ?>