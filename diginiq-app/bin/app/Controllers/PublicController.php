<?php
namespace App\Controllers;

/**
 * Class PublicController
 *
 * PublicController is used for all public controllers
 * that do not need authentication for accessing pages.
 *
 * Extend this to any new Controller:
 *     class About extends PublicController
 *
 * @package CodeIgniter
 */

use Arifrh\Themes\Themes;

class PublicController extends AuthController
{

	/**
	 * Autoload helpers
	 *
	 * @var array
	 */
	protected $helpers = ['bootstrap'];

	/**
	 * Themes
	 *
	 * @var stdClass
	 */
	public $themes = null;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		$this->themes = Themes::init();
	}

}
