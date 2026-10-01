var today = new Date();
var newDate = today.setSeconds(today.getSeconds() + timer);

$(function () {
	$('#textTime').countdown(newDate, function (event) {
		var time = event.strftime('%H:%M:%S');
		$(this).html(time);

		var sisa_waktu_praktik = event.offset.totalSeconds;

		var data = {
			type: 'update',
			table: 'registrasi',
			field: 'sisa_waktu_praktik',
			value: sisa_waktu_praktik,
			key: 'no_registrasi',
			keyval: $('#no_registrasi').val()
		};

		sendPush(conn, data);

	}).on('finish.countdown', function(event) {
		finishTest();
	});
});


function finishTest()
{
	var data = {
		type: 'finish-praktik',
		key: 'no_registrasi',
		keyval: $('#no_registrasi').val()
	};

	sendPush(conn, data);

	window.location.href = site_url + 'test/selesai';
}