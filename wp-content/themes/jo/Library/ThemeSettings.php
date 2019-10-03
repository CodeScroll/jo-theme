<?php

namespace Library;

trait ThemeSettings{

	public $maxMenuItemsPrinted = 8; // First to Last

	public function getMaxMenuItemsPrinted()
	{
		return $this->maxMenuItemsPrinted;
	}
}