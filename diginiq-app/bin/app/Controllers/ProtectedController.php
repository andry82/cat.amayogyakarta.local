<?php
namespace App\Controllers;

/**
 * Class ProtectedController
 *
 * ProtectedController provides a secure pages
 * only logged in users can access it.
 *
 * Extend this class in any new controllers:
 *     class Admin extends ProtectedController
 *
 * @package Auth
 */

class ProtectedController extends AuthController
{
	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		if (! $this->auth->isLogged())
		{
			redirect()->to('/login')->send();
			exit;
		}
	}

	/**
	 * Do migration to the latest db upgrade
	 *
	 * Note: It wil be more secure when moving this method to Super Admin group only
	 *
	 * @return void
	 */
	public function dbUpgrade()
	{
		$migrate = \Config\Services::migrations();

		try
		{
			$migrate->latest();

			$migration = \Arifrh\DynaModel\DB::table('migrations');
			$status    = $migration->last();

			$migrationStatus = "<h3>Migration Status</h3>Latest version ({$status['id']}) - {$status['version']}";

			$this->themes::render($migrationStatus);
		}
		catch (\Exception $e)
		{
			// Do something with the error here...
		}
	}
}
