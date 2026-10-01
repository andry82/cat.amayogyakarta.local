<div class="mb-3">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col col-sm-10">
			<?php if ($isAdmin) : ?>
			<a href="<?=site_url('admin/mahasiswa/downloadDetail/' . $data['id'])?>" target="_blank" class="btn btn-primary text-white">Unduh Data</a>
			<?php endif; ?>
			<?=form_open($actionURL, 'role="form" id="form-camaba"', [
				'id'        => post_data('id', $data),
				'user_id'   => post_data('user_id', $data),
				'profil_id' => post_data('profil_id', $data),
			]);
			if (! empty($changes)) : ?>
			<span class="mx-2 text-danger small font-italic">*) Data perubahan sedang dalam proses pengajuan ke Admin SIAKAD</span>
			<?php endif; ?>
			<div id="data-akun" class="mb-5"></div>
				<div class="table-responsive elevation-3">
	                <table class="table table-bordered table-detail">
	                    <thead>                                
	                        <tr class="table-success">
	                            <th colspan="3"><a href="#data-akun" class="edit" data-id="akun"><i class="fas fa-pencil-alt"></i></a> DATA MAHASISWA</th>
							</tr>
						</thead>
						<tbody id="akun">
							<tr>
								<td></td>
	                            <td>EMAIL</td>
	                            <td>
									<div class="label"><?=$data['email']?><?=change_data('email', $changes)?></div>
									<div class="input d-none"><input type="text" name="email" id="email" class="form-control mask-email" value="<?= post_change_data('email', $data, $changes) ?>" placeholder="email" required ></div>
								</td>
	                        </tr>
							<tr>
								<td></td>
	                            <td>NOMOR HANDPHONE</td>
	                            <td>
									<div class="label"><?=$data['no_hp']?><?=change_data('no_hp', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="no_hp" id="no_hp" class="form-control mask-hp" value="<?= post_change_data('no_hp', $data, $changes) ?>" placeholder="Nomor Handphone">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
	                            <td>NOMOR KARTU KELUARGA</td>
	                            <td>
									<div class="label"><?=$data['no_kk']?><?=change_data('no_kk', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="no_kk" id="no_kk" class="form-control mask-nik" value="<?= post_change_data('no_kk', $data, $changes) ?>" placeholder="">
									</div>
								</td>
	                        </tr>
	                        <tr>
								<td></td>
	                            <td>NOMOR INDUK KEPENDUDUKAN (NIK)</td>
	                            <td>
									<div class="label"><?=$data['nik']?><?=change_data('nik', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="nik" id="nik" class="form-control mask-nik" value="<?= post_change_data('nik', $data, $changes) ?>" placeholder="NIK">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
	                            <td>NAMA LENGKAP</td>
	                            <td>
									<div class="label"><?=$data['Nama']?><?=change_data('Nama', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="Nama" id="Nama" class="form-control mask-bigname-custom" value="<?= post_change_data('Nama', $data, $changes) ?>" placeholder="Nama Lengkap" required >
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
	                            <td>TEMPAT LAHIR</td>
	                            <td>
									<div class="label"><?=$data['t4_lhr']?><?=change_data('t4_lhr', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="t4_lhr" id="t4_lhr" class="form-control mask-bigname-custom" value="<?= post_change_data('t4_lhr', $data, $changes) ?>" placeholder="Tempat" required >
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
	                            <td>TANGGAL LAHIR</td>
	                            <td>
									<div class="label"><?=convertDateFormat($data['tgl_lhr'])?><?=change_data('tgl_lhr', $changes, 'convertDateFormat')?></div>
									<div class="input d-none">
										<input type="text" name="tgl_lhr" id="tgl_lhr" class="form-control datepicker" value="<?= convertDateFormat(post_change_data('tgl_lhr', $data, $changes)) ?>" placeholder="Tanggal Lahir" data-date-end-date="31-12-2006" required >
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
	                            <td>JENIS KELAMIN</td>
	                            <td>
									<?php $sex = ['L' => 'LAKI-LAKI', 'P' => 'PEREMPUAN'];?>
									<div class="label"><?=$sex[$data['jenis_kelamin']]??''?><?=strtr(change_data('jenis_kelamin', $changes), $sex)?></div>
									<div class="input d-none">
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" id="jenis_kelamin_l" name="jenis_kelamin" value="L" <?=post_change_data('jenis_kelamin', $data, $changes) === 'L' ? 'checked' : ''?> class="custom-control-input">
										  <label class="custom-control-label" for="jenis_kelamin_l">Laki-laki</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" id="jenis_kelamin_p" name="jenis_kelamin" value="P" <?=post_change_data('jenis_kelamin', $data, $changes) === 'P' ? 'checked' : ''?> class="custom-control-input">
										  <label class="custom-control-label" for="jenis_kelamin_p">Perempuan</label>
										</div>
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
	                            <td>AGAMA</td>
	                            <td>
									<div class="label"><?=$data['agama']?><?=change_data('agama', $changes)?></div>
									<div class="input d-none">
									<?php $agama = [
											"Islam"     => 'Islam',
											"Protestan" => 'Protestan',
											"Katolik"   => 'Katolik',
											"Hindu"     => 'Hindu',
											"Buddha"    => 'Buddha',
											"Konghuchu" => 'Konghuchu',
										];

										$agama = array_map('strtoupper', array_change_key_case($agama, CASE_UPPER));

										echo form_dropdown("agama", $agama, post_change_data('agama', $data, $changes), 'id="agama" class="form-control" required'); ?>
									</div>
	                            </td>
	                        </tr>
	                        <tr>
								<td></td>
	                            <td colspan="2">ALAMAT LENGKAP</td>
							<tr>
								<td></td>
								<td>JL / DUKUH</td>
	                            <td>
									<div class="label"><?=$data['jalan_dukuh']?><?=change_data('jalan_dukuh', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="jalan_dukuh" id="jalan_dukuh" class="form-control mask-bigalphanum" value="<?= post_change_data('jalan_dukuh', $data, $changes) ?>" placeholder="">
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>RT / RW</td>
								<td>
									<div class="label"><?=$data['rt'] . '/' . $data['rw'] . change_data('rt', $changes) . '/' . change_data('rw', $changes)?></div>
									<div class="input d-none form-inline">
										<div class="form-group">
											<label for="rt" class="pr-2">RT </label>
											<input type="text" name="rt" id="rt" class="form-control mt-2 col-md-2 mask-num3" value="<?= post_change_data('rt', $data, $changes) ?>" placeholder="">
											<label for="rw" class="pl-2 pr-2">RW </label>
											<input type="text" name="rw" id="rw" class="form-control mt-2 col-md-2 mask-num3" value="<?= post_change_data('rw', $data, $changes) ?>" placeholder="">
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>KELURAHAN / DESA</td>
								<td>
									<div class="label"><?=$data['kelurahan_desa']?><?=change_data('kelurahan_desa', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="kelurahan_desa" id="kelurahan_desa" class="form-control mt-2 mask-bigname" value="<?= post_change_data('kelurahan_desa', $data, $changes) ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>KECAMATAN</td>
								<td>
									<div class="label"><?=$data['kecamatan']?><?=change_data('kecamatan', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="kecamatan" id="kecamatan" class="form-control mt-2 mask-bigname" value="<?= post_change_data('kecamatan', $data, $changes) ?>">
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>KABUPATEN</td>
								<td>
									<div class="label"><?=$data['kabupaten']?><?=change_data('kabupaten', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="kabupaten" id="kabupaten" class="form-control mt-2 mask-bigname" value="<?= post_change_data('kabupaten', $data, $changes) ?>">
									</div>
								</td>
	                        </tr>
	                        <tr>
								<td></td>
	                            <td>PROPINSI</td>
	                            <td>
									<div class="label"><?=$data['propinsi']?><?=change_data('propinsi', $changes)?></div>
									<div class="input d-none">
										<?=form_dropdown("propinsi", $propinsi, post_change_data('propinsi', $data, $changes), 'id="propinsi" class="form-control mt-2"')?>
									</div>
								</td>
	                        </tr>
	                        <tr>
								<td></td>
	                            <td>KODE POS</td>
	                            <td>
									<div class="label"><?=$data['kode_pos']?><?=change_data('kode_pos', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="kode_pos" id="kode_pos" class="form-control mt-2 mask-num5" value="<?= post_change_data('kode_pos', $data, $changes)?>">
									</div>
								</td>
	                        </tr>
							<tr class="submit d-none">
								<td></td>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Perbarui" name="submit">
									<input type="reset" class="btn btn-danger cancel" value="Batal" name="cancel">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="data-pendidikan" class="mb-5"></div>
				<div class="table-responsive elevation-3">
					<table class="table table-bordered table-detail">
	                    <thead>                                
	                        <tr class="table-info">
	                            <th colspan="3"><a href="#data-pendidikan" class="edit" data-id="pendidikan"></i></a>DATA PENDIDIKAN</th>
							</tr>
						</thead>
						<tbody id="pendidikan"> 
							<tr>
								<td></td>
	                            <td>PROGRAM STUDI</td>
	                            <td>
									<div class="label"><?=$progdiPilihan[$data['kode_jurusan']]?></div>
									<div class="input d-none">
										<?php echo form_dropdown("kode_jurusan", $progdiPilihan, old('kode_jurusan', $data['kode_jurusan']), 'id="kode_jurusan" class="form-control" required disabled'); ?>
									</div>
								</td>
							</tr>
	                        <tr>
								<td></td>
	                            <td>KONSENTRASI</td>
	                            <td>
									<div class="label"><?=$data['konsentrasi_progdi']; ?></div>
									<div class="input d-none">
									<?php echo form_dropdown("konsentrasi_progdi", array_filter($konsentrasi), old('konsentrasi_progdi', $data['konsentrasi_progdi']), 'id="konsentrasi_progdi" class="form-control" required autofocus'); ?>
									</div>
								</td>
	                        </tr>
	                        <tr>
								<td></td>
	                            <td>DOSEN WALI</td>
	                            <td>
									<div class="label"><?=$dosenWali[$data['Dosen_id']]??''?></div>
									<div class="input d-none">
									<?php echo form_dropdown("Dosen_id", $dosenWali, old('Dosen_id', $data['Dosen_id']), 'id="Dosen_id" class="form-control" required="required"'); ?>
									</div>
								</td>
	                        </tr>
	                        <tr>
								<td></td>
	                            <td>KODE KELAS</td>
	                            <td>
									<div class="label"><?=$kelas[$data['Program_id']]??''?></div>
									<div class="input d-none">
									<?php echo form_dropdown("Program_id", $kelas, old('Program_id', $data['Program_id']), 'id="Program_id" class="form-control" required="required"'); ?>
									</div>
								</td>
	                        </tr>
							<tr class="submit d-none">
								<td></td>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Perbarui" name="submit">
									<input type="reset" class="btn btn-danger cancel" value="Batal" name="cancel">
								</td>
							</tr>
	                    </tbody>
					</table>
				</div>
				<div id="data-wali" class="mb-5"></div>
				<div class="table-responsive elevation-3">
					<table class="table table-bordered table-detail">
	                    <thead>                                
	                        <tr class="table-primary">
	                            <th colspan="3"><a href="#data-wali" class="edit" data-id="wali"><i class="fas fa-pencil-alt"></i></a>DATA ORANG TUA / WALI</th>
							</tr>
						</thead>
						<tbody id="wali">
							<tr>
								<td></td>
								<td>NAMA AYAH KANDUNG</td>
	                            <td>
									<div class="label"><?=$data['ayah_kandung']?><?=change_data('ayah_kandung', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="ayah_kandung" id="ayah_kandung" class="form-control mask-bigname" value="<?= old('ayah_kandung', $data['ayah_kandung']) ?>">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
								<td>PEKERJAAN AYAH</td>
	                            <td>
									<div class="label"><?=$data['pekerjaan_ayah']?><?=change_data('pekerjaan_ayah', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" class="form-control mask-bigname" value="<?= old('pekerjaan_ayah', $data['pekerjaan_ayah']) ?>">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
								<td>NAMA IBU KANDUNG</td>
	                            <td>
									<div class="label"><?=$data['ibu_kandung']?><?=change_data('ibu_kandung', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="ibu_kandung" id="ibu_kandung" class="form-control mask-bigname-custom" value="<?= old('ibu_kandung', $data['ibu_kandung']) ?>">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
								<td>PEKERJAAN IBU</td>
	                            <td>
									<div class="label"><?=$data['pekerjaan_ibu']?><?=change_data('pekerjaan_ibu', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" class="form-control mask-bigname" value="<?= old('pekerjaan_ibu', $data['pekerjaan_ibu']) ?>">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
								<td>NAMA WALI</td>
	                            <td>
									<div class="label"><?=$data['nama_wali']?><?=change_data('nama_wali', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="nama_wali" id="nama_wali" class="form-control mask-bigname" value="<?= old('nama_wali', $data['nama_wali']) ?>">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
								<td>PEKERJAAN WALI</td>
	                            <td>
									<div class="label"><?=$data['pekerjaan_wali']?><?=change_data('pekerjaan_wali', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="pekerjaan_wali" id="pekerjaan_wali" class="form-control mask-bigname" value="<?= old('pekerjaan_wali', $data['pekerjaan_wali']) ?>">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
								<td>PENDAPATAN (GAJI) RATA-RATA ORANG TUA / WALI SETIAP BULAN</td>
	                            <td>
									<div class="label"><?=rupiah($data['gaji_perbulan'])?><?=change_data('gaji_perbulan', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="gaji_perbulan" id="gaji_perbulan" class="form-control text-right mask-uang" value="<?= old('gaji_perbulan', $data['gaji_perbulan']) ?>">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
								<td>JUMLAH TANGGUNGAN ORANG TUA / WALI</td>
	                            <td>
									<div class="label"><?=$data['jumlah_tanggungan']?><?=change_data('jumlah_tanggungan', $changes)?></div>
									<div class="input d-none">
										<input type="number" name="jumlah_tanggungan" id="jumlah_tanggungan" class="form-control mask-num3" value="<?= old('jumlah_tanggungan', $data['jumlah_tanggungan']) ?>">
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
								<td>NOMOR HP ORANG TUA / WALI</td>
	                            <td>
									<div class="label"><?=$data['no_hp_ortu']?><?=change_data('no_hp_ortu', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="no_hp_ortu" id="no_hp_ortu" class="form-control mask-hp" value="<?= old('no_hp_ortu', $data['no_hp_ortu']) ?>" required>
									</div>
								</td>
	                        </tr>
							<tr class="submit d-none">
								<td></td>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Perbarui" name="submit">
									<input type="reset" class="btn btn-danger cancel" value="Batal" name="cancel">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="data-tambahan" class="mb-5"></div>
                <?php if ($data['status_awal_id'] === 'B') { ?>
                <div class="table-responsive elevation-3 mb-4">
					<table class="table table-bordered table-detail">
	                    <thead>                                
	                        <tr class="table-danger">
	                            <th colspan="3"><a href="#data-tambahan" class="edit" data-id="tambahan"><i class="fas fa-pencil-alt"></i></a>DATA TAMBAHAN</th>
							</tr>
						</thead>
						<tbody id="tambahan">
                            <tr>
								<td></td>
                                <td>NAMA SEKOLAH</td>
                                <td>
									<div class="label"><?=$data['asal_sekolah']?><?=change_data('asal_sekolah', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control mask-bigalphanum" value="<?= old('asal_sekolah', $data['asal_sekolah']) ?>">
									</div>
								</td>
                            </tr>
                            <tr>
								<td></td>
                                <td>ALAMAT SEKOLAH</td>
                                <td>
									<div class="label"><?=$data['alamat_sekolah']?><?=change_data('alamat_sekolah', $changes)?></div>
									<div class="input d-none">
										<textarea name="alamat_sekolah" id="alamat_sekolah" class="form-control mask-bigalphanum"><?=old('alamat_sekolah', $data['alamat_sekolah']) ?></textarea>
									</div>
								</td>
                            </tr>
							<tr>
								<td></td>
	                            <td>NISN</td>
	                            <td>
									<div class="label"><?=$data['nisn']?><?=change_data('nisn', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="nisn" id="nisn" class="form-control mask-num" value="<?= old('nisn', $data['nisn']) ?>">
									</div>
								</td>
	                        </tr>
	                        <tr>
								<td></td>
	                            <td>NPSN</td>
	                            <td>
									<div class="label"><?=$data['npsn']?><?=change_data('npsn', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="npsn" id="npsn" class="form-control mask-num" value="<?= old('npsn', $data['npsn']) ?>">
									</div>
								</td>
	                        </tr>
                            <tr>
								<td></td>
                                <td>TAHUN LULUS</td>
                                <td>
									<div class="label"><?=$data['tahun_lulus']?><?=change_data('tahun_lulus', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="tahun_lulus" id="tahun_lulus" class="form-control mask-num4" value="<?= old('tahun_lulus', $data['tahun_lulus']) ?>">
									</div>
								</td>
                            </tr>
							<tr class="submit d-none">
								<td></td>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Perbarui" name="submit">
									<input type="reset" class="btn btn-danger cancel" value="Batal" name="cancel">
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
                <?php } else { ?>
				<div class="table-responsive elevation-3 mb-4">
					<table class="table table-bordered table-detail">
	                    <thead>                                
	                        <tr class="table-danger">
	                            <th colspan="3"><a href="#data-tambahan" class="edit" data-id="tambahan"><i class="fas fa-pencil-alt"></i></a>DATA TAMBAHAN</th>
							</tr>
						</thead>
						<tbody id="tambahan">
                            <tr>
								<td></td>
                                <td>NAMA PERGURUAN TINGGI ASAL</td>
                                <td>
									<div class="label"><?=$data['asal_pt']?><?=change_data('asal_pt', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="asal_pt" id="asal_pt" class="form-control mask-bigalphanum" value="<?= old('asal_pt', $data['asal_pt']) ?>">
									</div>
								</td>
                            </tr>
                            <tr>
								<td></td>
                                <td>FAKULTAS</td>
                                <td>
									<div class="label"><?=$data['fakultas']?><?=change_data('fakultas', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="fakultas" id="fakultas" class="form-control mask-bigname" value="<?= old('fakultas', $data['fakultas']) ?>">
									</div>
								</td>
                            </tr>
                            <tr>
								<td></td>
                                <td>JURUSAN / PRODI</td>
                                <td>
									<div class="label"><?=$data['jurusan']?><?=change_data('jurusan', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="jurusan" id="jurusan" class="form-control mask-bigname" value="<?= old('jurusan', $data['jurusan']) ?>" placeholder="" required autofocus>
									</div>
								</td>
                            </tr>
                            <tr>
								<td></td>
                                <td>NIM</td>
                                <td>
									<div class="label"><?=$data['nim_lama']?><?=change_data('nim_lama', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="nim_lama" id="nim_lama" class="form-control mask-bigalphanum" value="<?= old('nim_lama', $data['nim_lama']) ?>">
									</div>
								</td>
                            </tr>
                            <tr>
								<td></td>
                                <td>SKS DIAKUI</td>
                                <td>
									<div class="label"><?=$data['sks_diakui']?><?=change_data('sks_diakui', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="sks_diakui" id="sks_diakui" class="form-control mask-num" value="<?= old('sks_diakui', $data['sks_diakui']) ?>">
									</div>
								</td>
                            </tr>
                            <tr>
								<td></td>
                                <td>SKS YANG AKAN DITEMPUH</td>
                                <td>
									<div class="label"><?=$data['sks_ditempuh']?><?=change_data('sks_ditempuh', $changes)?></div>
									<div class="input d-none">
										<input type="text" name="sks_ditempuh" id="sks_ditempuh" class="form-control mask-num" value="<?= old('sks_ditempuh', $data['sks_ditempuh']) ?>">
									</div>
								</td>
                            </tr>
                            <tr>
								<td></td>
                                <td>FILE KONVERSI</td>
								<?php $file = 'uploads/files/' . $data['file_konversi']; ?>
                                <td>
									<div class="label"><?=is_file(FCPATH . $file) ? '<a href="#' . base_url($file) . '" data-src="' . base_url($file) . '" class="prev-pdf">' . $data['file_konversi'] . '</a>' : '';?></div>
									<div class="input d-none">
									<?php
										echo form_open_multipart(site_url('admin/camaba/uploadBerkas'), ['role' => 'form'], ['id' => $data['id']]);
										$fieldName = 'file_konversi';
										$file      = $data[$fieldName];
										$uploaded  = is_file(FCPATH . $filePath . $file );
										$hideClass = $uploaded ? '' : 'has-upload- ' . $fieldName . ' d-none';
										$extFile   = pathinfo($file, PATHINFO_EXTENSION);
										$srcFile   = base_url($filePath . $file);
										$imgSource = $theme_url . 'images/file-icons/pdf.svg';
										?>
										<p class="file-header">&nbsp;<a href="#" data-field-name="<?=$fieldName?>" class="file-upload icon-upload-right"><i class="fa fa-upload text-primary"></i></a></p>
										<input type="file" name="<?=$fieldName?>" class="berkas-scan d-none" data-id="<?=$data['profil_id']?>" data-nim="<?=$data['NIM_DIKTI']?>" accept=".pdf">
					                    <div class="file-man-box border-<?=$uploaded ? 'primary' : 'danger'?>">
											<a href="#" class="file-close d-none"><i class="fa fa-times-circle text-danger"></i></a>
											<div class="file-img-box">
												<a href="#" class="prev-pdf" data-src="<?=$srcFile?>">
													<img src="<?=$imgSource?>" id="img-<?=$fieldName?>" class="has-upload <?=$hideClass?>" alt="icon">
												</a>
											</div>
											<a href="<?=$srcFile?>" download class="file-download has-upload <?=$hideClass?>"><i class="fa fa-download"></i></a>
					                        <div class="file-man-title">
												<p class="small mb-0 mt-2 text-center text-overflow" id="filename-<?=$fieldName?>"><?=$uploaded ? $file : 'Belum ada berkas yang diupload.'?></p>
											</div>
										</div>
										<?=form_close();?>
									</div>
								</td>
                            </tr>
							<tr class="submit d-none">
								<td></td>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Perbarui" name="submit">
									<input type="reset" class="btn btn-danger cancel" value="Batal" name="cancel">
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
                <?php } ?>
				<div id="data-lain" class="mb-5"></div>
                <div class="table-responsive elevation-3 mb-4">
					<table class="table table-bordered table-detail">
	                    <thead>                                
	                        <tr class="table-warning">
	                            <th colspan="3"><a href="#data-lain" class="edit" data-id="lain"><i class="fas fa-pencil-alt"></i></a>DATA LAIN</th>
							</tr>
						</thead>
						<tbody id="lain">
						<tr>
								<td></td>
	                            <td>UKURAN JAS ALMAMATER</td>
	                            <td>
									<div class="label"><?=$data['ukuran_jas']?><?=change_data('ukuran_jas', $changes)?></div>
									<div class="input d-none">
									<?php $ukuran = [
										"S"     => 'S',
										"M"     => 'M',
										"L"     => 'L',
										"XL"    => 'XL',
										"XXL"   => 'XXL',
										"XXXL"  => 'XXXL',
									];

									echo form_dropdown("ukuran_jas", $ukuran, old('ukuran_jas', $data['ukuran_jas']), 'id="ukuran_jas" class="form-control" required');  ?>
									</div>
								</td>
	                        </tr>
							<tr>
								<td></td>
	                            <td>UKURAN T-SHIRT</td>
	                            <td>
									<div class="label"><?=$data['ukuran_tshirt']?><?=change_data('ukuran_tshirt', $changes)?></div>
									<div class="input d-none">
										<?php echo form_dropdown("ukuran_tshirt", $ukuran, old('ukuran_tshirt', $data['ukuran_tshirt']), 'id="ukuran_tshirt" class="form-control" required autofocus');  ?>
									</div>
								</td>
	                        </tr>
							<tr class="submit d-none">
								<td></td>
								<td></td>
								<td>
									<input type="submit" class="btn btn-primary" value="Perbarui" name="submit">
									<input type="reset" class="btn btn-danger cancel" value="Batal" name="cancel">
								</td>
							</tr>
                        </tbody>
                    </table>
				</div>
				<?=form_close(); ?>
			<?php
					$files =[
						'file_akta_lahir',
						'file_kk',
						'file_ktp',
						'file_ijasah',
						'file_transkrip',
						'file_foto',
						//'file_bukti_bayar',
						'file_lain'
					];

					$rowFiles = array_chunk($files, 3);

					foreach ($rowFiles as $file)
					{
						echo '<div class="row justify-content-center">';
						foreach ($file as $fieldName)
						{
							$file      = $data[$fieldName];
							$uploaded  = is_file(FCPATH . $filePath . $file );
							$hideClass = $uploaded ? '' : 'has-upload- ' . $fieldName . ' d-none';
							$extFile   = pathinfo($file, PATHINFO_EXTENSION);
							$imgSource = $srcFile = base_url($filePath . $file);
							$isPDF     = strtolower($extFile) == 'pdf';

							if ($isPDF)
							{
								$imgSource = $theme_url . 'img/file-icons/pdf.svg';
							}

							$uploadClass = $fieldName === 'file_foto' ? 'file-upload-foto' : '';

							$labelField = str_replace('_', ' ', str_replace(['kk','ktp'],['KK', 'KTP'],$fieldName)); ?>
							<div class="file-box col-sm-3">
								<p class="file-header">
									<?=$uploaded ? $labelField : 'Belum ada ' . $labelField . ' yang diupload.'?>
									<a href="<?=$isPDF?$srcFile:$imgSource?>" download class="file-download has-upload mx-0 <?=$hideClass?>"><i class="fa fa-download"></i></a>
									<a href="#" data-field-name="<?=$fieldName?>" class="file-upload <?=$uploadClass?> mx-0"><i class="fa fa-upload text-primary"></i></a>
								</p>
								<input type="file" name="<?=$fieldName?>" class="berkas-scan d-none" data-id="<?=$data['profil_id']?>" data-nim="<?=$data['NIM_DIKTI']?>" accept="image/png, image/jpg, image/jpeg, .pdf">
								<a href="#" class="prev-<?=$isPDF?'pdf':'image'?>" data-src="<?=$isPDF?$srcFile:$imgSource?>">
									<img src="<?=$imgSource?>" id="img-<?=$fieldName?>" class="has-upload <?=$hideClass?> img-fluid" alt="icon">
								</a>
							</div> <?php
						}
						echo '</div>';
					}
				?>
            </div>
        </div>   
	</div>
</div>
<script>
	var konsentrasi = JSON.parse('<?=json_encode(array_filter($konsentrasi));?>');

	function updateKonsentrasi(progdi) {
	    var listItems = "";
		var selectedVal = "<?= old('konsentrasi_progdi', $data['konsentrasi_progdi']); ?>";

		
	    for (var key in konsentrasi[progdi]) {
			var konsentrasi_pilihan = konsentrasi[progdi][key];
			var selected = selectedVal == konsentrasi_pilihan ? 'selected' : '';

	        listItems+= "<option value='" + konsentrasi_pilihan + "' " + selected + ">" + konsentrasi_pilihan + "</option>";
	    }
	    $("select#konsentrasi_progdi").html(listItems);
	}
</script>