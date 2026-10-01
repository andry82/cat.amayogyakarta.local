<?php namespace App\Controllers\Admin;

/**
 * Example of Admin Conctroller which be protected
 * so only logged in user can access it
 */
class Dashboard extends \App\Controllers\AdminController
{
	public function index()
	{
		$this->themes
			::render('admin/dashboard');
	}
}
