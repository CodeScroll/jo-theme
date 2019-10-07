<?php

namespace Library;

class Post{
 
 /*
 *
 * $builtinm, If true, will return WordPress default post types. Use false to return only custom post types.
 *
 */
 public function getAllPostTypes($builtin = false){

    $args = array(
       'public'   => true,
       '_builtin' => $builtin,
    );

    $output = 'names';
    $operator = 'and';

    $post_types = get_post_types( $args, $output, $operator ); 

    foreach ( $post_types  as $post_type ) {

       echo '<p>' . $post_type . '</p>';
    }
 }
 public function listPosts(){

	$wpb_all_query = new \WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1));
	 
	if ( $wpb_all_query->have_posts() ) :
	 
	echo '<ul>';
	    while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post();
	        echo '<li><a href='. the_permalink() .  the_title() . '</a></li>';
	    endwhile;
	echo '</ul>';
	 
	wp_reset_postdata();
	 
	else :
	    echo '<p>' . _e( 'Sorry, no posts matched your criteria.' ) . '</p>';
	endif;
 }
}