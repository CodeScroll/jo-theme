<?php

namespace Library;

trait ThemeSettings{

	public $maxMenuItemsPrinted = 8; // First to Last
	public $transDomain = 'jo';

	public function getMaxMenuItemsPrinted()
	{
		return $this->maxMenuItemsPrinted;
	}

	public function getTransDomain(){
		return $this->transDomain;
	}
}