<div class="col-12 col-md-4 text-center">
<div class="card shadow">
  <div class="card-header h4 text-center text-white" style="background-color: #003366;">
    REGISTRASI
  </div>
  <div class="card-body text-left">
    <?=form_open()?>
      <div class="mb-3">
        <label for="no_registrasi" class="form-label">No. Registrasi</label>
        <input type="text" class="form-control mask-bigalphanum" id="no_registrasi" name="no_registrasi" value="<?=old('no_registrasi')?>" required>
      </div>
      <div class="mb-3">
        <label for="nameInput" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control mask-bigname" id="nama_lengkap" name="nama_lengkap" value="<?=old('nama_lengkap')?>" required>
      </div>
      <div class="mb-3">
        <label for="kode_test" class="form-label">Kode Test</label>
        <input type="text" class="form-control mask-bigalphanum" id="kode_test" name="kode_test" value="<?=old('kode_test')?>" required>
      </div>
      <div class="mb-3">
        <label for="pilihDesa">Pilihan Desa</label>
		<input type="hidden" name="desaId" id="desaId" value="<?=old('desa_id')?>">
        <select class="form-control" id="pilihDesa" name="desa_id" required> </select>
      </div>
      <div class="mb-3">
        <label for="captcha" class="form-label"><?=$captcha['x'] . ' + ' . $captcha['y'] . ' =  ?'?></label>
		<input type="hidden" name="x" value="<?=$captcha['x']?>" id="x">
		<input type="hidden" name="y" value="<?=$captcha['y']?>" id="y">
        <input type="text" class="form-control mask-num3" id="captcha" name="captcha" value="<?=old('captcha')?>" required>
      </div>
      <button type="button" name="lanjut" id="btn-registrasi" data-target="#konfirmasi-form" class="btn btn-lg btn-primary btn-block">LANJUT</button>


	  <!-- Modal -->
		<div class="modal fade" id="konfirmasi-form" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="staticBackdropLabel">KONFIRMASI DATA PENDAFTARAN</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
				  <div class="alert alert-info mb-4" role="alert">
				      <h4 class="text-center">SILAHKAN PERIKSA DATA ANDA</h4>
					  <div class="mb-4">
					      <ol>
						  	<li>Pastikan Nomor Registrasi, Nama, Kode Test dan Pilihan Desa anda sudah benar.</li>
							<li>Setelah Anda menekan tombol "Lanjut", data tidak akan dapat diubah.</li>
							<li>Berikut ini adalah data yang sudah Anda masukkan:
								<p class="p-3 bg-dark mt-3 text-white rounded">Nomor Registrasi : <span id="noreg">111</span><br>
								Nama Lengkap     : <span id="nama">111</span><br>
								Kode Test        : <span id="kdtest">111</span><br>
								Desa             : <span id="desa">111</span> </p>
							</li>
							<li>Silahkan klik tombol “YA, LANJUT” Jika anda yakin sudah memasukkan data dengan benar, atau klik tombol “BATAL, PERBAIKI INPUT" untuk kembali ke inputan registrasi.</li>
					      </ol>
					    </div>
				    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" name="batal" class="btn btn-secondary" data-dismiss="modal">BATAL, PERBAIKI INPUT</button>
		        <button type="submit" name="konfirmasi" class="btn btn-primary">YA, LANJUT</button>
		      </div>
		    </div>
		  </div>
		</div>
    </form>
  </div>
</div>
</div>
<div class="col-12 col-md-5">
	<img src="<?=$theme_url?>images/sign_up.png" alt="" class="img-fluid animate__animated animate__pulse animate__slower animate__infinite">
</div>