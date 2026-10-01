<?php namespace App\Controllers\Traits;

trait PrintTrait {

	protected $printHeader   = 'templates/print-header';
	protected $printContent  = 'templates/krs-template';
	protected $printFooter   = 'templates/print-footer';
	protected $printTemplate = 'templates/print-template';

	protected $printConfig = [];
	protected $isAutoPrint = false;

	public function print()
	{
		helper('themes');

		echo view($this->printTemplate, [
			'print'   => $this->isAutoPrint,
			'header'  => $this->getPrintHeader(),
			'content' => $this->getPrintContent(),
			'footer'  => $this->getPrintFooter(),
		]);
	}

	protected function autoPrint($stat = true)
	{
		$this->isAutoPrint = $stat;
	}

	protected function setPrintConfig($config)
	{
		$this->printConfig = $config;
	}

	protected function setPrintHeader($header = 'templates/header')
	{
		$this->printHeader = $header;
	}

	protected function setPrintContent($content = 'templates/krs-template')
	{
		$this->printContent = $content;
	}

	protected function setPrintFooter($footer = 'templates/krs-footer')
	{
		$this->printFooter = $footer;
	}

	protected function setPrintTemplate($template = 'templates/print-template')
	{
		$this->printTemplate = $template;
	}

	protected function getPrintHeader()
	{
		return view($this->printHeader, $this->printConfig);
	}

	protected function getPrintContent()
	{
		return view($this->printContent, $this->printConfig);
	}

	protected function getPrintFooter()
	{
		return view($this->printFooter, $this->printConfig);
	}
}