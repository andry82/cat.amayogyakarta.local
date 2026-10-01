<?php namespace App\Controllers\Admin;

use \App\Controllers\AdminController;

class Files extends AdminController
{
	public function index()
	{
		$this->themes
			->addExternalCSS('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css')
			->addExternalJS('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')
			->loadPlugins('elfinder')
			::render('file-manager/index');
	}

	public function connector()
	{
		$opts = [
			'roots' => [
				[
					'driver'        => 'LocalFileSystem',
					'path'          => WRITEPATH . '/uploads',
					'URL'           => base_url('files'),
					'uploadDeny'    => ['all'],
					'uploadAllow'   => ['image', 'video'],
					'uploadOrder'   => ['deny', 'allow'],
					'accessControl' => [$this, 'elfinderAccess'],// disable and hide dot starting files (OPTIONAL)
					// more elFinder options here
					'attributes' => [
						[ // hide html
							'pattern' => '/\.html$/',
							'read' => false,
							'write' => false,
							'hidden' => true,
							'locked' => false
						],
					],
				]
			],
		];
		$connector = new \elFinderConnector(new \elFinder($opts));
		$connector->run();
	}

	public function elfinderAccess($attr, $path, $data, $volume, $isDir, $realpath)
	{
		$basename = basename($path);

		return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
				 && strlen($realpath) !== 1           // but with out volume root
			? !($attr === 'read' || $attr === 'write') // set read+write to false, other (locked+hidden) set to true
			:  null;                                 // else elFinder decide it itself
	}

	public function upload()
	{
		if (file_exists(FCPATH . '/uploads/files/' . $_FILES["upload"]["name"]))
			{
			 echo $_FILES["upload"]["name"] . " already exists. ";
			}
			else
			{
			 move_uploaded_file($_FILES["upload"]["tmp_name"],
			 FCPATH . '/uploads/files/'  . $_FILES["upload"]["name"]);
			 echo "Stored in: " . "uploads/files/" . $_FILES["upload"]["name"];
			}
	}

	public function ckeditor()
	{
		$this->themes
			->useFullTemplate()
			->setTemplate('fullpage')
			->addExternalCSS('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css')
			->addExternalJS('//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js')
			->loadPlugins('elfinder-ckeditor')
			::render('file-manager/ckeditor');
	}
}
