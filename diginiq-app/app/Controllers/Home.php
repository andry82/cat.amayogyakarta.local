<?php
namespace App\Controllers;

use Arifrh\DynaModel\DB;

class Home extends PublicController
{
    public function index()
    {
		if ($this->auth->isLogged())
		{
			$user = $this->auth->getCurrentUser();

			if ($user['group_id'] === '3')
			{
				$r = DB::table('registrasi');
			
				$user['peserta'] = $r->findOneBy(['user_id' => $user['id']]);

				return redirect()->to($user['peserta']['last_page']);
			}

			if ($user['group_id'] === '1')
			{
				return redirect()->to('/admin/dashboard');
			}
		}

        $this->themes
			->loadPlugins('websocket')
			->addJS('test/html2canvas.min.js')
			->addJS('test/screen-capture.js')
			::render('landing-page');
    }

    public function registrasi()
    {
		$validCaptcha = session()->get('captcha');

		if (!$validCaptcha)
		{
			$validCaptcha = generate_captcha_sum(1, 10, 20);

			session()->set('captcha', $validCaptcha);
		}

		if ($post = $this->request->getPost())
		{
			if (intval($post['captcha']) === intval($validCaptcha['sum']))
			{
				$t = DB::table('tests');

				$tests = $t->findOneBy(['kode_test' => $post['kode_test']]);

				$r = DB::table('registrasi');

				$baru = [
					'no_registrasi'       => trim($post['no_registrasi']),
					'nama_lengkap'        => trim($post['nama_lengkap']),
					'kode_test'           => trim($post['kode_test']),
					'desa_id'             => $post['desa_id'],
					'tanggal_registrasi'  => date('Y-m-d H:i:s'),
					'sisa_waktu_tertulis' => intval($tests['timer_tes_tertulis']) * 60, // konversi ke timer detik
					'sisa_waktu_praktik'  => intval($tests['timer_tes_praktik']) * 60, // konversi ke timer detik
					'last_page'           => '/petunjuk/tertulis',
				];
		
				// validate to prevent duplicate
				$row = $r->findOneBy([
					'no_registrasi' => trim($post['no_registrasi']),
				]);

				$exist = (! empty($row));
				
				if (!$exist) {
					// simpan data registrasi baru
					$id = $r->insert($baru);

					// daftarkan user peserta agar bisa login dan lanjut test jika mati lampu
					$userData = [
						'username' => trim($post['no_registrasi']),
						'fullname' => trim($post['nama_lengkap']),
						'group_id' => 3,
						'role_id'  => 3,
					];

					// karena registrasi tidak memasukkan email, jadi buat email dummy dari no registrasi agar unik
					$email    = url_title($userData['username'], '_', true) . '@cat.amayogyakarta.ac.id';
					$password = trim($userData['username']);
	
					$return = $this->auth->register($email, $password, $password, $userData, false);

					if (! $return['error'])
					{
						$userId = $this->auth->getUID($email);

						$r->update($id, ['user_id' => $userId]);

						$loggedIn = $this->auth->login($email, $password);

						if (! $loggedIn['error'])
						{
							session()->remove('captcha');

							return redirect()->to('/petunjuk/tertulis');
						}
					}
					else
					{
						session()->setFlashdata($return);
						return redirect()->back()->withInput();
					}
				}
				else {
					session()->setFlashdata([
						'error'   => true,
						'message' => 'No registrasi sudah terdaftar.',
					]);

					return redirect()->back()->withInput();
				}
			}
			else
			{
				session()->setFlashdata([
					'error'   => true,
					'message' => 'Kode Captcha tidak sah!',
				]);

				return redirect()->back()->withInput();
			}
		}
	
        $this->themes
			->loadPlugins('depdrop, alert, inputmask')
			->addJS('test/registrasi')
			->addJS('test/html2canvas.min.js')
			->addJS('test/screen-capture.js')
			::render('registrasi', [
				'captcha' => $validCaptcha,
			]);
    }

	public function pilihanDesa()
	{
		$d = DB::table('desa');

		$params = $this->request->getPost('depdrop_all_params');

		$list = $d->findBy(['kode_test' => $params['kode_test']]);

		$options = [];

		foreach ($list as $row)
		{
			$options[] = ['id' => $row['id'], 'name' => $row['nama_desa']];
		}

		return $this->response->setJSON([
			'output'   => $options,
			'selected' => $params['desaId'],
		]);
	}

	public function checkKode()
	{
		$return = [
			'invalid' => false,
		];

		if ($kode = $this->request->getPost('kode'))
		{
			$t = DB::table('tests');

			$row = $t->findOneBy([
				'kode_test'    => trim($kode),
				'tanggal_test' => date('Y-m-d'),
				'status'       => 1,
			]);

			if (empty($row))
			{
				$return['invalid'] = true;
			}
		}

		return $this->response->setJSON($return);
	}

	public function checkNoReg()
	{
		$return = [
			'invalid' => false,
		];

		if ($no = $this->request->getPost('no_registrasi'))
		{
			$r = DB::table('registrasi');

			$row = $r->findOneBy([
				'no_registrasi' => trim($no),
			]);

			if (! empty($row))
			{
				$return['invalid'] = true;
			}
		}

		return $this->response->setJSON($return);
	}

	public function notFound()
	{
		$this->themes::render('admin/404');
	}

	public function clear()
	{
		$reset = session()->get('resetAllowed');

		if ($reset)
		{
			DB::table('auth_attempts')->truncate();
			session()->remove('resetAllowed');
		}
		else
		{
			$this->themes
				->loadPlugins('alert')
				->addJS('clear');
		}

		$this->themes::render('admin/404');
	}

	public function validateAccess()
	{
		$return = [
			'success'  => false,
			'msg'      => 'Password tidak benar!',
			'redirect' => '',
		];

		if ($pass = $this->request->getPost('pass'))
		{
			$return['success']  = $pass === $this->settings->secretKey;

			session()->set('resetAllowed', true);
		}

		return $this->response->setJSON($return);
	}
}
