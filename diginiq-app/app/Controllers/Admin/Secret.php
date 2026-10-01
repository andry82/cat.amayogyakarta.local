<?php namespace App\Controllers\Admin;

use Arifrh\DynaModel\DB;

class Secret extends \App\Controllers\AdminController
{
	public function index()
	{
		$s = DB::table('settings');

		$secret = $s->findOneBy(['name' => 'secretKey']);

		if (! isset($secret['value']))
		{
			$s->insert([
				'name'  => 'secretKey',
				'value' => 'totalwin123',
			]);
		}

		if ($key = $this->request->getPost('secretKey'))
		{
			$saved = $s->updateBy([
				'value' => $key,
			], [
				'name' => 'secretKey',
			]);

			if ($saved)
			{
				session()->setFlashdata('message', 'Kunci Rahasia telah diperbarui');

				return redirect()->to('/admin/secret');
			}
		}

		$this->themes
			::render('admin/set-secret-password', [
				'data' => $secret,
			]);
	}
}
