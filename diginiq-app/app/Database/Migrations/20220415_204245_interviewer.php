<?php

namespace App\Database\Migrations;

class interviewer extends \CodeIgniter\Database\Migration
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

	protected $sqlViews = [];

	protected $sqlFiles = [
		'interviewer',
	];

	/**
	 * Run Migragtion
	 *
	 * @return void
	 */
	public function up()
	{
		$this->runSqlFiles();
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
			$sqlCommands = explode(';', file_get_contents(WRITEPATH . 'sql/' . $view . '.sql'));

			foreach ($sqlCommands as $sql)
			{
				if (! empty(trim($sql)))
				{
					$this->db->query($sql);
				}
			}
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