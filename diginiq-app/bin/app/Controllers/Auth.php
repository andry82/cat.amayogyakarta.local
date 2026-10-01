<?php namespace App\Controllers;

/**
 * Example of Authentication Controller
 * for Registration, Login, Activation, Reset Password
 */
class Auth extends PublicController
{
	public function login()
	{
		$posts = $this->request->getPost();

		if ($posts)
		{
			$email    = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
			$remember = (bool) $this->request->getPost('remember');

			$return = $this->auth->login($email, $posts['password'], $remember);

			if (! $return['error'])
			{
				return redirect()->to('/admin')->send();
			}
			else
			{
				session()->setFlashdata($return);
				return redirect()->back()->withInput();
			}
		}

		$this->themes
			->setPageTitle('Login')
			::render('auth/login');
	}

	public function logout()
	{
		$this->auth->logout($this->auth->getCurrentSessionHash());

		if (! $this->auth->isLogged())
		{
			session()->setFlashdata('message', 'You have successfully logged out.');
			return redirect()->to('/login');
		}
	}

	public function register()
	{
		$posts = $this->request->getPost();

		if ($posts)
		{
			$email    = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
			$userData = [
				'username' => $this->request->getPost('username'),
				'fullname' => $this->request->getPost('fullname'),
			];

			$return = $this->auth->register($email, $posts['password'], $posts['confirmPassword'], $userData);
	
			if (! $return['error'])
			{
				session()->setFlashdata($return);
				return redirect()->to('/login')->send();
			}
			else
			{
				session()->setFlashdata($return);
				return redirect()->back()->withInput();
			}
		}

		$this->themes
			->setPageTitle('Register')
			::render('auth/register');
	}

	public function activate($token = '')
	{
		$token = $this->request->getPost('token') ?? $token;

		if (! empty($token))
		{
			$return = $this->auth->activateUserAccount($token);

			if (! $return['error'])
			{
				session()->setFlashdata($return);
				return redirect()->to('/login')->send();
			}
			else
			{
				session()->setFlashdata($return);
				return redirect()->back()->withInput();
			}
		}

		$this->themes	
			->setPageTitle('Activate Account')
			::render('auth/activate', ['token' => $token]);
	}

	public function requestActivation()
	{
		$posts = $this->request->getPost();

		if ($posts)
		{
			$email = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);

			$return = $this->auth->resendActivation($email);

			if (! $return['error'])
			{
				session()->setFlashdata($return);
				return redirect()->to('/activate')->send();
			}
			else
			{
				session()->setFlashdata($return);
				return redirect()->back()->withInput();
			}
		}

		$this->themes
			->setPageTitle('Activation Request')
			::render('auth/activation-request');
	}

	public function requestReset()
	{
		$posts = $this->request->getPost();

		if ($posts)
		{
			$email = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);

			$return = $this->auth->requestReset($email);

			if (! $return['error'])
			{
				session()->setFlashdata($return);
				return redirect()->to('/reset')->send();
			}
			else
			{
				session()->setFlashdata($return);
				return redirect()->back()->withInput();
			}
		}

		$this->themes
			->setPageTitle('Request for Password Resetting')
			::render('auth/reset-request');
	}

	public function resetPassword($token = '')
	{
		$token = $this->request->getPost('token') ?? $token;

		if ($this->request->getPost())
		{
			$password        = $this->request->getPost('password');
			$confirmPassword = $this->request->getPost('confirmPassword');

			$return = $this->auth->resetPass($token, $password, $confirmPassword);

			if (! $return['error'])
			{
				session()->setFlashdata($return);
				return redirect()->to('/login')->send();
			}
			else
			{
				session()->setFlashdata($return);
				return redirect()->back()->withInput();
			}
		}

		$this->themes
			->setPageTitle('Reset Password')
			::render('auth/reset-password', ['token' => $token]);
	}

	public function forbidden($type = 'role')
	{
		echo view('auth/forbidden', ['message' => lang('Auth.invalid_' . $type)]);
	}
}
