var today = new Date();
var newDate = today.setSeconds(today.getSeconds() + timer);
var elem = document.documentElement;
var isFinish = false;
var sisa_waktu_tertulis;

$(function () {
	$('.jawaban').on('click', function () {

		var full_screen_element = document.fullscreenElement;
	
		if (full_screen_element == null)
			openFullscreen(elem);

		if (wsConnected) {
			var id = $(this).prop('id');
			var value = $('#' + id).val();

			var data = {
				type: 'update-jawaban',
				table: 'tes_tertulis',
				field: 'jawaban',
				value: value,
				key: 'id',
				keyval: id.split('_')[1]
			};

			sendPush(conn, data);
			saveToStorage();
		} else {
			updateProgress();
		}

		$(this).closest('li').removeClass('not-done').addClass('done');
	});

	$('#textTime').countdown(newDate, function (event) {
		var time = event.strftime('%H:%M:%S');
		$(this).html(time);
	}).on('finish.countdown', function (event) {
		isFinish = true;
		finishTest();
	}).on('update.countdown', function (event){
		sisa_waktu_tertulis = event.offset.totalSeconds;

		$('#sisa_waktu_tertulis').val(sisa_waktu_tertulis);
		
		if (wsConnected) {
			var data = {
				type: 'update',
				table: 'registrasi',
				field: 'sisa_waktu_tertulis',
				value: sisa_waktu_tertulis,
				key: 'no_registrasi',
				keyval: $('#no_registrasi').val().trim()
			};
		
			sendPush(conn, data);
			saveToStorage();
		} else {
			updateProgress();
		}
	});

	$('#btnSelesai').on('click', function (e) {
		var jml_soal = $('#jml_soal').val();

		var terjawab = $('li.done').length;
		var blm_terjawab = $('li.not-done').length;

		if (parseInt(jml_soal) != parseInt(terjawab)) {
			e.preventDefault();
			$.jAlert({
				type: "confirm",
				confirmQuestion: 'Ada ' + blm_terjawab + ' soal belum terjawab.<br><br>Anda yakin akan kirim data? <br>Jika Ya, Anda tidak bisa mengulang mengerjakan soal yang belum terjawab',
				onConfirm: function (e, btn) {
					isFinish = true;
					finishTest();
				},
				onDeny: function (e, btn) {
					alert('Silakan cek kembali kelengkapan jawaban Anda.');
					return false;
				}
			});
		}
		else {
			isFinish = true;
			finishTest();
		}
	});

	if (isOnline) {
		var formData = $("#form-test").serialize();
		$.post(site_url + 'test/sync', formData);
	}
});

$(document).ajaxStop(function () {
	
	if (isFinish) {
		var data = {
			type: 'finish-tertulis',
			key: 'no_registrasi',
			keyval: $('#no_registrasi').val().trim()
		};
	
		sendPush(conn, data);
	
		window.location.reload();
	}
});

function finishTest()
{
	if (isOnline) {
		var formData = $("#form-test").serialize();

		$.post(site_url + 'test/jawab', formData);
	}
	else {
		$('#finish-modal').modal('show');
	}
}

function updateProgress()
{
	let no_registrasi = $('#no_registrasi').val().trim();

	if (! isOnline){
		saveToStorage();
	} else {
		var formData = $("#form-test").serialize();

		$.post(site_url + 'test/sync', formData);
	}
	
	var data = {
		type: 'update',
		table: 'registrasi',
		field: 'sisa_waktu_tertulis',
		value: sisa_waktu_tertulis,
		key: 'no_registrasi',
		keyval: no_registrasi
	};

	sendPush(conn, data);
}

function saveToStorage(){
	let no_registrasi = $('#no_registrasi').val().trim();
	let progress = [];
	let formArray = $("form").serializeArray();

	$.each(formArray, function(i, field){

		if (field.name.startsWith('jawaban_')) {
			var jawab = {
				id: field.name.split('_')[1],
				jawaban: field.value,
				sisa_waktu_tertulis: sisa_waktu_tertulis
			}
			progress.push(jawab);
		}
	});

	localStorage.setItem(no_registrasi, JSON.stringify(progress));
}

function reloadProgress(){
	var no_registrasi = $('#no_registrasi').val().trim();
	var progress = JSON.parse(localStorage.getItem(no_registrasi));

	$.each(progress, function(i, value){

		var sisa_waktu = value.sisa_waktu_tertulis;

		var dTgl = new Date();

		if (! isNaN(sisa_waktu)) {
			var waktu = dTgl.setSeconds(dTgl.getSeconds() + sisa_waktu - 1);

			$('#textTime').countdown(waktu,function (event) {
				var time = event.strftime('%H:%M:%S');
				$(this).html(time);
			});
		}

		$('.jawaban').unbind('change');

		var val = $('input:radio[name=jawaban_' + value.id + ']:checked').val();

		var $radios = $('input:radio[name=jawaban_' + value.id + ']');
        $radios.filter('[value=' + value.jawaban + ']').prop('checked', true);
		$radios.closest('li').removeClass('not-done').addClass('done');
	});
}

window.onload = function() {
	reloadProgress();
}

function downloadJawaban(){
	var no_registrasi = $('#no_registrasi').val().trim();
	var jawaban = JSON.stringify(JSON.parse(localStorage.getItem(no_registrasi)), null, '\t');

    var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(jawaban);
    var downloadAnchorNode = document.createElement('a');
    downloadAnchorNode.setAttribute("href",     dataStr);
    downloadAnchorNode.setAttribute("download", no_registrasi + ".json");
    document.body.appendChild(downloadAnchorNode); // required for firefox
    downloadAnchorNode.click();
    downloadAnchorNode.remove();
}