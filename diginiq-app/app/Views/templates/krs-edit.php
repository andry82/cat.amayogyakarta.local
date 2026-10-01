<?php
if (isset($data['adaTagihan']) && ! empty($data['adaTagihan'])) :
	echo alert('danger', '<h5>Tagihan SPP!</h5>', 'Saat ini ada catatan tagihan SPP di sistem kami. <p>Jika Anda merasa sudah pernah melakukan pembayaran namun muncul peringatan ini, silakan hubungi Admin Keuangan.</p>');
elseif (count($penawaran)>0 ) :
?>
<?=form_open($konfirmasiURL, 'role="form"', [
	'NIM'        => $nim,
	'NIM_DIKTI'  => $nim,
	'Program_id' => $Program_id,
	'Tahun_id'   => $tahunId,
	'total_sks'  => post_data('total_sks', 0),
]);
?>
<div class="mb-4">
	<div class="d-flex justify-content-center h5 font-weight-bold">INPUT KARTU RENCANA STUDI</div>
	<div class="d-flex justify-content-center h5 font-weight-bold"><?=$thnAkademik['nama']?></div>
	<div class="d-flex justify-content-center h5 font-weight-bold">PROGRAM STUDI : <?=$jurusan[$kode_jurusan]['jenjang']?> <?=$jurusan[$kode_jurusan]['nama']?></div>
	<div class="d-flex justify-content-center h5 font-weight-bold"><?=$kelas[$Program_id]?></div>
	<div class="d-flex justify-content-center h5 font-weight-bold"><?=$nim?></div>
</div>
	<div class="d-flex justify-content-end mb-4">
		<button type="sbumit" class="btn btn-lg  btn-success">Lanjut</button>
	</div>
	<div class="alert alert-dark" role="alert">
		<input type="checkbox" id="select-all" value="1"><label for="select-all" class="h5 mx-3">Pilih semua matakuliah</label>
	</div>
	<table class="table totalwin-grid table-striped table-bordered table-responsive-stack" id="table-krs">
		<thead>
			<tr>
				<th width="50">Pilih</th>
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
			foreach ($penawaran as $row) : $no++;
				$waktu = '';

				if ($row['Jam_Mulai']<>'00:00:00' && $row['Jam_Selesai']<>'00:00:00')
				{
					$waktu = substr($row['Jam_Mulai'], 0, 5) . ' - ' . substr($row['Jam_Selesai'], 0, 5) . ' WIB';
				}

				echo form_hidden('SKS[]', $row['SKS']);
				echo form_hidden('krsKeys[' . $row['Jadwal_id'] . ']', isset($krs['exist'][$row['kode_mk']]) ? $krs['exist'][$row['kode_mk']] : 0);

				$checked = '';

				if (isset($krs['JadwalId']) && is_array($krs['JadwalId']))
				{
					$checked = in_array($row['Jadwal_id'], $krs['JadwalId']) ? 'checked' : '';
				}
				?>
				<tr>
					<td class="text-md-center text-sm-left"><input type="checkbox" class="pilih-krs" data-sks="<?=$row['SKS']?>" name="JadwalId[]" value="<?=$row['Jadwal_id']?>" id="j_<?=$row['Jadwal_id']?>" data-key="<?=isset($krs['exist'][$row['kode_mk']]) ? $krs['exist'][$row['kode_mk']] : 0?>" <?=$checked?>></td>
					<td class="text-md-center text-sm-left"><?=$row['kode_mk']?></td>
					<td><?=$row['nama_mk']?></td>
					<td class="text-md-right text-sm-left"><?=$row['SKS']?></td>
					<td class="text-md-center text-sm-left"><?=$row['hari']?></td>
					<td class="text-md-center text-sm-left"><?=$waktu?></td>
					<td class="text-md-center text-sm-left"><?=$row['nama_ruang']?></td>
					<td class="text-md-center text-sm-left"><?=$row['Kelas']?></td>
					<td><?=$row['nama_dosen']?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9" class="h5 alert-secondary">Total SKS yang diambil : <span id="total-sks">0</span> SKS</td>
			</tr>
		</tfoot>
	</table>
</form>
<script>
	var maxSKS = <?=$maxSKS?>;
	var hapusKRSURL = '<?=$hapusKRSURL?>';
</script>
<?php else :
	echo alert('danger', '<h5>Data K R S untuk kelas ' . $Program_id . ' tidak ditemukan!</h5>', 'Saat ini belum ada jadwal KRS untuk kelas ' . $Program_id . '. <p>Silakan hubungi Admin untuk melakukan konfirmasi jadwal.</p>');
endif; ?>