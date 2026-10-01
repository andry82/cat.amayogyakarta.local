$(function () {
	$('#pilihDesa').depdrop({
		language: 'id',
		initialize: true,
		depends: ['kode_test'],
		url: site_url + 'home/pilihanDesa',
		params: ['desaId']
	});

	$('#no_registrasi').on('blur', function () {

		var no = $('#no_registrasi').val();

		if (no.length > 0) {
			$.post(site_url + 'home/checkNoReg', { no_registrasi: no }, function (res) {
				if (res.invalid) {
					alert('Nomor Registrasi ' + no + ' tidak bisa dipakai karena sudah digunakan.');
					$('#no_registrasi').val('');
				}
			}, 'json');
		}
	});

	$('#kode_test').on('blur', function () {
		var kode = $('#kode_test').val();
		$.post(site_url + 'home/checkKode', { kode: kode }, function (res) {
			if (res.invalid) {
				alert('Kode Test ' + kode + ' tidak bisa dipakai, atau sudah tidak berlaku. <p>Pastikan anda memasukkan Kode Test dengan benar.');
				$('#kode_test').val('');
			}
		}, 'json');
	});

	$('#btn-registrasi').on('click', function () {
		show_konfirmasi();
	});

	$('form').on('submit', function (e) {
		show_konfirmasi(e);
	});
});

function show_konfirmasi(e)
{
	var btnSubmit = $('form').find("button[type=submit]:focus").prop('name');

	if (typeof e != 'undefined' && btnSubmit != 'konfirmasi') e.preventDefault();

	var x = parseInt($('#x').val());
	var y = parseInt($('#y').val());
	var z = parseInt($('#captcha').val());

	if (x + y == z) {
		$('#noreg').html('').html($('#no_registrasi').val());
		$('#nama').html('').html($('#nama_lengkap').val());
		$('#kdtest').html('').html($('#kode_test').val());
		$('#desa').html('').html($('#pilihDesa option:selected').text());

		$('#konfirmasi-form').modal('show');
	} else {
		alert('Kode Captcha tidak benar.');
	}
}