var table;

$(function () {

	$('.edit').on('click', function () {
		toggleInput($('.cancel'), false);
	});

	$('.cancel').on('click', function () {
		toggleInput(this, true);
	});

	toggleInput($('.cancel'), true);

	$('input[name=kode_test]').on('keyup keydown', function(){
		$('.kode_test').val($(this).val());
	});

	$("#praktik-off").on('change', function () {

		if ($(this).is(':checked')) {
			$('.praktik').removeClass('d-none');
		} else {
			$('.praktik').addClass('d-none');
		}
	}).trigger('change');

	$('a.btn-desa').on('click', function (e) {

		$('#modal-desa').modal('hide');

		var kode_test = $('input[name=kode_test]').val();

		if (!kode_test.length) {

			e.preventDefault();

			swalWarning('Kode Test harus diinput dulu sebelum menambahkan/mengubah data desa', 'Perhatian');
		} else {
			$('#desa_id').val($(this).data('id'));
			$('#nama_desa').val($(this).data('nama'));

			var title = 'Data Desa untuk Test ' + kode_test;
			$('#desaTest').html('').html(title);

			$('#modal-desa').modal('show');
		}
	});

	$('a.btn-interview').on('click', function (e) {

		$('#modal-interview').modal('hide');

		var kode_test = $('input[name=kode_test]').val();

		if (!kode_test.length) {

			e.preventDefault();

			swalWarning('Kode Test harus diinput dulu sebelum menambahkan/mengubah data pewawancara', 'Perhatian');
		} else {
			$('#pewawancara_id').val($(this).data('id'));
			$('#user_id').val($(this).data('uid'));
			$('input[name=kode_test]').val(kode_test);

			var title = 'Data Pewawancara untuk Test ' + kode_test;
			$('#interviewer').html('').html(title);

			$('#modal-interview').modal('show');
		}
	});

	$('a.btn-del-desa').on('click', function (e) {

		var id = $(this).data('id');
		var desa = $(this).data('nama');

		swalConfirm('Hapus desa ' + desa + ' ini', function () {
			$.post(site_url + 'admin/test/hapus', {data: 'desa', id: id}, function () {
				window.location.reload();
			});
		});
	});

	$('a.btn-del-int').on('click', function (e) {

		var id = $(this).data('id');
		var nama = $(this).data('nama');

		swalConfirm('Hapus ' + nama + ' dari daftar pewawancara', function () {
			$.post(site_url + 'admin/test/hapus', {data: 'interviewer', id: id}, function () {
				window.location.reload();
			});
		});
	});

	$('#bank_soal').on('change', function () {
		var bank_soal = $('#bank_soal option:selected').val();

		if (typeof table == 'object'){
			table.destroy();
		}

		table = $('#table-soal').DataTable({
			'paging': true,
			'lengthChange': true,
			'searching': true,
			'ordering': true,
			'info': true,
			'autoWidth': false,
			'stateSave': true,
			'processing': true,
			'serverSide': false,
			'sServerMethod': 'POST',
			'ajax': {
				'url': site_url + "admin/test/getSoal/" + bank_soal,
				'type': 'POST',
			},
		});
	}).trigger('change');
});

function toggleInput(el, disabled)
{
	var group = $(el).closest('tbody').prop('id');

	$('tbody#' + group + ' > tr > td').find('.form-control').prop('disabled', disabled);

	if (disabled)
		$('tbody#' + group + ' > tr.submit').addClass('d-none');
	else
		$('tbody#' + group + ' > tr.submit').removeClass('d-none');
}