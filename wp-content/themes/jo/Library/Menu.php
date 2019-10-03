<?php

namespace Library;

use Library\ThemeSettings;

class Menu{

	use ThemeSettings;

	public function getMenu(){

 		$allMenuItems = wp_get_nav_menu_items('Main');
		$maxMenuItems = $this->getMaxMenuItemsPrinted();
		$menuItems = array();

		foreach ($allMenuItems as $key => $value) {
			
			if($key >= $maxMenuItems){

			 break;
			}
			array_push($menuItems, $value->post_title);
		}

	 return $menuItems;
	}
}