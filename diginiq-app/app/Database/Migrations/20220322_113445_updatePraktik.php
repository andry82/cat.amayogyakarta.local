<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class updatePraktik extends Migration
{
	public function up()
	{
		$fields = [
			'ada_tes_praktik' => [
				'after'      => 'timer_tes_tertulis',
				'type'       => 'TINYINT',
				'constraint' => 1,
				'default'    => 0,
        	],
		];

		$this->forge->addColumn('tests', $fields);
	}

	public function down()
	{
		//
	}
}
