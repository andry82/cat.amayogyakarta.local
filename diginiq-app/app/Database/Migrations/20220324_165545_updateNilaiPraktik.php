<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class updateNilaiPraktik extends Migration
{
	public function up()
	{
		$fields = [
			'word1' => [
				'after'      => 'last_page',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'word2' => [
				'after'      => 'word1',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'word3' => [
				'after'      => 'word2',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'excel1' => [
				'after'      => 'word3',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'excel2' => [
				'after'      => 'excel1',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'excel3' => [
				'after'      => 'excel2',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'ppt1' => [
				'after'      => 'excel3',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'ppt2' => [
				'after'      => 'ppt1',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'ppt3' => [
				'after'      => 'ppt2',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'email1' => [
				'after'      => 'ppt3',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'email2' => [
				'after'      => 'email1',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'email3' => [
				'after'      => 'email2',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'interview1' => [
				'after'      => 'email3',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'interview2' => [
				'after'      => 'interview1',
				'type'       => 'VARCHAR',
				'constraint' => 3,
				'default'    => '',
        	],
			'interview3' => [
				'after'      => 'interview2',
				'type'       => 'VARCHAR',
				'constraint' => 3,
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
