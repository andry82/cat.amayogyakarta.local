<?php
namespace App\Controllers;

use Arifrh\DynaModel\DB;
use Arifrh\Themes\Themes;

class UserController extends ProtectedController
{
	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->auth->requiredRoles(['Peserta']);

		$this->themes = Themes::init();

		$r = DB::table('registrasi');
		$r->belongsTo('desa');

		$this->user['peserta'] = $r->with('desa')->findOneBy(['user_id' => $this->user['id']]);

		$t = DB::table('tests');

		$this->user['tests'] = $t->findOneBy(['kode_test' => $this->user['peserta']['kode_test']]);

		$this->themes->setPageTitle('')->setVar([
			'user' => $this->user,
		]);
	}

	protected function getPoin()
	{
		$t = DB::table('tes_tertulis');

		$hasil = $t->select('SUM(poin) as totalPoin', false)
			->findOneBy([
				'no_registrasi' => $this->user['peserta']['no_registrasi'],
			]);

		$skor = $hasil['totalPoin'];

		$r = DB::table('registrasi');

		$r->updateBy([
			'skor_tertulis' => $skor,
		], [
			'no_registrasi' => $this->user['peserta']['no_registrasi'],
		]);

		return $skor;
	}
}
