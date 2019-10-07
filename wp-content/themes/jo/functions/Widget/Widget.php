<?php

add_action('widgets_init', 'widgetInit');
add_action('widgets_init', 'custom_widgets');

function widgetInit(){
	register_sidebar(array(
		'name'=>'Homepage',
		'id'=>'widget_hompage'
	));
}

function custom_widgets(){

	register_widget('Library\Widget\CategoryWidget');
}