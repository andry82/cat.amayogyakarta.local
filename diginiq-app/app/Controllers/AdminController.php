<?php
namespace App\Controllers;

use App\Controllers\Traits\AdminLTETrait;

class AdminController extends ProtectedController
{
	use AdminLTETrait;

	protected $mainTemplate = 'admin-cat';
	protected $_404Page = 'admin/404';

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->auth->requiredRoles(['Administrator']);

		$this->initializeTheme();

		$this->themes
			->setPageTitle('')
			->setVar([
				'user'    => $this->user,
				'isAdmin' => $this->isAdmin,
			]);
	}

	public function setMenus()
	{
		$this->topNavMenus = [
			[
				'text'   => '',
				'url'    => site_url('admin/penilaian'),
				'active' => false,
			],
		];

		$this->sidebarMenus = [
			[
				'text'      => 'Dashboard',
				'url'       => site_url('admin/dashboard'),
				'icon'      => 'fas fa-tachometer-alt',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'subs'      => [],
				'has_badge' => false,
			],
			[
				'text'      => 'List Test',
				'url'       => site_url('admin/test'),
				'icon'      => 'fas fa-calendar',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'has_badge' => false,

			],
			[
				'text'      => 'Bank Soal',
				'url'       => site_url('admin/soal'),
				'icon'      => 'fas fa-list',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'has_badge' => false,
			],
			[
				'text'      => 'Penilaian',
				'url'       => site_url('admin/penilaian'),
				'icon'      => 'fas fa-edit',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'subs'      => [],
				'has_badge' => false,
			],
			[
				'text'      => 'Refresh Nilai',
				'url'       => site_url('admin/penilaian/refresh'),
				'icon'      => 'fas fa-sync',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'subs'      => [],
				'has_badge' => false,
			],
			[
				'text'      => 'Rekapitulasi',
				'url'       => site_url('admin/rekapitulasi'),
				'icon'      => 'fas fa-newspaper',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'subs'      => [],
				'has_badge' => false,
			],
			[
				'text'      => 'User Sistem',
				'url'       => site_url('admin/user'),
				'icon'      => 'fas fa-users',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'subs'      => [],
				'has_badge' => false,
			],
			[
				'text'      => 'Tombol Rahasia',
				'url'       => site_url('admin/secret'),
				'icon'      => 'fas fa-lock',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'subs'      => [],
				'has_badge' => false,
			],
			[
				'text'      => 'File Manager',
				'url'       => site_url('admin/files'),
				'icon'      => 'fas fa-folder',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'subs'      => [],
				'has_badge' => false,
			],
			[
				'text'      => 'Logout',
				'url'       => site_url('logout'),
				'icon'      => 'fas fa-key',
				'active'    => true,
				'open'      => false,
				'selected'  => false,
				'has_sub'   => false,
				'subs'      => [],
				'has_badge' => false,
			],
		];
	}
}
