<div class="card p-4">
	<div class="mb-4">
		<a href="<?=site_url('admin/rekapitulasi/cetak')?>" class="btn btn-success edit" data-id="print">
			<i class="fas fa-print mr-3"></i>CETAK REKAPITULASI NILAI
		</a>
	</div>
	<table class="table table-striped datatable-grid">
		<thead>
			<tr>
				<th>Kode Test</th>
				<th>Nama Test</th>
				<th>Tanggal Test</th>
				<th>Desa</th>
				<th width="120"></th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($list as $row) : 
				$prosentase = [
					'prosentase_tertulis'  => $row['prosentase_tertulis'] ?? 0,
					'prosentase_praktik'   => $row['prosentase_praktik'] ?? 0,
					'prosentase_wawancara' => $row['prosentase_wawancara'] ?? 0,
				];
	
				$nilai = json_encode($prosentase);
			?>
			<tr>
				<td><?=$row['kode_test']?></td>
				<td><?=$row['nama_test']?></td>
				<td><?=date_id($row['tanggal_test'])?></td>
				<td><?=$row['desa']?></td>
				<td>
					<a href="<?=site_url('admin/rekapitulasi/form/' . $row['kode_test'])?>" class="text-blue mb-2 mr-3"><i class="fa fa-search text-success"></i></a>
					<a href="#" class="btn btn-primary btn-prosen btn-prosentase" data-id="<?=$row['id']?>" data-nilai='<?=$nilai?>' data-toggle="modal" data-backdrop="static" data-target="#prosentase-nilai"><?=implode(',', $prosentase)?></a>
				</td>
			</tr>
			<?php endforeach; ?>
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