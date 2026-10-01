<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class updateKategoriSoal extends Migration
{
	public function up()
	{
		$fields = [
			'porsi_soal' => [
				'after'      => 'kategori',
				'type'       => 'TINYINT',
				'constraint' => 3,
				'default'    => 0,
        	],
		];

		$this->forge->addColumn('kategori_soal', $fields);
	}

	public function down()
	{
		//
	}
}
