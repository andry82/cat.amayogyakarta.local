<div class="table-responsive d-flex justify-content-center">
	<?=form_open('', 'role="form" class="col-6"', ['id' => $id])?>
	<table class="table table-bordered table-detail">
        <thead>                                
            <tr class="table-success">
                <th colspan="3">UBAH PASSWORD</th>
			</tr>
		</thead>
		<tbody> 
			<tr>
				<td></td>
                <td>PASSWORD BARU</td>
                <td>
					<div class="input">
						<input type="text" name="password" value="" class="form-control" required>
					</div>
				</td>
			</tr>
			<tr class="submit">
				<td></td>
				<td></td>
				<td>
					<input type="submit" class="btn btn-primary" value="Perbarui" name="submit">
				</td>
			</tr>
        </tbody>
	</table>
	<?=form_close()?>
</div>