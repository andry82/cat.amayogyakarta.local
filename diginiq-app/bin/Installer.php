<?php

/**
 * Part of Diginiq Starter Installer
 *
 * @package   CodeIgniter4 Installer
 * @author    Arif Rahman Hakim <arifrahmanhakim.net@gmail.com>
 * @license   https://github.com/arif-rh/diginiq-starter/blob/master/LICENSE MIT license
 * @copyright 2020 Arif RH
 * @link      https://github.com/arif-rh/diginiq-starter
 */

namespace Arifrh\Diginiq;

defined('BIN_PATH')       || define('BIN_PATH', dirname(__FILE__));
defined('APP_BIN')        || define('APP_BIN', BIN_PATH . '/app');
defined('INSTALLER_PATH') || define('INSTALLER_PATH', dirname(BIN_PATH));
defined('BASE_PATH')      || define('BASE_PATH', dirname(INSTALLER_PATH));
defined('CI4_SYSTEM')     || define('CI4_SYSTEM', basename(INSTALLER_PATH));
defined('APP_DIR')        || define('APP_DIR', CI4_SYSTEM . '/app');
defined('CONFIG_DIR')     || define('CONFIG_DIR', APP_DIR . '/Config');
defined('VENDOR_DIR')     || define('VENDOR_DIR', CI4_SYSTEM . '/vendor');
defined('VENDOR_CI4')     || define('VENDOR_CI4', VENDOR_DIR . '/codeigniter4/framework');
defined('PUBLIC_DIR')     || define('PUBLIC_DIR', 'htdocs/public');
defined('BASE_URL')       || define('BASE_URL', 'http://diginiq-app.local/');

use Composer\Script\Event;

/**
 * Diginiq Starter Installer
 *
 * @author Arif Rahman Hakim <arifrahmanhakim.net@gmail.com>
 */
class Installer
{
	/**
	 * Composer post install script
	 *
	 * @param Event $event
	 *
	 * @return void
	 */
	public static function postInstall(Event $event = null)
	{
		self::initialize();

		self::setupProject();

		// Show message
		self::showMessage($event);
	}

	/**
	 * Initialize installer
	 *
	 * @return void
	 */
	private static function initialize()
	{
		self::recursiveCopy(VENDOR_CI4 . '/app', APP_DIR);
		self::recursiveCopy(VENDOR_CI4 . '/public', PUBLIC_DIR);

		$spark = BASE_PATH . '/spark';

		copy(VENDOR_CI4 . '/spark', $spark);

		$sparkPath = [
			"define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);" => "define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . '" . PUBLIC_DIR . "' . DIRECTORY_SEPARATOR);",
			'$pathsConfig = ' . "'app/Config/Paths.php';"                                       => '$pathsConfig = ' . "'" . APP_DIR . "/Config/Paths.php';",
		];

		$contents = file_get_contents($spark);

		file_put_contents($spark, strtr($contents, $sparkPath));
	}

	/**
	 * Setup Project
	 *
	 * @return void
	 */
	private static function setupProject()
	{
		self::setEnvirontment();

		self::setPaths();

		self::setRoutes();

		self::setupThemes();

		self::setupAuth();

		self::updateAddons();
	}

	/**
	 * Setup Environtment
	 *
	 * @return void
	 */
	private static function setEnvirontment()
	{
		$env = CI4_SYSTEM . '/env';

		copy(VENDOR_CI4 . '/env', $env);

		$mailEnv = "
#--------------------------------------
# EMAIL
#--------------------------------------

email.protocol = 'smtp'
email.SMTPHost = ''
email.SMTPUser = ''
email.SMTPPass = ''
email.SMTPPort = '587'
email.mailType = 'html'
		";

		file_put_contents($env, $mailEnv, FILE_APPEND);

		$contents = file_get_contents($env);

		$envValues = [
			'# CI_ENVIRONMENT = production' => 'CI_ENVIRONMENT = development',
			"# app.baseURL = ''"            => "app.baseURL = '" . BASE_URL . "'",
		];		

		file_put_contents($env, strtr($contents, $envValues));

		copy($env, CI4_SYSTEM . '/.env');
	}

