var today = new Date();
var newDate = today.setSeconds(today.getSeconds() + timer);
var elem = document.documentElement;
var isFinish = false;
var sisa_waktu_tertulis;
var $countdown;

$(function () {
	$('.jawaban').on('click', function () {

		var full_screen_element = document.fullscreenElement;
	
		if (full_screen_element == null)
			openFullscreen(elem);

		var id = $(this).prop('id');

		var dataJawaban = {
			key: $(this).data("key"),
			jawaban: $("#" + id).val(),
			sisa_waktu_tertulis: sisa_waktu_tertulis,
		}

		updateJawaban(dataJawaban)

		$(this).closest('li').removeClass('not-done').addClass('done');
	});

	$countdown = $("#textTime")
    .countdown(newDate, function (event) {
      var time = event.strftime("%H:%M:%S")
      $(this).html(time);
    })
    .on("finish.countdown", function (event) {
      isFinish = true
      finishTest();
    })
    .on("update.countdown", function (event) {
		if (!isFinish) {
			sisa_waktu_tertulis = event.offset.totalSeconds;
		} else {
			sisa_waktu_tertulis = 0;
		}
		$("#sisa_waktu_tertulis").val(sisa_waktu_tertulis);

	    var sisaWaktu = {sisa_waktu_tertulis}

		updateJawaban(sisaWaktu)
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
});

function finishTest()
{
	loading();

	$countdown.countdown("stop");
	sisa_waktu_tertulis = 0;
	$("#sisa_waktu_tertulis").val(sisa_waktu_tertulis);

  	saveToStorage();

	try {
		var formData = $("#form-test").serialize();
		$.post(site_url + "test/jawab", formData, function () {
			window.location.href = site_url + "test/tertulis"
		});
	} catch {
		$('#finish-modal').modal('show');
	}
}

function updateJawaban(jawaban) {
  saveToStorage()
  $.post(site_url + "test/update", jawaban)
}

function updateProgress()
{
	saveToStorage();
	var formData = $("#form-test").serialize();

	$.post(site_url + 'test/sync', formData);
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
	//reloadProgress();
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