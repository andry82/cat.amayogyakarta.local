<div class="card p-5">
	<?php
	$actionURL = site_url('admin/test/form' . empty($id) ? '' : '/' . $id);
	echo form_open($actionURL);
	if ($id)
	{
		echo form_hidden('id', $id);
	} 
	?>
	<div class="row">
		<div class="col-6 mb-3">
	        <label for="kode_test" class="form-label">Kode Test</label>
	        <input type="text" class="form-control" id="kode_test" name="kode_test" value="<?= post_data('kode_test', $data) ?>" required autofocus>
	    </div>
	</div>
	<div class="row">
		<div class="col-6 mb-3">
	        <label for="nama_test" class="form-label">Nama Test</label>
	        <input type="text" class="form-control" id="nama_test" name="nama_test" value="<?= post_data('nama_test', $data) ?>" required autofocus>
	    </div>
	</div>
	<div class="row">
		<div class="col-6 mb-3">
	        <label for="tanggal_test" class="form-label">Tanggal Test</label>
	        <input type="text" class="form-control" id="tanggal_test" name="tanggal_test" value="<?= post_data('tanggal_test', $data) ?>" required autofocus>
	    </div>
	</div>
	</div>
	<?=form_close()?>
</div>