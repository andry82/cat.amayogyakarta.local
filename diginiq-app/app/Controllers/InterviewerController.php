<?php
namespace App\Controllers;

use App\Controllers\Traits\AdminLTETrait;
use Arifrh\Themes\Themes;

class InterviewerController extends ProtectedController
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

		$this->auth->requiredRoles(['Pewawancara']);

		$this->initializeTheme();

		$this->themes->setPageTitle('')->setVar([
			'user' => $this->user,
		]);
	}

	public function setMenus()
	{
		$this->topNavMenus = [
			[
				'text'   => '',
				'url'    => site_url('wawancara/penilaian'),
				'active' => false,
			],
		];

		$this->sidebarMenus = [
			[
				'text'      => 'Dashboard',
				'url'       => site_url('wawancara'),
				'icon'      => 'fas fa-tachometer-alt',
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
