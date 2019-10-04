<?php

add_action('widgets_init','widgetInit');

function widgetInit(){
	register_sidebar(array(
		'name'=>'Homepage',
		'id'=>'widget_hompage'
	));
}