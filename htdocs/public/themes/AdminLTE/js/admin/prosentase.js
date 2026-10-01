$(function () {
	$('#form-prosentase :input').on('change keyup', function () {
		cekTotal();
	}).change();

	$('.btn-prosentase').on('click', function () {
		var nilai = $(this).data('nilai');
		
		$('#prosentase_tertulis').val(nilai.prosentase_tertulis);
		$('#prosentase_praktik').val(nilai.prosentase_praktik);
		$('#prosentase_wawancara').val(nilai.prosentase_wawancara);

		cekTotal();

		$('#id').val($(this).data('id'));
	});
});

function cekTotal()
{
	var a = $('#prosentase_tertulis').val();
	var b = $('#prosentase_praktik').val();
	var c = $('#prosentase_wawancara').val();

	var tot = parseInt(a) + parseInt(b) + parseInt(c);

	$('#total').val(tot);

	if (tot != 100) {
		$('#total').addClass('bg-danger');		
	}
	else {
		$('#total').removeClass('bg-danger');		
	}
}