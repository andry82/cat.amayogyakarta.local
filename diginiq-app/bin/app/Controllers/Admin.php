<?php namespace App\Controllers;

/**
 * Example of Admin Conctroller which be protected
 * so only logged in user can access it
 */
class Admin extends ProtectedController
{
	public function index()
	{
		$s = \Arifrh\DynaModel\DB::table($this->auth->config->authSessionTable);

		$sess = $s->findOneBy(['hash' => $this->auth->getCurrentSessionHash()]);

		return view('auth/welcome', $sess);
	}

	public function role()
	{
		$this->auth->requiredRoles(['Administrator']);

		echo "Only Administrator can see this message";
	}
}
