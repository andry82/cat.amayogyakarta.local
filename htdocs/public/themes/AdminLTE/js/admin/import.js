$(function () {
	$("#btn-import").on('click', function () {
		$("input[name=import]").click();
	});
});


$(document).on('change', '#import', function () {
	/*
	var fieldname = $(this).prop('name');
	var berkas    = document.getElementsByName(fieldname)[0].files[0];
	var form_data = new FormData();

	form_data.append(fieldname, berkas);

	$.ajax({
		url: "/admin/maba/importData",
		method: "POST",
		data: form_data,
		contentType: false,
		cache: false,
		processData: false,
		dataType: 'html',
		beforeSend: function () {
		},
		success: function (res) {
			window.location.reload();
		}
	});
	*/
});