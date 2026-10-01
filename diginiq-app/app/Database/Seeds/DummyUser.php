<?php

namespace App\Database\Seeds;

class DummyUser extends \CodeIgniter\Database\Seeder
{
	/**
	 * Run Database Seeder
	 *
	 * @return void
	 */
	public function run()
	{
		$config = \CodeIgniter\Config\Factories::config('Auth');

		$adminPassword = 'admin@DIGINIQ#789';

		$adminPassword = password_hash($adminPassword, PASSWORD_BCRYPT, ['cost' => $config->bcryptCost]);

		$sql = "
		INSERT INTO " . $config->userTable . " (`email`, `password`, `group_id`, `role_id`, `active`) VALUES
			('admin@diginiq.net', '" . $adminPassword . "', 1, 1, 1);
		";

		$this->db->query($sql);
	}
}