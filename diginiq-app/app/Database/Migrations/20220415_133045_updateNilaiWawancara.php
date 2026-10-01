<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class updateNilaiWawancara extends Migration
{
	public function up()
	{
		$fields = [
			'interview11' => [
				'after'      => 'interview3',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview12' => [
				'after'      => 'interview11',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview13' => [
				'after'      => 'interview12',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview14' => [
				'after'      => 'interview13',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview15' => [
				'after'      => 'interview14',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview21' => [
				'after'      => 'interview15',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview22' => [
				'after'      => 'interview21',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview23' => [
				'after'      => 'interview22',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview24' => [
				'after'      => 'interview23',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview25' => [
				'after'      => 'interview24',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview31' => [
				'after'      => 'interview25',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview32' => [
				'after'      => 'interview31',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview33' => [
				'after'      => 'interview32',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview34' => [
				'after'      => 'interview33',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'interview35' => [
				'after'      => 'interview34',
				'type'       => 'VARCHAR',
				'constraint' => 5,
				'default'    => '',
        	],
			'pewawancara_id' => [
				'after'      => 'interview35',
				'type'       => 'INT',
				'constraint' => 11,
				'default'    => '',
        	],
		];

		$this->forge->addColumn('registrasi', $fields);
	}

	public function down()
	{
		//
	}
}
