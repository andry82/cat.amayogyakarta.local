<div class="card p-4">
	<?=form_open()?>
	<div class="my-4">
		<a href="#" class="btn btn-primary edit" data-id="ubah">
			<i class="fas fa-pencil-alt mr-3"></i>INPUT NILAI
		</a>
		<a href="<?=site_url('admin/penilaian/cetak/' . $kodeTest)?>" class="btn btn-success edit" data-id="print">
			<i class="fas fa-print mr-3"></i>CETAK NILAI
		</a>
	</div>
	<?php
		$prosentase = [
			'word'  => $tests['prosentase_word'],
			'excel' => $tests['prosentase_excel'],
			'ppt'   => $tests['prosentase_ppt'],
			'email' => $tests['prosentase_email'],
		];
	?>
	<div class="table-responsive">
		<table class="table-x table-striped table-bordered form-nilai" id="table-nilai">
			<thead>
				<tr>
					<th rowspan="3">No</th>
					<th rowspan="3">Nomor Registrasi</th>
					<th rowspan="3">Nama Lengkap</th>
					<th rowspan="3">Desa</th>
					<th rowspan="3">Nilai Tes Tertulis</th>
					<th colspan="20" class="text-center">Nilai Tes Praktik</th>
					<th rowspan="3">N</th>
					<th colspan="3">Nilai Tes Wawancara</th>
					<th rowspan="3"></th>
				</tr>
				<tr>
					<th colspan="5">Word (<?=$prosentase['word']?>%)</th>
					<th colspan="5">Excel (<?=$prosentase['excel']?>%)</th>
					<th colspan="5">PPT (<?=$prosentase['ppt']?>%)</th>
					<th colspan="5">Email (<?=$prosentase['email']?>%)</th>
					<th rowspan="2" width="25">1</th>
					<th rowspan="2" width="25">2</th>
					<th rowspan="2" width="25">3</th>
				</tr>
				<tr>
					<th width="45">1</th>
					<th width="45">2</th>
					<th width="45">3</th>
					<th width="45">RW</th>
					<th width="45">W</th>
					<th width="45">1</th>
					<th width="45">2</th>
					<th width="45">3</th>
					<th width="45">RX</th>
					<th width="45">X</th>
					<th width="45">1</th>
					<th width="45">2</th>
					<th width="45">3</th>
					<th width="45">RY</th>
					<th width="45">Y</th>
					<th width="45">1</th>
					<th width="45">2</th>
					<th width="45">3</th>
					<th width="45">RZ</th>
					<th width="45">Z</th>
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
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][word1]" value="<?=$row['word1']?>" class="form-control mask-num3"></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][word2]" value="<?=$row['word2']?>" class="form-control mask-num3"></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][word3]" value="<?=$row['word3']?>" class="form-control mask-num3"></td>
					<td><?=$row['skor_word']?></td>
					<td><?=$row['skor_word'] * $prosentase['word']/100?></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][excel1]" value="<?=$row['excel1']?>" class="form-control mask-num3"></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][excel2]" value="<?=$row['excel2']?>" class="form-control mask-num3"></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][excel3]" value="<?=$row['excel3']?>" class="form-control mask-num3"></td>
					<td><?=$row['skor_excel']?></td>
					<td><?=$row['skor_excel'] * $prosentase['excel']/100?></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][ppt1]" value="<?=$row['ppt1']?>" class="form-control mask-num3"></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][ppt2]" value="<?=$row['ppt2']?>" class="form-control mask-num3"></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][ppt3]" value="<?=$row['ppt3']?>" class="form-control mask-num3"></td>
					<td><?=$row['skor_ppt']?></td>
					<td><?=$row['skor_ppt'] * $prosentase['ppt']/100?></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][email1]" value="<?=$row['email1']?>" class="form-control mask-num3"></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][email2]" value="<?=$row['email2']?>" class="form-control mask-num3"></td>
					<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][email3]" value="<?=$row['email3']?>" class="form-control mask-num3"></td>
					<td><?=$row['skor_email']?></td>
					<td><?=$row['skor_email'] * $prosentase['email']/100?></td>
					<td><?=$row['skor_praktik']?></td>
					<td><?=$row['interview1']?></td>
					<td><?=$row['interview2']?></td>
					<td><?=$row['interview3']?></td>
					<td>
						<a href="<?=site_url('admin/penilaian/cetakNilaiGabungan/' . $row['id'])?>" title="Preview Hasil Test" class="ml-2"><i class="fa fa-search text-yellow"></i></a>
					</td>
				</tr>
				<?php $no++; endforeach; ?>
			</tbody>
			<tfoot>
				<tr class="submit">
					<td colspan="10" class="text-center"><button type="submit" class="btn btn-lg btn-block btn-success">Simpan</button></td>
					<td colspan="10" class="text-center"><button type="reset" class="btn btn-lg btn-block btn-danger cancel">Batal</button></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="card-body">
		<p>
			<h5>KETERANGAN:</h5>
			<ul>
				<li>RW = Rata-Rata dari Nilai (Word 1 + Word 2 + Word 3)</li>
				<li>W  = RW * Prosentase Nilai Word (<?=$prosentase['word']?>%)</li>
				<li>RX = Rata-Rata dari Nilai (Excel 1 + Excel 2 + Excel 3)</li>
				<li>X  = RX * Prosentase Nilai Excel (<?=$prosentase['excel']?>%)</li>
				<li>RY = Rata-Rata dari Nilai (PPT 1 + PPT 2 + PPT 3)</li>
				<li>Y  = RY * Prosentase Nilai PPT (<?=$prosentase['ppt']?>%)</li>
				<li>RZ = Rata-Rata dari Nilai (Email 1 + Email 2 + Email 3)</li>
				<li>Z  = RZ * Prosentase Nilai Email (<?=$prosentase['email']?>%)</li>
				<li>N  = (W + X + Y + Z)</li>
			</ul>
		</p>
	</div>
	<?=form_close()?>
</div>