<div class="card p-4">
	<?=form_open()?>
	<input type="hidden" name="kodeTest" id="kodeTest" value="<?=$kodeTest?>">
	<?php if ($aktif) : ?>
	<div class="my-2 text-center">
		<input type="file" name="file_jawaban" accept=".json" class="filestyle upload-jawaban" data-input="false" data-dragdrop="false" data-text="Unggah Jawaban (JSON) contoh: ABCDEF.json, di mana ABCDEF adalah nomor registrasi peserta" data-btnClass="btn-primary">
	<div class="my-2 text-center">
	</div>
		<input type="file" name="file_interview" accept=".json" class="filestyle upload-interview" data-input="false" data-dragdrop="false" data-text="Unggah Jawaban Interview (JSON) contoh: interview-ABCDEF.json, di mana ABCDEF adalah nomor registrasi peserta" data-btnClass="btn-success">
	</div>
	<?php endif; ?>
	<div class="my-3 text-center">
		<p class="alert alert-warning">Jika komputer lama dalam kondisi IDLE, harap refresh ulang browser untuk memastikan nilai inputan lain telah masuk.</p>
	</div>
	<div class="my-2 text-center">
	<div class="my-4">
		<?php if ($aktif) : ?>
		<a href="#" class="btn btn-primary edit d-none" data-id="ubah">
			<i class="fas fa-pencil-alt mr-3"></i>INPUT NILAI
		</a>
		<?php endif; ?>
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
				<th colspan="17" class="text-center">Nilai Tes Praktik</th>
				<th colspan="4">Nilai Tes Wawancara</th>
				<th rowspan="3"></th>
			</tr>
			<tr>
				<th colspan="4">Word</th>
				<th colspan="4">Excel</th>
				<th colspan="4">PPT</th>
				<th colspan="4">Email</th>
				<th rowspan="2" width="150" align="center">N<br><small>(<?=$prosentase['word']?>% Word + <?=$prosentase['excel']?>% Excel + <?=$prosentase['ppt']?>% PPT + <?=$prosentase['email']?>% Email)</small></th>
				<th rowspan="2" width="25">1</th>
				<th rowspan="2" width="25">2</th>
				<th rowspan="2" width="25">3</th>
				<th rowspan="2" width="25">N</th>
			</tr>
			<tr>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">x&#772;</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">x&#772;</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">x&#772;</th>
				<th width="45">1</th>
				<th width="45">2</th>
				<th width="45">3</th>
				<th width="45">x&#772;</th>
			</tr>
		</thead>
		<tbody id="detail-nilai">
			<?php $no = 1;
			foreach ($peserta as $row) : 
			$prefixId = 'nilai_' . strtolower($row['no_registrasi']) . '_'; ?>
			<tr>
				<td><?=$no?></td>
				<td><?=$row['no_registrasi']?></td>
				<td><?=$row['nama_lengkap']?></td>
				<td><?=$row['nama_desa']?></td>
				<td class="text-center"><?=format_nilai($row['skor_tertulis'])?></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][word1]" value="<?=$row['word1']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][word2]" value="<?=$row['word2']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][word3]" value="<?=$row['word3']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td align="center" id="<?=$prefixId?>skor_word"><?=$row['skor_word']?></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][excel1]" value="<?=$row['excel1']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][excel2]" value="<?=$row['excel2']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][excel3]" value="<?=$row['excel3']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td align="center" id="<?=$prefixId?>skor_excel"><?=$row['skor_excel']?></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][ppt1]" value="<?=$row['ppt1']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][ppt2]" value="<?=$row['ppt2']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][ppt3]" value="<?=$row['ppt3']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td align="center" id="<?=$prefixId?>skor_ppt"><?=$row['skor_ppt']?></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][email1]" value="<?=$row['email1']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][email2]" value="<?=$row['email2']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td><input type="text" name="nilai[<?=$row['no_registrasi']?>][email3]" value="<?=$row['email3']?>" class="form-control mask-num3 input-<?=$no?>"></td>
				<td align="center" id="<?=$prefixId?>skor_email"><?=format_nilai($row['skor_email'])?></td>
				<td align="center" id="<?=$prefixId?>skor_praktik"><?=format_nilai($row['skor_praktik'])?></td>
				<td align="center" id="<?=$prefixId?>interview1"><?=format_nilai($row['interview1'])?></td>
				<td align="center" id="<?=$prefixId?>interview2"><?=format_nilai($row['interview2'])?></td>
				<td align="center" id="<?=$prefixId?>interview3"><?=format_nilai($row['interview3'])?></td>
				<td align="center" id="<?=$prefixId?>skor_wawancara"><?=format_nilai($row['skor_wawancara'])?></td>
				<td>
					<?php if ($aktif) : ?>
					<a href="#" class="update link-<?=$no?>" id="edit-<?=$no?>">
						<i class="fas fa-pencil-alt mr-3"></i>
					</a>
					<button type="submit" class="button d-none btn btn-xs btn-block btn-success btn-<?=$no?>" id="btn-<?=$no?>">Simpan</button>
					<button type="reset" class="button btn-cancel d-none btn btn-xs btn-block btn-danger btn-<?=$no?>" id="btn-<?=$no?>">Batal</button>
					<?php endif; ?>
					<a href="<?=site_url('admin/penilaian/cetakNilaiGabungan/' . $row['id'])?>" title="Preview Hasil Test" class="ml-2 link-<?=$no?>"><i class="fa fa-search text-yellow"></i></a>
				</td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
		<tfoot>
			<tr class="submit">
				<td colspan="5"></td>
				<td colspan="8" class="text-center"></td>
				<td colspan="8" class="text-center"></td>
				<td colspan="6"></td>
			</tr>
		</tfoot>
	</table>
	</div>
	<?=form_close()?>
</div>