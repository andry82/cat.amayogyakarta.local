<?php
if (count($krs)>0 ) :
?>
<?=form_open($saveURL, 'role="form"', [
	'NIM'       => $nim,
	'NIM_DIKTI' => $nim,
	'Tahun_id'  => $tahunId,
	'Program_id' => $Program_id,
	'total_sks' => post_data('total_sks', $krs),
]);
?>
<div class="mb-4">
	<div class="d-flex justify-content-center h5 font-weight-bold">INPUT KARTU RENCANA STUDI</div>
	<div class="d-flex justify-content-center h5 font-weight-bold"><?=$thnAkademik['nama']?></div>
	<div class="d-flex justify-content-center h5 font-weight-bold">PROGRAM STUDI : <?=$jurusan[$kode_jurusan]['jenjang']?> <?=$jurusan[$kode_jurusan]['nama']?></div>
	<div class="d-flex justify-content-center h5 font-weight-bold"><?=$kelas[$krs['Program_id']]?></div>
	<div class="d-flex justify-content-center h5 font-weight-bold"><?=$nim?></div>
</div>
	<div class="d-flex justify-content-end mb-4">
		<a href="<?=$ubahURL?>" class="btn btn-lg btn-primary mx-3">Ubah</a>
		<button type="sbumit" class="btn btn-lg  btn-success">Simpan</button>
	</div>
	<table class="table totalwin-grid table-striped table-bordered table-responsive-stack" id="table-krs">
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
			<?php $no = 0;
			foreach ($penawaran as $row) :
				if (is_array($krs['JadwalId']) && in_array($row['Jadwal_id'], $krs['JadwalId'])) :
					$no++;
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
						<td class="text-md-center text-sm-left"><?=$row['hari']?></td>
						<td class="text-md-center text-sm-left"><?=$waktu?></td>
						<td class="text-md-center text-sm-left"><?=$row['nama_ruang']?></td>
						<td class="text-md-center text-sm-left"><?=$row['Kelas']?></td>
						<td><?=$row['nama_dosen']?></td>
					</tr>
					<?php 
				endif;
			endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9" class="h5 alert-secondary">Total SKS yang diambil : <span id="total-sks"><?=$krs['total_sks']?></span> SKS</td>
			</tr>
		</tfoot>
	</table>
</form>
<?php else :
	echo alert('danger', '<h5>Data K R S untuk kelas ' . $krs['Program_id'] . ' tidak ditemukan!</h5>', 'Jika kamu yakin sudah mengisi KRS, Silakan hubungi Admin untuk melakukan konfirmasi.</p>');
endif; ?>