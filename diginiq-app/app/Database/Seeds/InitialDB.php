<?php

namespace App\Database\Seeds;

class InitialDB extends \CodeIgniter\Database\Seeder
{
	/**
	 * Run Database Seeder
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('\Arifrh\Auth\Database\Seeds\AuthSeeder');
		$this->call('DummyUser');
	}
}