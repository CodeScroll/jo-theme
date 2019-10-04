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
    //echo '<pre>';print_r($item);echo '</pre>';
    if($itemCounter < $this->maxMenuItems){

     foreach ($item->classes as $key => $value) {
     	$itemClasses .= $value.' ';
     }
	 
	 $title = $this->getInfoFromItem($item);
	 if($title){
	  $output .= "<li class='".$itemClasses."'>".$title."</li>";	
	 }
    }

  	if($item->menu_item_parent == 0){
  	 $itemCounter++;	
  	}
  }

  function end_el(&$output, $item, $depth=0, $args=array(), $id = 0) {

  }
  
  function getInfoFromItem($item){

  	if($item->post_title !== ''){
  		return $item->post_title;
  	}elseif($item->title !== ''){
  		return $item->title;
  	}else{
  		return false;
  	}
  }
}