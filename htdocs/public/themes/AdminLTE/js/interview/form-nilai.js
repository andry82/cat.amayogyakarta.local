$(function () {
	$('form.readonly input').prop('disabled', true);

	$('input.nilai').on('change keyup', function () {
		cekRata2();
	}).change();

	
	$("input.nilai").on("blur", function () {
		var field = $(this).prop("name")
		var value = $(this).val()
		var jawaban = {
		field,
		value,
		interview1: $("input[name=interview1]").val(),
		interview2: $("input[name=interview2]").val(),
		interview3: $("input[name=interview3]").val(),
		id: $("input[name=id]").val(),
		}
		updateJawaban(jawaban)
	});
});

function cekRata2()
{
	for (g = 1; g <= 3; g++) {
		var tot = 0;
		for (i = 1; i <= 5; i++){
			var col = 'interview' + g + i;
			
			var nilai = $('input[name=' + col + ']').val() || 0;
			tot += parseInt(nilai);
		}

		var rata2 = formatDecimal(tot / 5);

		$('input[name=interview' + g + ']').val(rata2);
		$('#avg' + g).html('').html(rata2);
	}

	//updateProgress();
}

function formatDecimal(number){
	return (number % 1 != 0) ? number.toFixed(2) : number;
}

function updateJawaban(jawaban) {
  saveToStorage()
  $.post(site_url + "wawancara/update", jawaban)
}

function updateProgress()
{
	saveToStorage();

	var formData = $("#form-interview").serialize();

	$.post(site_url + 'wawancara/sync', formData);
}

function reloadProgress(){
	let no_registrasi = $('#no_registrasi').val().trim();
	var progress = JSON.parse(localStorage.getItem('interview-' + no_registrasi));

	$.each(progress, function(i, data){

		$('input.nilai').unbind('change');
		$('input[name=' + data.column + ']').val(data.value);
	});
}

window.onload = function() {
	reloadProgress();
}

function saveToStorage(){
	let no_registrasi = $('#no_registrasi').val().trim();
	let progress = [];
	let formArray = $("form").serializeArray();

	$.each(formArray, function(i, field){
		var jawaban = {
			column: field.name,
			value: field.value
		};

		progress.push(jawaban);
	});

	localStorage.setItem('interview-' + no_registrasi, JSON.stringify(progress));
}

function downloadJawaban(){
	var no_registrasi = $('#no_registrasi').val().trim();
	var jawaban = JSON.stringify(JSON.parse(localStorage.getItem('interview-' + no_registrasi)), null, '\t');

    var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(jawaban);
    var downloadAnchorNode = document.createElement('a');
    downloadAnchorNode.setAttribute("href",     dataStr);
    downloadAnchorNode.setAttribute("download", 'interview-' + no_registrasi + ".json");
    document.body.appendChild(downloadAnchorNode); // required for firefox
    downloadAnchorNode.click();
    downloadAnchorNode.remove();
}