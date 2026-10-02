<?php
namespace App\Controllers;

use Arifrh\DynaModel\DB;

class Petunjuk extends UserController
{
    public function tertulis()
    {
        $this->themes
			->loadPlugins('websocket')
			->addJS('test/html2canvas.min.js')
			->addJS('test/screen-capture.js')
			::render('test/petunjuk-tertulis');
    }

    public function praktik()
    {
		$r = DB::table('registrasi');

		$r->updateBy([
			'last_page' => '/petunjuk/praktik',
		], [
			'no_registrasi' => $this->user['peserta']['no_registrasi'],
		]);

        $this->themes
			::render('test/petunjuk-praktik', [
				'poin' => $this->getPoin(),
			]);
    }
}
