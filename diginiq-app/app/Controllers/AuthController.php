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
use Arifrh\DynaModel\DB;
use App\Controllers\Traits\WSTrait;
use CodeIgniter\Controller;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class AuthController extends Controller implements MessageComponentInterface
{
	use WSTrait;

	/**
	 * Autoload helper
	 *
	 * @var array
	 */
	protected $helpers = ['array', 'bootstrap', 'cookie', 'date', 'form'];

	/**
	 * Auth Object
	 *
	 * @var stdClass
	 */
	public $auth = null;

	protected $settings = null;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->auth = new Auth();

		\Config\Services::language($this->auth->config->siteLanguage);

		$this->settings = $this->auth->config;
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

	public function onMessage(ConnectionInterface $from, $msg)
	{
		$numRecv = count($this->clients) - 1;

		$data = json_decode($msg, true);

		if (is_array($data) && isset($data['type']))
		{
			// handle custom message type

			switch ($data['type'])
			{
				case 'update':
					if (isset($data['table']))
					{
						$t = DB::table($data['table']);
	
						$t->updateBy([
							$data['field'] => $data['value'],
						], [
							$data['key'] => $data['keyval'],
						]);
					}
					break;
	
				case 'update-jawaban':
					if (isset($data['table']))
					{
						if ($data['table'] === 'tes_tertulis' && $data['field'] === 'jawaban')
						{
							$t = DB::table('tes_tertulis');
							$soal = $t->findOneBy(['id' => $data['keyval']]);

							if (is_array($soal))
							{
								$r = DB::table('registrasi');
								$registrasi = $r->findOneBy(['no_registrasi' => $soal['no_registrasi']]);
								$tests = DB::table('tests');
								$test = is_array($registrasi)
									? $tests->findOneBy(['kode_test' => $registrasi['kode_test']])
									: null;

								if (is_array($test))
								{
									$poin = $data['value'] === $soal['kunci_jawaban']
										? $test['poin_tes_tertulis']
										: 0;

									$t->updateBy([
										'waktu_jawab' => date('Y-m-d H:i:s'),
										'jawaban'     => $data['value'],
										'poin'        => $poin,
									], [
										'id' => $data['keyval'],
								]);
								}
							}
						}
						else
						{
							$t = DB::table($data['table']);

							$t->updateBy([
								'waktu_jawab'  => date('Y-m-d H:i:s'),
								$data['field'] => $data['value'],
							], [
								$data['key'] => $data['keyval'],
							]);
						}
					}
					break;
	
				case 'finish-tertulis':
					$t = DB::table('registrasi');
	
					$t->updateBy([
						'selesai_tes_tertulis' => date('Y-m-d H:i:s'),
						'sisa_waktu_tertulis'  => 0,
					], [
						$data['key'] => $data['keyval'],
					]);
	
					break;
			
				case 'update-praktik':
					if (isset($data['table']))
					{
						$r = DB::table($data['table']);
	
						$r->updateBy([
							$data['field'] => $data['value'],
						], [
							$data['key'] => $data['keyval'],
						]);

						$ts = DB::table('tests');

						$tes = $ts->findOneBy(['kode_test' => $data['kodeTest']]);

						$prosentaseWord = $prosentaseExcel = $prosentasePpt = $prosentaseEmail = 0;

						if (is_array($tes))
						{
							$prosentaseWord  = floatval($tes['prosentase_word'])/100;
							$prosentaseExcel = floatval($tes['prosentase_excel'])/100;
							$prosentasePpt   = floatval($tes['prosentase_ppt'])/100;
							$prosentaseEmail = floatval($tes['prosentase_email'])/100;
						}

						$row = $r->findOneBy([$data['key'] => $data['keyval']]);

						$data['skor_word']    = round(((floatval($row['word1']) + floatval($row['word2']) + floatval($row['word3'])) / 3),2);
						$data['skor_excel']   = round(((floatval($row['excel1']) + floatval($row['excel2']) + floatval($row['excel3'])) / 3),2);
						$data['skor_ppt']     = round(((floatval($row['ppt1']) + floatval($row['ppt2']) + floatval($row['ppt3'])) / 3),2);
						$data['skor_email']   = round(((floatval($row['email1']) + floatval($row['email2']) + floatval($row['email3'])) / 3),2);
						$data['skor_praktik'] = round((($data['skor_word'] * $prosentaseWord) + ($data['skor_excel'] * $prosentaseExcel) + ($data['skor_ppt'] * $prosentasePpt) + ($data['skor_email'] * $prosentaseEmail)), 2);

						$data['interview1']     = floatval($row['interview1']);
						$data['interview2']     = floatval($row['interview2']);
						$data['interview3']     = floatval($row['interview3']);
						$data['skor_wawancara'] = round((($data['interview1'] + $data['interview2'] + $data['interview3'])/3),2);

						$r->update($row['id'], [
							'skor_word'    => $data['skor_word'],
							'skor_excel'   => $data['skor_excel'],
							'skor_ppt'     => $data['skor_ppt'],
							'skor_email'   => $data['skor_email'],
							'skor_praktik' => $data['skor_praktik'],
							'interview1'   => $data['interview1'],
							'interview2'   => $data['interview2'],
							'interview3'   => $data['interview3'],

							'skor_wawancara' => $data['skor_wawancara'],
						]);
					}
					
					$data['prefix'] = 'nilai_' . strtolower($row['no_registrasi']) . '_';

					$msg = json_encode($data);
					break;
	
				case 'finish-praktik':
					$t = DB::table('registrasi');
	
					$t->updateBy([
						'selesai_tes_praktik' => date('Y-m-d H:i:s'),
						'sisa_waktu_praktik'  => 0,
						'last_page'           => '/test/selesai',
					], [
						$data['key'] => $data['keyval'],
					]);
	
					break;
			
				default:
					// nothing to do
			}
		}

		log_message('debug', sprintf('Connection %d is sending message "%s" to %d other connection%s' . "\n", $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's'));

		foreach ($this->clients as $client)
		{
			//if ($from !== $client)
			{
				$client->send($msg);
			}
		}
	}
}
