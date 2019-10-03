<?php

namespace Library;

use Library\ThemeSettings;

class Menu{

	use ThemeSettings;

	private $allMenuItems = array();
	public function getMenu(){

		$itemsIds = $this->getParentItemsIds();
		foreach ($this->allMenuItems as $key => $value) {
			if (in_array($value->ID, $itemsIds)) {
				echo $value->post_title;
				echo '<br>';
			}
		}

	}
	public function getParentItemsIds(){

 		$itemCounter = 0;
 		$maxMenuItems = $this->getMaxMenuItemsPrinted();
 		$localItemIds = array();
		$this->allMenuItems = wp_get_nav_menu_items('Main');

		foreach ($this->allMenuItems as $key => $value) {
			
			if($itemCounter >= $maxMenuItems){

			 break;
			}

			if($value->menu_item_parent == 0){
				
				$itemCounter++;
			}

			array_push($localItemIds, $value->ID);
		}

	 return $localItemIds;
	}
}