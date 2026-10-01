<?php namespace App\Controllers\Admin;

use Arifrh\DynaModel\DB;

class User extends \App\Controllers\AdminController
{
	public function index()
	{
		$u = DB::table('users');
		$u->belongsTo('user_roles', 'role_id', 'roles');

		$users = $u->with('roles')
			->setOrderBy(['group_id' => 'asc'])
			->findBy([
				'group_id' => [1, 2],
			]);


		$this->themes
			->addJS('admin/user')
			::render('admin/user-list', [
				'users'  => $users,
				'status' => [0 => 'Terkunci (Tidak Aktif)', 1 => 'Aktif'],
			]);
	}

	public function form($id = null)
	{
		$u = DB::table('users');
		$r = DB::table('user_roles');

		$roles  = $r->findBy(['id' => [1, 2]]);
		$aRoles = array_key_value($roles, ['id' => 'role']);
	 
		$data = [];

		if ($posts = $this->request->getPost())
		{
			$newUser = (! isset($posts['id']) || empty($posts['id']));

			if (! empty($posts['email']))
			{
				$email    = trim($posts['email']);
				$password = $posts['password'];

				$userData = [
					'username' => $email,
					'fullname' => trim($posts['fullname']),
					'group_id' => $posts['role_id'],
					'role_id'  => $posts['role_id'],
				];
 
				if (! $newUser  && ! empty($password))
				{
					// only update password when it is not blank/empty
					$userData['password'] = $this->auth->getHash($password);
				}

				if ($newUser)
				{
					$return = $this->auth->register($email, $password, $password, $userData, false);
				}
				else
				{
					$updated = $u->update($posts['id'], array_merge($userData, [
						'active' => $posts['active'],
					]));

					$return['error'] =  (! $updated);
				}

				if (! $return['error'])
				{
					session()->setFlashdata('message', 'Data User Berhasil disimpan.');

					return redirect()->to('admin/user');
				}
				else
				{
					session()->setFlashdata([
						'error'   => true,
						'message' => 'Data User gagal disimpan.',
					]);

					return redirect()->back()->withInput();
				}
			}
			
		}

		if (! empty($id))
		{
			$data = $u->find($id);

			$data['password'] = ''; // leave blank to not change it
		}

		$this->themes
			->loadPlugins('datatable, datepicker, inputmask')
			::render('admin/user-form', [
				'id'    => $id,
				'data'  => $data,
				'roles' => $aRoles,
			]);
	}

	public function hapus()
	{
		if ($id = $this->request->getPost('id'))
		{
			DB::table('users')->delete($id);
		}
	}
}
