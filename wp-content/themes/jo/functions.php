<?php

spl_autoload_register(
    function ($class) {
        $prefix   = 'Library';
        $base_dir = __DIR__ . '/library/';

        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            return;
        }

        $relative = substr($class, $len);
        $file     = $base_dir . str_replace('\\', '/', $relative) . '.php';

        if (file_exists($file)) {
            require $file;
        }
    }
);

// requires
foreach (glob("Library/*.php") as $filename)
{
    include $filename;
}

// require_once('Library/ThemeSettings.php');
// require_once('Library/Menu.php');
// require_once('Library/Post.php');
// require_once('Library/Page.php');
// Organize function to subfolders
addSubfolderFunctions();

add_theme_support('menus');

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

// Assets

if ( !is_admin() ){
 add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' ); 
}

function my_theme_enqueue_styles() {
  
  wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap/bootstrap.min.css');
  wp_enqueue_style('general-css', get_template_directory_uri().'/assets/css/theme.css');
  wp_deregister_script('jquery');
  wp_enqueue_script( 'jquery-3.4.1', get_stylesheet_directory_uri() . '/assets/js/jquery-3.4.1.min.js');
  wp_enqueue_script( 'popper.min.js', get_stylesheet_directory_uri() . '/assets/js/popper.min.js');
  wp_enqueue_script( 'bootstram.min.js', get_stylesheet_directory_uri() . '/assets/js/bootstrap/bootstrap.min.js');
  wp_enqueue_script( 'general', get_stylesheet_directory_uri() . '/assets/js/general.js');
 }


 function some_function()
{
   $post_details = array(
  'post_title'    => 'Page title',
  'post_content'  => 'Content of your page',
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_type' => 'page'
   );
   wp_insert_post( $post_details );
}

register_activation_hook(__FILE__, 'some_function');