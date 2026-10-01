<?php

namespace App\Database\Migrations;

class viewPeserta extends \CodeIgniter\Database\Migration
{
	/**
	 * Table attributes
	 *
	 * @var mixed $attributes
	 */
	protected $attributes = ['ENGINE' => 'InnoDB'];

	/**
	 * Create Table if Not Exists ?
	 *
	 * @var boolean $ifNotExists
	 */
	protected $ifNotExists = true;

	protected $sqlViews = [
		'peserta',
	];

	protected $sqlFiles = [];

	/**
	 * Run Migragtion
	 *
	 * @return void
	 */
	public function up()
	{
		$this->runSqlViews();
	}

	protected function runSqlFiles()
	{
		foreach ($this->sqlFiles as $sqlCommand)
		{
			$sqlCommands = explode(';', file_get_contents(WRITEPATH . 'sql/' . $sqlCommand . '.sql'));

			foreach ($sqlCommands as $sql)
			{
				if (! empty(trim($sql)))
				{
					$this->db->query($sql);
				}
			}
		}
	}

	protected function runSqlViews()
	{
		foreach ($this->sqlViews as $view)
		{
			$sql = file_get_contents(WRITEPATH . 'sql/' . $view . '.sql');

			$this->db->query($sql);
		}
	}

	protected function dropViews()
	{
		foreach ($this->sqlViews as $view)
		{
			$this->db->query('DROP VIEW IF EXISTS ' . $view);
		}
	}

	/**
	 * Rollback Migration
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dropViews();
	}
}