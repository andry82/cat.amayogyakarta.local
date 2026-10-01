<div class="row d-flex justify-content-center">
	<div class="col-lg-4">
		<h4 class="text-center my-3">RKAPITULASI NILAI SELEKSI<br>PENYARINGAN CALON PERANGKAT DESA</h4>
		
		<?=form_dropdown('desa', $desa, [], 'class="form-control" id="desa"')?>

		<div class="my-4 text-center">
			<a href="#" class="btn btn-primary print btn-print" id="print-rekap">
				<i class="fas fa-print mr-3"></i>CETAK
			</a>
			<a href="#" class="btn btn-success download btn-print ml-3" id="download-rekap">
				<i class="fas fa-file-excel mr-3"></i>DOWNLOAD
			</a>
		</div>
	</div>
</div>