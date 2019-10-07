<?php

namespace Library;

class Post{
 
 /*
 *
 * $builtin, If true, will return WordPress default post types. Use false to return only custom post types.
 *
 */
 public function getAllPostTypes($builtin = false){

 	$postTypes = array();
    $args = array(
       'public'   => true,
       '_builtin' => $builtin,
    );

    $output = 'names';
    $operator = 'and';

    $post_types = get_post_types( $args, $output, $operator ); 
    return $post_types;
 }
 public function listPosts(){

 	$postTypesCustom = $this->getAllPostTypes();
 	$allPosts = array();
 	foreach ($postTypesCustom as $key => $value) {
 	 $wpb_all_query = new \WP_Query(array('post_type'=>$value, 'post_status'=>'publish', 'posts_per_page'=>-1));
	 if ( $wpb_all_query->have_posts() ) : 
	  while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); 

 	   $postTemp = [];
	   $postTemp['link'] = get_the_permalink();
	   $postTemp['title'] = get_the_title();
	   array_push($allPosts, $postTemp);
	   wp_reset_postdata();
	  endwhile;
	 endif;
 	}

  return $allPosts;
 }
}