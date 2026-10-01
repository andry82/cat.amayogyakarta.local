<div class="row">
    <div class="col d-flex justify-content-center elevation-2 card-table">
		<?=form_open(site_url('admin/secret'), 'role="form" class="col"'); ?>

		<table class="table table-bordered my-3" id="user-form">
	        <thead>                                
	            <tr class="table-primary">
	                <th colspan="3">ATUR PASSWORD UNTUK TOMBOL RAHASIA</th>
				</tr>
			</thead>
			<tbody id="detail-user"> 
				<tr>
					<td width="20"></td>
	                <td width="200">PASSWORD BARU</td>
	                <td>
						<div class="input col-3">
							<input type="text" class="form-control" required name="secretKey" value="<?=post_data('secretKey', $data['value'])?>">
						</div>
					</td>
				</tr>
				<tr class="submit">
					<td></td>
					<td></td>
					<td>
						<input type="submit" class="btn btn-primary mr-2" value="Simpan" name="submit">
						<a href="<?= site_url('admin/secret')?>" class="btn btn-danger">Batal</a>
					</td>
				</tr>
			</tbody>
		</table>
		<?=form_close()?>
	</div>
</div>
