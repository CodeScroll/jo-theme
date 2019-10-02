<?php


// Organize function to subfolders
addSubfolderFunctions();

if( is_admin() ){
 add_action( 'admin_enqueue_scripts', 'my_theme_admin_styles' );
}

function addSubfolderFunctions(){

 $dir = __DIR__."/functions";
 getSubfolder($dir);
}

function getSubfolder($path){
 
 $currentFolder = glob($path . '/*' , GLOB_ONLYDIR);
 foreach ($currentFolder as $key => $value) {
 	getAllFiles($value);
 	getSubfolder($value);
 }
}

function getAllFiles($path){
 if ($handle = opendir($path)) {
  while (false !== ($entry = readdir($handle))) {
   if ($entry != "." && $entry != ".." && isPHPFile($entry)) {
    include $path.'/'.$entry;
   }
  }
  closedir($handle);
 }
}

function isPHPFile($filename){

	$file_parts = pathinfo($filename);
	switch($file_parts['extension'])
	{
	    case "php":
	     return $filename;
	    break;
	    default:
	     return false;
	}
}

function my_theme_admin_styles(){
   wp_enqueue_script( 'jo-theme-admin', get_stylesheet_directory_uri() . '/assets/js/jo-theme-admin.js',array('jquery'));
}

if ( !is_admin() ){
 add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' ); 
}

function my_theme_enqueue_styles() {
  
  wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap/bootstrap.min.css');
  wp_deregister_script('jquery');
  wp_enqueue_script( 'jquery-3.4.1', get_stylesheet_directory_uri() . '/assets/js/jquery-3.4.1.min.js');
  wp_enqueue_script( 'popper.min.js', get_stylesheet_directory_uri() . '/assets/js/popper.min.js');
  wp_enqueue_script( 'bootstram.min.js', get_stylesheet_directory_uri() . '/assets/js/bootstrap/bootstrap.min.js');
  wp_enqueue_script( 'general', get_stylesheet_directory_uri() . '/assets/js/general.js');
 }