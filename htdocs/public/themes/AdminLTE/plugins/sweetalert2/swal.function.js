var swalLanguage = {
	'en': {
		'success': 'Success',
		'warning': 'Warning',
		'error': 'Error',
		'info': 'Info',
		'question': 'Question',
		'confirmTitle': 'Are you sure?',
		'yes': 'Yes',
		'cancel': 'Cancel',
		'no': 'No'
	},
	'id': {
		'success': 'Berhasil',
		'warning': 'Peringatan',
		'error': 'Error',
		'info': 'Perhatian',
		'question': 'Konfirmasi',
		'confirmTitle': 'Anda yakin?',
		'yes': 'Ya',
		'cancel': 'Batal',
		'no': 'Tidak'
	},
}

var swalLang = 'id';

function swalConfirm(message, callback, callbackCancel, title, icon)
{
	Swal.fire({
		title: (typeof title == 'undefined' ? swalLanguage[swalLang]['confirmTitle'] : title),
		html: (typeof message == 'undefined' ? '' : message),
		icon: (typeof icon == 'undefined' ? 'question' : icon),
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: swalLanguage[swalLang]['yes'],
		cancelButtonText: swalLanguage[swalLang]['cancel'],
	}).then((result) => {
		if (result.isConfirmed) {
			if (typeof callback == 'function') {
				callback();
			}
		}
		else {
			if (typeof callbackCancel == 'function') {
				callbackCancel();
			}
		}
	});
}

function swalError(message, title)
{
	title = (typeof title == 'undefined' ? swalLanguage[swalLang]['error'] : title);
	swAlert(message, title, 'error');
}

function swalWarning(message, title)
{
	title = (typeof title == 'undefined' ? swalLanguage[swalLang]['warning'] : title);
	swAlert(message, title, 'warning');
}

function swalSuccess(message, title)
{
	title = (typeof title == 'undefined' ? swalLanguage[swalLang]['success'] : title);
	swAlert(message, title, 'success');
}

function swAlert(message, title, icon)
{
	Swal.fire(
		(title || ''),
		message,
		(typeof icon == 'undefined' ? swalLanguage[swalLang]['info'] : icon),
	);
}