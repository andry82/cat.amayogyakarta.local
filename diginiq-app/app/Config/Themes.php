<?php namespace Config;

class Themes extends \Arifrh\Themes\Config\Themes
{
	/**
	 * Default Theme name
	 *
	 * This can be overide on run-time
	 */
	public $theme = 'simple';

	public $image_path = 'images';

	/**
	 * Theme Path - Respect to FCPATH
	 */
	public $theme_path = 'themes';

	/**
	 * Wether use only one full template (skip header & footer template)
	 */
	public $use_full_template = false;

	/**
	 * Plugins path inside theme path
	 */
	public $plugin_path = 'plugins';

	/**
	 * Registered Plugins
	 * Format: 
	 * [ 
	 * 	 'plugin_key_name' => [
	 * 		'js'  => [...js_array]
	 * 		'css'  => [...css_array]
	 *   ]
	 * ]
	 * 
	 */
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
		'bootbox' => [
			'js' => [
				'bootbox/bootbox-en.min.js'
			]
		],
		'countdown' => [
			'js' => [
				'countdown/jquery.countdown.min.js'
			]
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
		'fileinput' => [
			'css' => [
				'fileinput/css/fileinput.min.css',
			],
			'js' => [
				'fileinput/js/fileinput.min.js',
    			'fileinput/js/locales/id.js',
    			'fileinput/themes/fas/theme.min.js',
			],
		],
		'inputmask' => [
			'js' => [
				'inputmask/jquery.inputmask.min.js',
				'inputmask/inputmask.binding.js',
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
		'notif' => [
			'css' => [
				'notification/style.css',
			],
			'js' => [
				'notification/index.var.js',
				'notification/notif.config.js',
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