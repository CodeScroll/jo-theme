<?php

namespace Library;

use Library\ThemeSettings;

class Menu{

	public function getMenu(){

	 	$walker = new CustomMenu();
	 	wp_nav_menu(array(
			'menu' => 'Main',
			'walker'=>$walker
		));
	}
}

class CustomMenu extends \Walker_Nav_Menu {
  
  use ThemeSettings;

  private $maxMenuItems = 0 ;

  function __construct(){
  	$this->maxMenuItems = $this->getMaxMenuItemsPrinted();
  }
  function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
  	static $itemCounter = 0;
    $itemClasses = '';

    if($itemCounter < $this->maxMenuItems){

     foreach ($item->classes as $key => $value) {
     	$itemClasses .= $value.' ';
     }
  	 $output .= '<ul>';	
  	 $output .= "<li class='".$itemClasses."'>".$item->post_title."</li>";
    }

  	if($item->menu_item_parent == 0){
  	 $itemCounter++;	
  	}
  }

  function end_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
  	$output .= '</ul>';
  }
  
}