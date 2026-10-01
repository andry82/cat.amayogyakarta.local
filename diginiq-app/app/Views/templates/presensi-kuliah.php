<div class="container">
<a href="<?=site_url('admin/perkuliahan/rekapPresensi/' . $jadwalId)?>" class="btn btn-primary"><i class="fa fa-arrow-left mr-2"></i> Kembali</a>
<?php
	if (count_array($data)>0) :
	echo form_open($config['actionURL'], 'class="form"', [
		'jadwal_id' => $jadwalId,
		'id'        => $data['id'],
		'dosen_id'  => $dosen_id,
		'ke'        => $ke,
	]); ?>
	<div class="col-lg-6 mx-auto">
		<div class="d-flex justify-content-center h5 font-weight-bold">PRESENSI KULIAH</div>
		<div class="d-flex justify-content-center h5 font-weight-bold"><?=$thnAkademik['nama']?></div>
		<div class="d-flex justify-content-center h5 font-weight-bold"><span class="mt-2">PERTEMUAN KE - <?=$ke?></div>
		<div class="d-flex justify-content-center h5 font-weight-bold mt-4">
			TANGGAL : <input type="text" name="tgl" data-date-format="dd-mm-yyyy" id="tgl" data-id="<?=$data['id']?>" class="form-control datepicker col-lg-2 ml-2 p-3" value="<?=convertDateFormat(post_data('tgl', $data))?>">	
		</div>
	</div>

	<div class="row justify-content-center mb-3">
		<div class="card elevation-3 col-sm-10 p-3 m-3">
			<div class="table-responsive">	
	            <table class="table table-bordered table-detail">
	                <thead>                                
	                    <tr class="table-warning">
	                        <th colspan="3">POKOK BAHASAN MATAKULIAH <?=implode(' ', [$data['kode_mk'], $data['nama_mk'], $data['SKS'], 'SKS'])?></th>
						</tr>
					</thead>
					<tbody id="bahasan">
						<tr>
							<td></td>
	                        <td>POKOK BAHASAN</td>
	                        <td>
								<textarea class="form-control" name="pokok" id="pokok" rows="5"><?=nl2br(post_data('pokok', $data))?></textarea>
							</td>
	                    </tr>
						<tr>
							<td></td>
	                        <td>SUB POKOK BAHASAN</td>
	                        <td>
								<textarea class="form-control" name="sub_pokok" id="sub_pokok" rows="5"><?=nl2br(post_data('sub_pokok', $data))?></textarea>
							</td>
	                    </tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="card elevation-3 col-lg-6 p-3 m-3">
			<div class="table-responsive">
				<table class="table datatable-grid table-striped table-responsive-stack" data-info="false" data-paging="false" id="grid-presensi">
					<thead>
						<tr class="bg-primary">
							<th width="20">No.</th>
							<th>Mahasiswa</th>
							<th width="90">Status </th>
						</tr>
					</thead>
					<tbody>
					<?php $no = 0;
					foreach ($list as $row)
					{
						$no++;
						$statClass = $row['stat'] === 'Alpa' ? 'class="bg-danger"' : ($row['stat'] === 'Ijin' ? 'class="bg-info"' : ($row['stat'] === 'Sakit' ? 'class="bg-warning"' : ''));
						?>
						<tr <?=$statClass?>>
							<td><?=$no?></td>
							<td><?=implode(' - ', [$row['NIM_DIKTI'], $row['nama_mhs']])?></td>
							<td>
								<?php
								$status = [
									'Hadir' => 'Hadir',
									'Ijin'  => 'Ijin',
									'Sakit' => 'Sakit',
									'Alpa'  => 'Alpa',
								];
								echo form_dropdown('stat[' . $row['krs_id'] . '][' . $row['id'] . ']', $status, $row['stat'], 'class="form-control status" data-krs_id="' . $row['krs_id'] . '"');
								?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
				        <tr>
				           <th class="unfilter"></th>
				           <th data-text="Mahasiswa"></th>
				           <th class="unfilter"></th>
						</tr>
					</tfoot>
				</table>
			</div>

			<button type="submit" class="btn btn-success" id="simpan" onclick="this.form.submit(); this.disabled=true; this.innerHTML='Simpan data...';"><i class="fa fa-save mr-3"></i>Simpan Pokok Bahasan dan Presensi</button> 

		</div>
	</div>
	<?php 
	echo form_close();
	else :
	echo alert('danger', 'Presensi kosong.', 'Tidak ada mahasiswa yang mengambil KRS matakuliah ini', false);
	endif;
	?>
</div>

<script>
	var presensiURL = '<?=$config['presensiURL']?>';
</script>