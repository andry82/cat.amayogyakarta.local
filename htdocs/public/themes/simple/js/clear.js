$(function(){
	/* Popup an alert with the form */
	$.jAlert({
		'title': 'Masukkan Password',
		'content': '<form><label class="col">Masukkan Password untuk buka akun terkunci:</label><br><input type="password" class="form-control" name="password"></form>',
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

				$.post(site_url + 'home/validateAccess', { pass: pass }, function (res) {
					if (res.success) {
						location.reload();
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