$('#xyz').on('click', function(e){
	e.preventDefault();

	/* Popup an alert with the form */
	$.jAlert({
		'title': 'Masukkan Password',
		'content': '<form><label class="col">Masukkan Password untuk upload files:</label><br><input type="password" class="form-control" name="password"></form>',
		'theme': 'blue',
		'size': 'md',
		'onOpen': function(alert){
			alert.find('form').on('submit', function(e){
				e.preventDefault();
			});
		},
		'autofocus': 'input[name="password"]',
		'btns': [
			/* Add a save button */
			{ 'text': 'Login', 'theme': 'green', 'closeAlert': false, 'onClick': function(e){
				
			e.preventDefault();

			var btn = $('#'+this.id),
			  alert = btn.parents('.jAlert'),
			  form = alert.find('form'),
			  pass = form.find('input[name="password"]').val();

				$.post(site_url + 'test/validateAccess', { pass: pass }, function (res) {
					if (res.success) {
						window.location.href = res.redirect;
					}
					else {
						errorAlert(res.msg);
						return;
					}
				}, 'json');
		
			return false;
		  }
	   },
	  {
		'text': 'close'
	  }
		]
	});
});

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