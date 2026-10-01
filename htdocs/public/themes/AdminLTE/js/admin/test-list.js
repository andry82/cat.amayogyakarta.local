$(function(){
	$('a.del-test').on('click', function (e) {

		var id = $(this).data('id');
		var kode = $(this).data('kode');

		swalConfirm('Hapus Kode Test ' + kode + ' ini', function () {
			$.post(site_url + 'admin/test/hapusTest', {id: id, kode: kode}, function () {
				window.location.reload();
			});
		});
	});  
});