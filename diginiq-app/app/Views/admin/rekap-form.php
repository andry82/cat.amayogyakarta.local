<div class="card p-4">
	<?php
	$prosentase = [
		'prosentase_tertulis'  => $tests['prosentase_tertulis'] ?? 0,
		'prosentase_praktik'   => $tests['prosentase_praktik'] ?? 0,
		'prosentase_wawancara' => $tests['prosentase_wawancara'] ?? 0,
	];
	$nilai = json_encode($prosentase);
	?>
	<div class="my-4">
		<a href="#" class="btn btn-primary btn-prosentase" data-id="<?=$tests['id']?>" data-nilai='<?=$nilai?>' data-toggle="modal" data-backdrop="static" data-target="#prosentase-nilai"><i class="fas fa-pencil-alt mr-3"></i>UBAH PROSENTASE</a>
		<a href="<?=site_url('admin/rekapitulasi/cetak/' . $kodeTest)?>" class="btn btn-success edit" data-id="print">
			<i class="fas fa-print mr-3"></i>CETAK REKAPITULASI NILAI
		</a>
	</div>
	<table class="table table-striped table-bordered datatable-grid form-nilai" data-ordering="false" id="table-nilai">
		<thead>
			<tr>
				<th rowspan="3">No</th>
				<th rowspan="3">Nomor Registrasi</th>
				<th rowspan="3">Nama Lengkap</th>
				<th rowspan="3">Desa</th>
				<th colspan="6" class="text-center">Perolehan Nilai</th>
				<th rowspan="3" width="65">Jumlah Total Nilai</th>
			</tr>
			<tr>
				<th colspan="2">Ujian Tertulis</th>
				<th colspan="2">Ujian Praktik</th>
				<th colspan="2">Wawancara</th>
			</tr>
			<tr>
				<th width="65">N</th>
				<th width="65">N (<?=$tests['prosentase_tertulis']?>%)</th>
				<th width="65">N</th>
				<th width="65">N (<?=$tests['prosentase_praktik']?>%)</th>
				<th width="65">N</th>
				<th width="65">N (<?=$tests['prosentase_wawancara']?>%)</th>
			</tr>
		</thead>
		<tbody id="detail-nilai">
			<?php $no = 1;
			foreach ($peserta as $row) : 
				$nilaiTertulis  = floatval($row['skor_tertulis']) * floatval($tests['prosentase_tertulis']) / 100;
				$nilaiPraktik   = floatval($row['skor_praktik']) * floatval($tests['prosentase_praktik']) / 100;
				$nilaiWawancara = floatval($row['skor_wawancara']) * floatval($tests['prosentase_wawancara']) / 100;

				$totalNilai = $nilaiTertulis + $nilaiPraktik + $nilaiWawancara;
			?>
			<tr>
				<td><?=$no?></td>
				<td><?=$row['no_registrasi']?></td>
				<td><?=$row['nama_lengkap']?></td>
				<td><?=$row['nama_desa']?></td>
				<td class="text-center"><?=format_nilai($row['skor_tertulis'])?></td>
				<td class="text-center"><?=format_nilai(($nilaiTertulis))?></td>
				<td class="text-center"><?=format_nilai($row['skor_praktik'])?></td>
				<td class="text-center"><?=format_nilai($nilaiPraktik)?></td>
				<td class="text-center"><?=format_nilai($row['skor_wawancara'])?></td>
				<td class="text-center"><?=format_nilai($nilaiWawancara)?></td>
				<td class="text-center"><?=format_nilai($totalNilai)?></td>
			</tr>
			<?php $no++; endforeach; ?>
		</tbody>
	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="prosentase-nilai" tabindex="-1" role="dialog" aria-labelledby="prosentaseNilai" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Prosentase Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?=form_open(site_url('admin/rekapitulasi/prosentase'), 'id="form-prosentase"')?>
	  <input type="hidden" name="id" id="id">
	  <input type="hidden" name="redirect" value="<?='/admin/rekapitulasi/form/' . $tests['kode_test']?>">
      <div class="modal-body jsutify-content-center mx-auto">
		<div class="form-row">
		    <div class="col-7 text-right">
				<label for="presensi">Prosentase Tertulis</label>
		    </div>
		    <div class="col-5">
				<div class="input-group">
		      		<input type="text" class="form-control mask-num3" name="prosentase_tertulis" id="prosentase_tertulis" value="">
					<div class="input-group-prepend">
			          <span class="input-group-text">%</span>
			        </div>
				</div>
		    </div>
		</div>
		<div class="form-row">
		    <div class="col-7 text-right">
				<label for="lain2">Prosentase Praktik</label>
		    </div>
		    <div class="col-5">
				<div class="input-group">
		      		<input type="text" class="form-control mask-num3" name="prosentase_praktik" id="prosentase_praktik" value="">
					<div class="input-group-prepend">
			          <span class="input-group-text">%</span>
			        </div>
				</div>
		    </div>
		</div>
		<div class="form-row">
		    <div class="col-7 text-right">
				<label for="uts">Prosentase Wawancara</label>
		    </div>
		    <div class="col-5">
				<div class="input-group">
		      		<input type="text" class="form-control mask-num3" name="prosentase_wawancara" id="prosentase_wawancara" value="">
					<div class="input-group-prepend">
			          <span class="input-group-text">%</span>
			        </div>
				</div>
		    </div>
		</div>
		<div class="form-row">
		    <div class="col-7 text-right">
				<label for="total">Total</label>
		    </div>
		    <div class="col-5">
				<div class="input-group">
		      		<input type="text" class="form-control" disabled name="total" id="total" value="">
					<div class="input-group-prepend">
			          <span class="input-group-text">%</span>
			        </div>
				</div>
		    </div>
		</div>
      </div>
      <div class="modal-footer">
	    <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
	  </form>
    </div>
  </div>
</div>