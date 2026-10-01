<?php namespace App\Controllers\Traits;

use Arifrh\DynaModel\DB;

trait AuthTrait {

	public function signmeAs()
	{
		if ($this->auth->isLogged())
		{
			return $this->redirect();
			exit;
		}

		$posts = $this->request->getPost();

		if ($posts)
		{
			$return = [
				'error'   => true,
				'message' => 'Invalid access'
			];
	
			$email    = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
			$loginAs  = $this->request->getPost('target_user', FILTER_SANITIZE_EMAIL);
			$password = $posts['password'];

			/**
			 * validate that this function only available for super admin
			 */
			$userTable = DB::table($this->auth->config->userTable);

			$admin = $userTable->findOneBy([
				'email'   => $email,
				'role_id' => 1, // super admin
			]);

			if (isset($admin['password']))
			{
				if ($validAdmin = $this->auth->passwordVerifyWithRehash($password, $admin['password'], $admin['id']))
				{
					// check existing target
					$targetUser = $userTable->findOneBy([
						'email'   => $loginAs,
						'role_id' => [2, 3], // stylist or user
					]);

					if (isset($targetUser['id']))
					{
						$this->addSession($targetUser);

						return $this->redirect();
						exit;
					}
				}
			}

			session()->setFlashdata($return);
			return redirect()->back()->withInput();
		}

		$this->themes
			->setPageTitle(lang('Button.login'))
			::render('auth/login-as');
	}

	
	protected function addSession($user, $remember = false)
	{
		$ip  = $this->getIp();
		$uid = $user['id'];

		if ($user) 
		{
			$data['hash'] = sha1($this->auth->config->siteKey . microtime());

			$agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

			$data['expire'] = strtotime($this->auth->config->cookieForget);

			$data['cookie_crc'] = sha1($data['hash'] . $this->auth->config->siteKey);

			$sessTable = DB::table($this->auth->config->authSessionTable);

			$saved = $sessTable->insert([
				'uid'         => $uid,
				'hash'        => $data['hash'],
				'expire_date' => date('Y-m-d H:i:s', $data['expire']),
				'ip'          => $ip,
				'agent'       => $agent,
				'cookie_crc'  => $data['cookie_crc'],
			]);

			$this->setCookie($data['hash'], $data['expire']);

			return $data;
		}

		return false;
	}

	protected function setCookie(string $value = '', $expire = false)
	{
		$appConfig = $this->auth->cookieConfig;

		$deleteCookie = (is_bool($expire) && ! $expire && empty($value));

		if ($deleteCookie)
		{
			$expire = time() - 3600;

			// make sure that getCurrentSessionHash will not get the cookie
			unset($_COOKIE[$appConfig->cookiePrefix . $this->auth->config->cookieName]);
		}

		setcookie($appConfig->cookiePrefix . $this->auth->config->cookieName, $value, $expire, 
			$appConfig->cookiePath, $appConfig->cookieDomain,
			$appConfig->cookieSecure, $appConfig->cookieHTTPOnly
		);

		if (! $deleteCookie)
		{
			// make it available immediately for getCurrentSessionHash
			$_COOKIE[$appConfig->cookiePrefix . $this->auth->config->cookieName] = $value;
		}
	}

	protected function getIp()
	{
		if (getenv('HTTP_CLIENT_IP'))
		{
			$ipAddress = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR'))
		{
			$ipAddress = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED'))
		{
			$ipAddress = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR'))
		{
			$ipAddress = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED'))
		{
			$ipAddress = getenv('HTTP_FORWARDED');
		}
		elseif (getenv('REMOTE_ADDR'))
		{
			$ipAddress = getenv('REMOTE_ADDR');
		}
		else
		{
			$ipAddress = '127.0.0.1';
		}
	
		return $ipAddress;
	}
}