<?php namespace Config;

class AdminLTE extends \Arifrh\Themes\Config\Themes
{
	/**
	 * Default Theme name
	 *
	 * This can be overide on run-time
	 */
	public $theme = 'AdminLTE';

	public $plugins = [
		'alert' => [
			'css' => [
				'jAlert/jAlert.css',
			],
			'js' => [
				'jAlert/jAlert.min.js',
				'jAlert/jAlert-functions.min.js',
			],
		],
		'bs4' => [
			'js' => [
				'bootstrap/js/bootstrap.bundle.min.js',
			],
		],
		'custom-upload' => [
			'js' => [
				'bootstrap-filestyle/bootstrap-filestyle.min.js',
			],
		],
		'bs4-responsive-table' => [
			'css' => [
				'table-responsive-stack-bs4/table-responsive-stack.css',
			],
			'js' => [
				'table-responsive-stack-bs4/table-responsive-stack.js',
			],
		],
		'datatable' => [
			'css' => [
				'DataTable/datatables.min.css',
			],
			'js' => [
				'DataTable/datatables.min.js',
				'DataTable/datatables.config.js'
			],
		],
		'datepicker' => [
			'css' => [
				'datepicker/bootstrap-datepicker.min.css',
			],
			'js' => [
				'datepicker/bootstrap-datepicker.min.js',
				'datepicker/bootstrap-datepicker.id.min.js',
				'datepicker/bootstrap-datepicker.config.js'
			],
		],
		'depdrop' => [
			'css' => [
				'depdrop/css/dependent-dropdown.min.css',
			],
			'js' => [
				'depdrop/js/dependent-dropdown.js',
				'depdrop/js/locales/id.js',
			],
		],
		'elfinder' => [
			'css' => [
				'elfinder/css/elfinder.min.css',
				'elfinder/css/theme.css',
			],
			'js' => [
				'elfinder/js/elfinder.min.js',
				'elfinder/js/extras/editors.default.min.js',
				'elfinder/js/elfinder.config.js',
			],
		],
		'elfinder-ckeditor' => [
			'css' => [
				'elfinder/css/elfinder.min.css',
				'elfinder/css/theme.css',
			],
			'js' => [
				'elfinder/js/elfinder.min.js',
				'elfinder/js/extras/editors.default.min.js',
				'elfinder/js/elfinder-ckeditor.js',
			],
		],
		'fileinput' => [
			'css' => [
				'bootstrap-fileinput/css/fileinput.min.css',
			],
			'js' => [
				'bootstrap-fileinput/js/fileinput.min.js',
				'bootstrap-fileinput/js/locales/id.js',
				'bootstrap-fileinput/js/fileinput.config.js'
			],
		],
		'fa-free' => [
			'css' => [
				'fontawesome-free/css/all.min.css',
			],
		],
		'inputmask' => [
			'js' => [
				'inputmask/jquery.inputmask.min.js',
				'inputmask/inputmask.binding.js',
			],
		],
		'jAlert' => [
			'css' => [
				'jAlert/jAlert.css',
			],
			'js' => [
				'jAlert/jAlert.min.js',
				'jAlert/jAlert-functions.min.js',
			],
		],
		'jquery' => [
			'js' => [
				'jquery/jquery.min.js',
			],
		],
		'loading' => [
			'css' => [
				'loading/loading.css',
			],
			'js' => [
				'loading/loadingoverlay.min.js',
				'loading/loading.js',
			]
		],
		'select2' => [
			'css' => [
				'select2/css/select2.min.css',
				'select2/css/select2-bootstrap4.min.css',
			],
			'js' => [
				'select2/js/select2.min.js',
				'select2/js/i18n/id.js',
				'select2/js/select2.config.js',
			],
		],
		'select2-filter' => [
			'css' => [
				'select2/css/select2.min.css',
				'select2/css/select2-bootstrap4.min.css',
			],
			'js' => [
				'select2/js/select2.min.js',
				'select2/js/i18n/id.js',
			],
		],
		'swal' => [
			'css' => [
				'sweetalert2/sweetalert2.min.css',
			],
			'js' => [
				'sweetalert2/sweetalert2.all.min.js',
				'sweetalert2/swal.function.js',
			],
		],
		'pdf' => [
			'js' => [
				'pdf/pdfobject.min.js',
			],
		],
		'x-editable' => [
			'css' => [
				'bootstrap-editable/css/bootstrap-editable.css',
			],
			'js' => [
				'bootstrap-editable/js/bootstrap-editable.min.js',
				'bootstrap-editable/js/editable.config.js',
			],
		],
		'websocket' => [
			'js' => [
				'websocket/reconnecting-websocket.js',
				'websocket/websocket.js',
			]
		],
	];
}