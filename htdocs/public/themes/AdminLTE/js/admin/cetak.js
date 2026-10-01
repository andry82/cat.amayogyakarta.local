$(function () {
	$('#print').on('click', function () {
		var desa = $('#desa option:selected').val() || 0;

		window.open(site_url + 'admin/penilaian/cetakDataNilai/' + desa);
	});

	$('#download').on('click', function () {
		var desa = $('#desa option:selected').val() || 0;

		window.open(site_url + 'admin/penilaian/downloadDataNilai/' + desa);
	});

	$('#print-rekap').on('click', function () {
		var desa = $('#desa option:selected').val() || 0;

		window.open(site_url + 'admin/rekapitulasi/cetakRekapNilai/' + desa);
	});

	$('#download-rekap').on('click', function () {
		var desa = $('#desa option:selected').val() || 0;

		window.open(site_url + 'admin/rekapitulasi/downloadRekapNilai/' + desa);
	})
});