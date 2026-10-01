<?php namespace Config;

class Themes extends \Arifrh\Themes\Config\Themes
{
	/**
	 * Default Theme name
	 *
	 * This can be overide on run-time
	 */
	public $theme = 'bootstrap4';

	/**
	 * Theme Path - Respect to FCPATH
	 */
	public $theme_path = 'themes';

	/**
	 * Wether use only one full template (skip header & footer template)
	 */
	public $use_full_template = true;

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
		'bootbox' => [
			'js' => [
				'bootbox/bootbox-en.min.js'
			]
		]
	];

}