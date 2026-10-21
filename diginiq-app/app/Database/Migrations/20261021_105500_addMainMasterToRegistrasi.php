<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class addMainMasterToRegistrasi extends Migration
{
	public function up()
	{
		if (! $this->db->fieldExists('main', 'registrasi'))
		{
			$this->forge->addColumn('registrasi', [
				'main' => [
					'after'   => 'skor_wawancara',
					'type'    => 'SMALLINT',
					'default' => 0,
				],
			]);
		}
	}

	public function down()
	{
		//
	}
}