<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class updateKategoriSoal2 extends Migration
{
	public function up()
	{
		$fields = [
			'bank_soal' => [
				'after'      => 'id',
				'type'       => 'SMALLINT',
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
