$(function () {

	$('.edit').on('click', function () {
		toggleInput(false);
	});

	$('.update').on('click', function () {
		var id = $(this).prop('id').split('-')[1];
		toggleInputRow(false, id);
	});

	$(".btn-cancel").on("click", function () {
		var id = $(this).prop("id").split("-")[1];
		toggleInputRow(true, id);
	});

	$('.cancel').on('click', function () {
		toggleInput(true);
	});

	toggleInput(true);

	$('#table-nilai').DataTable({
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'stateSave': false,
		'serverSide': false,
		'search': {
			'regex': false
		},
		"columnDefs": [ {
			"targets": [5,6,7,8,9,10,11,12,13,14,15,16,17,18,19],
			"orderable": false,
		} ]
	});

	$('table#table-nilai > tbody > tr > td').on('change', 'input.form-control', function(){
		var name = $(this).prop('name').replace('][', '|').replace(/^nilai|\[|\]+/g, '').split('|');
		var value = $(this).prop('value');

		updateRealtimeNilai(name[1].trim(), value, name[0].trim());
	});
});

function updateRealtimeNilai(field, value, keyval) {
	var kodeTest = $('#kodeTest').val();

	if (wsConnected) {
		var data = {
			type: 'update-praktik',
			table: 'registrasi',
			field: field,
			value: value,
			key: 'no_registrasi',
			keyval: keyval,
			kodeTest: kodeTest
		}
		sendPush(conn, data);
	}
}

function toggleInputRow(disabled, id)
{
	$("table#table-nilai > tbody > tr > td")
    .find('.input-' + id)
    .prop("disabled", disabled);

	if (disabled) {
		$("table#table-nilai > tbody > tr > td").find('.btn-' + id).addClass("d-none");
		$("table#table-nilai > tbody > tr > td").find('.link-' + id).removeClass("d-none");

	} else {
		$("table#table-nilai > tbody > tr > td").find('.btn-' + id).removeClass("d-none");
		$("table#table-nilai > tbody > tr > td").find('.link-' + id).addClass("d-none");
	}
}

function toggleInput(disabled)
{
	$('table#table-nilai > tbody > tr > td').find('.form-control').prop('disabled', disabled);

	if (disabled)
		$('table#table-nilai > tfoot > tr.submit').addClass('d-none');
	else
		$('table#table-nilai > tfoot > tr.submit').removeClass('d-none');
}

$(document).on('change', '.upload-jawaban', function () {

	var fieldname = $(this).prop('name');
	var berkas    = document.getElementsByName(fieldname)[0].files[0];
	var form_data = new FormData();
	var oFReader  = new FileReader();
	
	oFReader.readAsDataURL(berkas);

	form_data.append(fieldname, berkas);

	$.ajax({
		url: site_url + "admin/penilaian/upload",
		method: "POST",
		data: form_data,
		contentType: false,
		cache: false,
		processData: false,
		dataType: 'JSON',
		beforeSend: function () {
			loading();
		},
		success: function (res) {
			loadingInfo('Tunggu sejeank, halaman akan diperbarui jika unggahan selesai.');

			if (! res.error)
				setInterval('location.reload()', 2000);
		}
	});
});

$(document).on('change', '.upload-interview', function () {

	var fieldname = $(this).prop('name');
	var berkas    = document.getElementsByName(fieldname)[0].files[0];
	var form_data = new FormData();
	var oFReader  = new FileReader();
	
	oFReader.readAsDataURL(berkas);

	form_data.append(fieldname, berkas);

	$.ajax({
		url: site_url + "admin/penilaian/uploadInterview",
		method: "POST",
		data: form_data,
		contentType: false,
		cache: false,
		processData: false,
		dataType: 'JSON',
		beforeSend: function () {
			loading();
		},
		success: function (res) {
			loadingInfo('Tunggu sejeank, halaman akan diperbarui jika unggahan selesai.');

			if (! res.error)
				setInterval('location.reload()', 2000);
		}
	});
});