<div class="row d-flex justify-content-center">
    <div class="col-6 elevation-2 card-table">
		<?=form_open(site_url('wawancara/form/' . $id), 'role="form" id="form-interview" class="col ' . ($readonly ? 'readonly' : '') . '"', [
			'interview1'     => $data['interview1'],
			'interview2'     => $data['interview2'],
			'interview3'     => $data['interview3'],
			'pewawancara_id' => $user['id'],
		]); ?>
		<input type="hidden" name="id" value="<?= $id ?>" id="id">
		<input type="hidden" name="no_registrasi" value="<?=$data['no_registrasi']?>" id="no_registrasi">
		<table class="table table-bordered my-3" id="peserta-detail">
	        <thead>                                
	            <tr class="table-primary text-center">
	                <th colspan="3">PENILAIAN WAWANCARA	</th>
				</tr>
			</thead>
			<tbody id="detail-peserta"> 
				<tr>
					<td width="20"></td>
	                <td width="200">Nomor Registrasi</td>
	                <td><?=$data['no_registrasi']?></td>
				</tr>
				<tr>
					<td></td>
	                <td>Nama Lengkap</td>
	                <td><?=$data['nama_lengkap']?></td>
				</tr>
				<tr>
					<td></td>
	                <td>Kode Test</td>
	                <td><?=$data['kode_test']?></td>
				</tr>
				<tr>
					<td></td>
	                <td>Desa</td>
	                <td><?=$data['nama_desa']?></td>
				</tr>
				<tr>
					<td></td>
	                <td>Petugas Wawancara</td>
	                <td><?=$user['fullname']?></td>
				</tr>
			</tbody>
		</table>
		<hr>
		<table class="table table-bordered my-3" id="form-nilai">
	        <thead>                                
	            <tr class="table-primary text-center">
	                <th colspan="2">BUTIR EVALUASI</th>
					<th>NILAI</th>
				</tr>
			</thead>
			<tbody id="detail-nilai"> 
				<tr>
					<td colspan="3">1. KOMPETENSI DIRI</td>
				</tr>
				<tr>
					<td width="15">1</td>
					<td>Kesiapan calon mengikuti test</td>
					<td width="100">
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview11" value="<?=post_data('interview11', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Motivasi peserta selain mengabdi</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview12" value="<?=post_data('interview12', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Kepemimpinan diri peserta</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview13" value="<?=post_data('interview13', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td>Kemampuan menyusun rencana program pembangunan desa</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview14" value="<?=post_data('interview14', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td>Upaya yang dilakukan dalam mewujudkan rencana program</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview15" value="<?=post_data('interview15', $data)?>">
						</div>
					</td>
				</tr>
				<tr class="bg-secondary">
					<td colspan="2" align="right">Rata-Rata</td>
					<td align="center"><span id="avg1"><?=$data['interview1']?></span></td>
				</tr>
				<tr>
					<td colspan="3">2. PERILAKU DAN BUDI PEKERTI</td>
				</tr>
				<tr>
					<td width="15">1</td>
					<td>Etika dalam berbahasa</td>
					<td width="100">
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview21" value="<?=post_data('interview21', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Cara bicara tegas dan lugas</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview22" value="<?=post_data('interview22', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Intonasi dan volume suara jelas</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview23" value="<?=post_data('interview23', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td>Cara berpakain rapi </td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview24" value="<?=post_data('interview24', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td>Perilaku Sopan</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview25" value="<?=post_data('interview25', $data)?>">
						</div>
					</td>
				</tr>
				<tr class="bg-secondary">
					<td colspan="2" align="right">Rata-Rata</td>
					<td align="center"><span id="avg2"><?=$data['interview2']?></span></td>
				</tr>
				<tr>
					<td colspan="3">3. WAWASAN KEBANGSAAN</td>
				</tr>
				<tr>
					<td width="15">1</td>
					<td>Pemahaman memahami budaya lokal</td>
					<td width="100">
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview31" value="<?=post_data('interview31', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Peran aktif di masyarakat</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview32" value="<?=post_data('interview32', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Kesiapan melayani Masyarakat</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview33" value="<?=post_data('interview33', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>4</td>
					<td>Pengetahuan terkait tugas perangkat desa</td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview34" value="<?=post_data('interview34', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td>Pengetahuan terkait pemerintahan </td>
					<td>
						<div class="input col">
							<input type="text" class="form-control nilai" name="interview35" value="<?=post_data('interview35', $data)?>">
						</div>
					</td>
				</tr>
				<tr class="bg-secondary">
					<td colspan="2" align="right">Rata-Rata</td>
					<td align="center"><span id="avg3"><?=$data['interview3']?></span></td>
				</tr>
				<tr class="submit text-center">
					<td colspan="3">
						<?php if (! $readonly) : ?>
						<input type="submit" class="btn btn-primary mr-2" value="Simpan" name="submit">
						<?php endif; ?>
						<a href="<?=site_url('wawancara/list/' . $data['kode_test'])?>" class="btn btn-danger"><?= $readonly ? 'Kembali' : 'Batal' ?></a>
					</td>
				</tr>
			</tbody>
		</table>
		<div>
			<p>
				Catatan: Skor maksimal untuk setiap sub indikator penilaian adalah 100
			</p>
		</div>
		<?=form_close()?>
	</div>
</div>