	/**
	 * Setup Paths
	 *
	 * @return void
	 */
	private static function setPaths()
	{
		// main paths
		$mainPaths = [
			'$pathsConfig = FCPATH . ' . "'../app/Config/Paths.php';" => '$pathsConfig = FCPATH . ' . "'../../" . APP_DIR . "/Config/Paths.php';",
		];

		$index    = PUBLIC_DIR . '/index.php';
		$contents = file_get_contents($index);

		file_put_contents($index, strtr($contents, $mainPaths));

		// other paths
		$newPaths = [
			'$systemDirectory = __DIR__ . ' . "'/../../system';"     => '$systemDirectory = __DIR__ . ' . "'/../../../" . VENDOR_CI4 . "/system';",
			'$writableDirectory = __DIR__ . ' . "'/../../writable';" => '$writableDirectory = __DIR__ . ' . "'/../../../writable';",
			'$testsDirectory = __DIR__ . ' . "'/../../tests';"       => '$testsDirectory = __DIR__ . ' . "'/../../" . CI4_SYSTEM . "/tests';",
		];

		$paths    = CONFIG_DIR . '/Paths.php';
		$contents = file_get_contents($paths);

		file_put_contents($paths, strtr($contents, $newPaths));

		// constants
		$composerPaths = [
			"define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');" => "define('COMPOSER_PATH', ROOTPATH . '../" . CI4_SYSTEM . "/vendor/autoload.php');",
		];

		$constants = CONFIG_DIR . '/Constants.php';
		$contents  = file_get_contents($constants);

		file_put_contents($constants, strtr($contents, $composerPaths));
	}

	/**
	 * Setup Routes
	 *
	 * @return void
	 */
	private static function setRoutes()
	{
		// remove index.php from url
		$removeIndex = [
			'$baseURL = \'http://localhost:8080/\';' => '$baseURL = \'' . BASE_URL . "';",
			'$indexPage = ' . "'index.php';"         => '$indexPage = \'\';',
		];

		$app     = CONFIG_DIR . '/App.php';
		$contents = file_get_contents($app);

		file_put_contents($app, strtr($contents, $removeIndex));
	}

	/**
	 * Setup Themes
	 */
	private static function setupThemes()
	{
		copy(APP_BIN . '/Config/Themes.php', CONFIG_DIR . '/Themes.php');
		copy(APP_BIN . '/Helpers/bootstrap_helper.php', APP_DIR . '/Helpers/bootstrap_helper.php');

		self::recursiveCopy(BIN_PATH . '/themes', PUBLIC_DIR . '/themes');
	}

	/**
	 * Setup Auth
	 */
	private static function setupAuth()
	{
		// copies Auth Controllers, Database & views
		self::recursiveCopy(APP_BIN . '/Controllers', APP_DIR . '/Controllers');
		self::recursiveCopy(APP_BIN . '/Database/Seeds', APP_DIR . '/Database/Seeds');
		self::recursiveCopy(APP_BIN . '/Views', APP_DIR . '/Views');

		// add auth routes
		$routes     = CONFIG_DIR . '/Routes.php';
		$newRoutes  = APP_BIN . '/Config/Routes.php';
		$extraRoute = file_get_contents($newRoutes);

		file_put_contents($routes, $extraRoute, FILE_APPEND);
	}

	/**
	 * Update Extra data for projects
	 */
	private static function updateAddons()
	{
		// Update README
		$readme = BASE_PATH . '/README.md';
		$note   = BIN_PATH . '/NOTE.md';

		$newNote = file_get_contents($note);

		file_put_contents($readme, $newNote);

		// copy Language Files
		self::recursiveCopy(APP_BIN . '/Language', APP_DIR . '/Language');
	}

	/**
	 * Initial Commit
	 *
	 * @return void
	 */
	private static function initialCommit()
	{
		copy(BIN_PATH . '/.gitignore', BASE_PATH . '/.gitignore');

		chdir(BASE_PATH);

		passthru('git init');
		passthru('git add .');
		passthru('git commit -m "initial Commit"');
	}

	/**
	 * Composer post install script
	 *
	 * @param Event $event
	 *
	 * @return void
	 */
	private static function showMessage(Event $event = null)
	{
		self::initialCommit();

		$io = $event->getIO();
		$io->write('==================================================');
		$io->write(
			'<info>CodeIgniter 4 Project is Ready!</info>'
		);
		$io->write('==================================================');
	}

	/**
	 * Recursive Remove Directory
	 *
	 * @param  mixed $dir
	 *
	 * @return void
	 */
	private static function recursiveRemoveDir($dir) 
	{
		if (is_dir($dir)) 
		{
			$objects = scandir($dir); 
			foreach ($objects as $object) { 
				if ($object != '.' && $object != '..') 
				{
					if (is_dir($dir . '/' . $object))
					{
						self::recursiveRemoveDir($dir . '/' . $object);
					}
					else
					{
						unlink($dir . '/' . $object);
					}
				}
			}
			rmdir($dir); 
		}
	}

	/**
	 * Recursive Copy
	 *
	 * @param string $src
	 * @param string $dst
	 *
	 * @return void
	 */
	private static function recursiveCopy(string $src, string $dst)
	{
		if (! is_dir($dst))
		{ 
			mkdir($dst, 0755);
		}

		$iterator = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator($src, \RecursiveDirectoryIterator::SKIP_DOTS),
			\RecursiveIteratorIterator::SELF_FIRST
		);

		foreach ($iterator as $file) {
			if ($file->isDir())
			{
				mkdir($dst . '/' . $iterator->getSubPathName());
			} 
			else
			{
				copy($file, $dst . '/' . $iterator->getSubPathName());
			}
		}
	}
}