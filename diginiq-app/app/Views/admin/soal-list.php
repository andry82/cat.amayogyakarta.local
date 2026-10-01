<div class="card p-4">
	<div class="mb-4 d-flex justify-content-between">
		<div class="col-4">
			<a href="#" data-target="#bank-form" data-backdrop="static" data-form="bank" data-id="" data-nama="" class="btn btn-success btn-form"><i class="fa fa-plus mr-3"></i> Buat Bank Soal Baru</a>
		</div>
		<div class="col text-right">
			<a href="<?=site_url('admin/soal/template');?>" class="btn btn-primary"><i class="fa fa-download mr-3"></i> Download Template Soal</a>
		</div>
	</div>
	<div class="col">
		<input type="file" name="file_soal" accept=".xlsx" class="filestyle upload-soal" data-input="false" data-dragdrop="false" data-text="Unggah Soal (Excel)" data-btnClass="btn-primary">
	</div>
	<table class="table table-striped datatable-grid" id="table-soal" data-paging="false" data-length="false" data-info="false">
		<thead>
			<tr>
				<th width="20">ID</th>
				<th>Nama Bank Soal</th>
				<th width="100" >Jumlah Soal</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list as $row) : ?>
			<tr>
				<td><?=$row['id']?></td>
				<td><a href="#" data-target="#bank-form" data-backdrop="static" data-form="bank" data-id="<?=$row['id']?>" data-nama="<?=$row['nama']?>" class="btn-form"><?=$row['nama']?></a></td>
				<td align="center">
					<a href="<?=site_url('admin/soal/detail/' . $row['id'])?>"><?=$row['jumlah_soal']?></a>
					<a href="#" data-id="<?=$row['id']?>" class="text-danger mb-2 ml-2 del-bank" title="Hapus Bank"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="card p-4 mt-4">
	<div>
		<a href="#" data-target="#kategori-form" data-backdrop="static" data-form="kategori" data-id="" data-nama="" class="btn btn-success btn-form"><i class="fa fa-plus mr-3"></i> Buat Kategori Soal Baru</a>
	</div>
	<table class="table table-striped datatable-grid" id="table-kategori" data-paging="false" data-length="false" data-info="false">
		<thead>
			<tr>
				<th width="20">ID</th>
				<th>BANK Soal</th>
				<th>Kategori Soal</th>
				<th width="90" >Porsi Soal</th>
				<th width="100" >Jumlah Soal</th>
				<th width="20" ></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($kategori as $row) : ?>
			<tr>
				<td><?=$row['id']?></td>
				<td><?=$row['nama']?></td>
				<td><a href="#" data-target="#kategori-form" data-form="kategori" data-bank="<?=$row['bank_soal']?>" data-backdrop="static" data-id="<?=$row['id']?>" data-nama="<?=$row['kategori']?>" data-porsi="<?=$row['porsi_soal']?>" class="btn-form"><?=$row['kategori']?></a></td>
				<td align="center"><?=$row['porsi_soal']?></td>
				<td align="center"><?=$row['jumlah_soal']?></td>
				<td>
					<a href="<?=site_url('admin/soal/form/' . $row['id'])?>" class="text-blue mb-2"><i class="fa fa-search"></i></a>
					<a href="#" data-id="<?=$row['id']?>" class="text-danger mb-2 ml-2 del-kategori" title="Hapus Kategori"><i class="fa fa-trash"></i></a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="bank-form" tabindex="-1" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight" id="modalTitle">BANK SOAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?=form_open(site_url('admin/soal'), ['role="form"']);?>
	  <input type="hidden" name="id" id="bank_id">
	  <input type="hidden" name="tipe" value="BANK">
      <div class="modal-body jsutify-content-center">
		<div class="form-row">
		    <div class="col-3 text-right">
				<label for="nama_desa">Nama</label>
		    </div>
		    <div class="col">
				<div class="input">
		      		<input type="text" class="form-control mask-bigname" name="nama" id="nama" value="">
				</div>
		    </div>
		</div>
      </div>
      <div class="modal-footer">
	    <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
	  <?=form_close()?>
    </div>
  </div>
</div>

<div class="modal fade" id="kategori-form" tabindex="-1" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight" id="modalTitle">KATEGORI SOAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?=form_open(site_url('admin/soal'), ['role="form"']);?>
	  <input type="hidden" name="id" id="kategori_id">
	  <input type="hidden" name="tipe" value="KATEGORI">
      <div class="modal-body jsutify-content-center">
		<div class="form-row">
		    <div class="col-3 text-right">
				<label for="nama_desa">BANK SOAL</label>
		    </div>
		    <div class="col">
				<div class="input">
		      		<?=form_dropdown('bank_soal', $bankSoal, '', 'class="form-control" id="bank_soal"')?>
				</div>
		    </div>
		</div>
		<div class="form-row">
		    <div class="col-3 text-right">
				<label for="nama_desa">Nama</label>
		    </div>
		    <div class="col">
				<div class="input">
		      		<input type="text" class="form-control mask-bigname" name="kategori" id="kategori" value="">
				</div>
		    </div>
		</div>
		<div class="form-row porsi">
		    <div class="col-3 text-right">
				<label for="nama_desa">Porsi Soal</label>
		    </div>
		    <div class="col-3">
				<div class="input">
		      		<input type="text" class="form-control mask-num3" name="porsi_soal" id="porsi_soal" value="">
				</div>
		    </div>
		</div>
      </div>
      <div class="modal-footer">
	    <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
	  <?=form_close()?>
    </div>
  </div>
</div>