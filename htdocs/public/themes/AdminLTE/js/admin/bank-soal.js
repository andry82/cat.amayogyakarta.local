$(function () {
	$('a.btn-form').on('click', function (e) {

		var modalForm = $(this).data('form');
		var id = $(this).data('id');

		if (modalForm == 'kategori') {
			$('#kategori_id').val(id);
			$('#porsi_soal').val($(this).data('porsi'));			
			$('#kategori').val($(this).data('nama'));

			if (parseInt(id) > 0) {
				$('#bank_soal').val($(this).data('bank')).prop('disabled', true);
			}

		} else {
			$('#bank_id').val(id);
			$('#nama').val($(this).data('nama'));
		}

		$('#' + modalForm + '-form').modal('show');
	});

	$('a.del-kategori').on('click', function () {
		var id = $(this).data(id);

		swalConfirm('Hapus kategori ini? Jika ya, maka seluruh soal yang terkait kategori ini juga akan dihapus.', function () {
			$.post(site_url + 'admin/soal/hapus', { id: id }, function () {
				setInterval('location.reload()', 1000);
			})
		});
	});

	$('a.del-bank').on('click', function () {
		var id = $(this).data(id);

		swalConfirm('Hapus Bank Soal ini? Jika Ya, maka semua kategori dan soal yang ada juga akan dihapus.', function () {
			$.post(site_url + 'admin/soal/hapusBank', { id: id }, function () {
				setInterval('location.reload()', 1000);
			})
		});
	});
});


$(document).on('change', '.upload-soal', function () {

	var fieldname = $(this).prop('name');
	var berkas    = document.getElementsByName(fieldname)[0].files[0];
	var form_data = new FormData();
	var oFReader  = new FileReader();
	
	oFReader.readAsDataURL(berkas);

	form_data.append(fieldname, berkas);

	$.ajax({
		url: site_url + "admin/soal/upload",
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