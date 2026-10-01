<div class="row">
    <div class="col d-flex justify-content-center elevation-2 card-table">
		<?=form_open(site_url('admin/user/form' . (empty($id) ? '' : '/' . $id)), 'role="form" class="col"');
		if ($id)
		{
			echo form_hidden('id', $id);
		} ?>

		<table class="table table-bordered my-3" id="user-form">
	        <thead>                                
	            <tr class="table-primary">
	                <th colspan="3">
						<?php if ($id) : ?>
							<a href="#detail-user" class="edit" data-id="ubah"><i class="fas fa-pencil-alt"></i></a> UBAH DATA USER</th>
						<?php else : ?>
						<i class="fas fa-plus mr-3"></i></a>TAMBAH USER BARU</th>
						<?php endif; ?>
				</tr>
			</thead>
			<tbody id="detail-user"> 
				<tr>
					<td width="20"></td>
	                <td width="200">Nama</td>
	                <td>
						<div class="input col-3">
							<input type="text" class="form-control" required name="fullname" value="<?=post_data('fullname', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Email</td>
	                <td>
						<div class="input col-6">
							<input type="email" class="form-control" required name="email" value="<?=post_data('email', $data)?>">
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Password</td>
	                <td>
						<div class="input col-6">
							<input type="password" class="form-control" name="password" value="<?=post_data('password', $data)?>">
						</div>
						<help><i>Biarkan kosong, jika tidak ingin ubah password</i></help>
					</td>
				</tr>
				<tr>
					<td></td>
	                <td>Level</td>
	                <td>
						<div class="input col-3">
							<?php echo form_dropdown("role_id", $roles, post_data('role_id', $data), 'id="role_id" class="form-control" required'); ?>
						</div>
					</td>
				</tr>
				<?php if ($id) : ?>
				<tr>
					<td></td>
	                <td>Status</td>
	                <td>
						<div class="input col-3">
							<?php echo form_dropdown("active", [0 => 'Terkunci (Tidak Aktif)', 1 => 'Aktif'], post_data('active', $data), 'id="active" class="form-control" required'); ?>
						</div>
					</td>
				</tr>
				<?php endif; ?>
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
		<?=form_close()?>
	</div>
</div>
