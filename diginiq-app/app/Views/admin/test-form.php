<div class="row">
    <div class="col d-flex justify-content-center elevation-2 card-table">
		<?=form_open(site_url('admin/test/form' . (empty($id) ? '' : '/' . $id)), 'role="form" class="col"');
		if ($id)
		{
			echo form_hidden('id', $id);
		} ?>

		<table class="table table-bordered my-3" id="test-form">
	        <thead>                                
	            <tr class="table-primary">
	                <th colspan="3">
						<?php if ($id) : ?>
							<a href="#detail-test" class="edit" data-id="ubah"><i class="fas fa-pencil-alt"></i></a> UBAH DATA TEST</th>
						<?php else : ?>
						<i class="fas fa-plus mr-3"></i></a>TAMBAH TEST BARU</th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody id="detail-test"> 
				<tr>
					<td width="20"></td>
	                <td width="200">Kode Test</td>
	                <td>
						<div class="input col-3">
							<input type="text" class="form-control" required name="kode_test" value="<?=post_data('kode_test', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Nama Test</td>
	                <td>
						<div class="input col-6">
							<input type="text" class="form-control" required name="nama_test" value="<?=post_data('nama_test', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Tanggal Test</td>
	                <td>
						<div class="input col-2">
							<input type="text" class="datepicker form-control" required name="tanggal_test" value="<?=convertDateFormat(post_data('tanggal_test', $data), 'Y-m-d H:i:s')?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Bank Soal yang digunakan</td>
	                <td>
						<div class="input col-3">
							<?php echo form_dropdown("bank_soal", $soal, post_data('bank_soal', $data), 'id="bank_soal" class="form-control" required'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Batas Waktu Tes Tertulis</td>
	                <td>
						<div class="input col-1">
							<input type="text" class="form-control mask-num3" required name="timer_tes_tertulis" value="<?=post_data('timer_tes_tertulis', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Jumlah Soal Tes Tertulis</td>
	                <td>
						<div class="input col-1">
							<input type="text" class="form-control mask-num" required name="jumlah_soal_tertulis" value="<?=post_data('jumlah_soal_tertulis', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Nilai Poin Jawaban Benar Tes Tertulis</td>
	                <td>
						<div class="input col-1">
							<input type="text" class="form-control mask-num2" required name="poin_tes_tertulis" value="<?=post_data('poin_tes_tertulis', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td colspan="2">
						<div class="input">
							<label for="praktik">
								<input type="checkbox" class="status-label" id="praktik" name="ada_tes_praktik" value="1" <?=checked_data('ada_tes_praktik', '1', $data)?>>
								Ada Tes Praktik
							</label>
						</div>
					</td>
				</tr>
				<tr class="praktik">
					<td></td>
	                <td>Batas Waktu Tes Praktik</td>
	                <td>
						<div class="input col-1">
							<input type="text" class="form-control mask-num3" name="timer_tes_praktik" value="<?=post_data('timer_tes_praktik', $data)?>">
						</div>
					</td>
				</tr>
				<tr class="praktik">
					<td></td>
	                <td>Prosentase Ujaian Praktik MS Word</td>
	                <td>
						<div class="input col-1">
							<input type="text" class="form-control mask-num3" name="prosentase_word" value="<?=post_data('prosentase_word', $data)?>">
						</div>
					</td>
				</tr>
				<tr class="praktik">
					<td></td>
	                <td>Prosentase Ujaian Praktik MS Excel</td>
	                <td>
						<div class="input col-1">
							<input type="text" class="form-control mask-num3" name="prosentase_excel" value="<?=post_data('prosentase_excel', $data)?>">
						</div>
					</td>
				</tr>
				<tr class="praktik">
					<td></td>
	                <td>Prosentase Ujaian Praktik MS Power Point</td>
	                <td>
						<div class="input col-1">
							<input type="text" class="form-control mask-num3" name="prosentase_ppt" value="<?=post_data('prosentase_ppt', $data)?>">
						</div>
					</td>
				</tr>
				<tr class="praktik">
					<td></td>
	                <td>Prosentase Ujaian Praktik Email</td>
	                <td>
						<div class="input col-1">
							<input type="text" class="form-control mask-num3" name="prosentase_email" value="<?=post_data('prosentase_email', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td colspan="2">
						<div class="input">
							<label for="status">
								<input type="checkbox" class="status-label" id="status" name="status" value="1" <?=checked_data('status', '1', $data)?>>
								Publish
							</label>
						</div>
						<help><i>Pastikan Jumlah Soal per Kategori sudah disetting di <a href="<?=site_url('admin/bank_soal')?>">Menu Bank Soal</a> sebelum Test dibuka untuk umum, <br>
						karena jumlah soal yang akan dimunculkan ke peserta berdasarkan pengaturan Jumlah Soal per Kategori.<br>
						<strong>Total jumlah soal per kategori harus sama dengan Jumlah soal tertulis yang disetting di sini.</strong></i></help>
					</td>
				</tr>
				<tr class="submit">
					<td></td>
					<td></td>
					<td>
						<input type="submit" class="btn btn-primary mr-2" value="Simpan" name="submit">
						<a href="<?= (empty($id) ? site_url('admin/test') : '#no-id')?>" class="btn btn-danger <?=empty($id) ? '' : 'cancel'?>">Batal</a>
					</td>
				</tr>
			</tbody>
		</table>
		
		<ul class="nav nav-tabs" id="tabTest" role="tablist">
			<li class="nav-item" role="presentation">
				<a class="nav-link active" id="desa-tab" data-toggle="tab" href="#desa" role="tab" aria-controls="desa" aria-selected="true">LIST DESA</a>
			</li>
			<li class="nav-item" role="presentation">
				<a class="nav-link" id="soal-tab" data-toggle="tab" href="#soal" role="tab" aria-controls="soal" aria-selected="false">SOAL TES</a>
			</li>
			<li class="nav-item" role="presentation">
				<a class="nav-link" id="peserta-tab" data-toggle="tab" href="#peserta" role="tab" aria-controls="peserta" aria-selected="false">LIST PESERTA</a>
			</li>
			<li class="nav-item" role="presentation">
				<a class="nav-link" id="pewawancara-tab" data-toggle="tab" href="#pewawancara" role="tab" aria-controls="pewawancara" aria-selected="false">LIST PEWAWANCARA</a>
			</li>
		</ul>
		<div class="tab-content m-3 small-tab" id="tabContent">
			<div class="tab-pane fade show active" id="desa" role="tabpanel" aria-labelledby="desa-tab">
				<div class="d-flex justify-content-end">
					<a href="#" data-backdrop="static" class="btn btn-default btn-desa mb-3" data-target="#modal-desa" data-test_id="<?=$id?>" data-nama=""><i class="fa fa-plus text-success mr-2"></i>Tambah Data Desa</a>
				</div>
				<?php if (empty($desa)) : ?>
					<p>Belum ada data desa.</p>
				<?php else : ?>
					<table class="table table-striped table-bordered datatable-grid" id="table-desa">
						<thead>
							<tr>
								<th width="20">No</th>
								<th>Nama Desa</th>
								<th width="30">#</th>
							</tr>
						</thead>
						<tbody>
				<?php $i = 0; foreach ($desa as $row) : $i++; ?>
							<tr>
								<td><?=$i?></td>
								<td><?=$row['nama_desa']?></td>
								<td>
									<a href="#" class="btn-desa" data-backdrop="static" data-target="#modal-desa" data-id="<?=$row['id']?>" data-nama="<?=$row['nama_desa']?>"><i class="fa fa-edit text-primary"></i></a>
									<a href="#" class="btn-del-desa ml-2" data-id="<?=$row['id']?>" data-nama="<?=$row['nama_desa']?>" title="Hapus Desa"><i class="fa fa-trash text-danger"></i></a>
								</td>
							</tr>
				<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>

			<div class="tab-pane fade" id="soal" role="tabpanel" aria-labelledby="soal-tab">
				<table class="table table-striped table-bordered" id="table-soal">
					<thead>
						<tr>
							<th width="20">No</th>
							<th>Pertanyaan</th>
							<th width="200">Pilihan</th>
							<!-- <th width="20">Jawaban</th> -->
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

			<div class="tab-pane fade" id="peserta" role="tabpanel" aria-labelledby="peserta-tab">
				<?php if (empty($peserta)) : ?>
					<p>Belum ada data peserta.</p>
				<?php else : ?>
					<table class="table table-striped table-bordered datatable-grid" id="table-peserta">
						<thead>
							<tr>
								<th width="20">No</th>
								<th>Nomor Registrasi</th>
								<th>Nama Peserta</th>
								<th>Desa</th>
								<th width="100">Hasil</th>
							</tr>
						</thead>
						<tbody>
				<?php $i = 0; foreach ($peserta as $row) : $i++; ?>
							<tr>
								<td><?=$i?></td>
								<td><?=$row['no_registrasi']?></td>
								<td><?=$row['nama_lengkap']?></td>
								<td><?=$row['nama_desa']?></td>
								<td><a href="<?=site_url('admin/test/showResult/' . $row['no_registrasi'])?>"><i class="fa fa-search"></i></a></td>
							</tr>
				<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>

			<div class="tab-pane fade" id="pewawancara" role="tabpanel" aria-labelledby="pewawancara-tab">
				<div class="d-flex justify-content-end">
					<a href="#" data-backdrop="static" class="btn btn-default float-right btn-interview mb-3" data-target="#modal-interview" data-id="" data-nama=""><i class="fa fa-plus text-success mr-2"></i>Tambah Data Pewawancara</a>
				</div>
				<?php if (empty($pewawancara)) : ?>
					<p>Belum ada data Pewawancara.</p>
				<?php else : ?>
					<table class="table table-striped table-bordered datatable-grid" id="table-pewawancara">
						<thead>
							<tr>
								<th width="20">No</th>
								<th>Nama Pewawancara</th>
								<th width="30">#</th>
							</tr>
						</thead>
						<tbody>
				<?php $i = 0; foreach ($pewawancara as $row) : $i++; ?>
							<tr>
								<td><?=$i?></td>
								<td><?=$row['fullname']?></td>
								<td>
									<a href="#" class="btn-interview" data-backdrop="static" data-target="#modal-interview" data-id="<?=$row['id']?>" data-uid="<?=$row['user_id']?>" data-nama="<?=$row['fullname']?>"><i class="fa fa-edit text-primary"></i></a>
									<a href="#" class="btn-del-int ml-2" data-id="<?=$row['id']?>" data-nama="<?=$row['fullname']?>" title="Hapus Pewawancara"><i class="fa fa-trash text-danger"></i></a>
								</td>
							</tr>
				<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>
			</div>
		</div>

		<div class="modal fade" id="modal-desa" tabindex="-1" role="dialog" aria-labelledby="modalDesa" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title font-weight" id="desaTest"></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

			  <input type="hidden" name="desa_id" id="desa_id">
			  <input type="hidden" class="kode_test" required name="kode_test" value="<?=post_data('kode_test', $data)?>">

		      <div class="modal-body jsutify-content-center">
				<div class="form-row">
				    <div class="col-3 text-right">
						<label for="nama_desa">Nama Desa</label>
				    </div>
				    <div class="col">
						<div class="input">
				      		<input type="text" class="form-control mask-bigname" name="nama_desa" id="nama_desa" value="">
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
		<?=form_close()?>


		<div class="modal fade" id="modal-interview" tabindex="-1" role="dialog" aria-labelledby="modalWawancara" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
		    <div class="modal-content">
				<?=form_open(site_url('admin/test/pewawancara'), 'role="form"', [
					'testId'    => $id ?? '',
				]); ?>
				  <input type="hidden" class="kode_test" required name="kode_test" value="<?=post_data('kode_test', $data)?>">

			      <div class="modal-header">
			        <h5 class="modal-title font-weight" id="interviewer"></h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

				  <input type="hidden" name="pewawancara_id" id="pewawancara_id">
			      <div class="modal-body jsutify-content-center">
					<div class="form-row">
					    <div class="col-3 text-right">
							<label for="nama_desa">Nama Pewawancara</label>
					    </div>
					    <div class="col">
							<div class="input">
					      		<?=form_dropdown('user_id', $userWawancara, post_data('user_id', ''), 'id="user_id" class="form-control"')?>
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
	</div>
</div>
