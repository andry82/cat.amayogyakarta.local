<?php
namespace App\Controllers;

/**
 * Class AuthController
 *
 * AuthController provides auth to be available in each method
 * so we can play with auth easily.
 *
 * Extend this class in any new controllers:
 *     class User extends AuthController
 *
 * @package Auth
 */

use Arifrh\Auth\Auth;
use CodeIgniter\Controller;

class AuthController extends Controller
{

	/**
	 * Autoload helper
	 *
	 * @var array
	 */
	protected $helpers = ['bootstrap', 'cookie'];

	/**
	 * Auth Object
	 *
	 * @var stdClass
	 */
	public $auth = null;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->auth = new Auth();

		\Config\Services::language($this->auth->config->siteLanguage);
	}

	/**
	 * Switch Site Language
	 *
	 * @param string|null $language
	 */
	public function switchLang($language = null)
	{
		$lang = $this->auth->config->siteLanguage;

		if (is_string($language) && in_array($language, config('App')->supportedLocales))
		{
			$configTable = \Arifrh\DynaModel\DB::table($this->auth->config->configTable);

			$configTable->updateBy(['value' => $language], ['name' => 'site_language']);

			$lang = $language;
		}

		\Config\Services::language($lang);

		$prevURL = previous_url(true)->getPath();

		return redirect()->to($prevURL);
	}
}
