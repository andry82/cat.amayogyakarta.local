<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class updatePraktikOffice extends Migration
{
	public function up()
	{
		$fields = [
			'prosentase_word' => [
				'after'      => 'prosentase_tertulis',
				'type'       => 'TINYINT',
				'constraint' => 3,
				'default'    => 0,
        	],
			'prosentase_excel' => [
				'after'      => 'prosentase_word',
				'type'       => 'TINYINT',
				'constraint' => 3,
				'default'    => 0,
        	],
			'prosentase_ppt' => [
				'after'      => 'prosentase_excel',
				'type'       => 'TINYINT',
				'constraint' => 3,
				'default'    => 0,
        	],
			'prosentase_email' => [
				'after'      => 'prosentase_ppt',
				'type'       => 'TINYINT',
				'constraint' => 3,
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
