<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' <a href="' . get_permalink() . '">&hellip;' . __('Read More', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


function content_wrapper( $content ){
  return '<div class="post-content">'.$content.'</div>';
}

add_action('the_content', __NAMESPACE__ . '\\content_wrapper');

function archive_title($title){
  if(is_post_type_archive()){
    return post_type_archive_title();  
  }
  if(is_category()){
    return single_cat_title();
  }
  return $title;
}
add_filter('get_the_archive_title', __NAMESPACE__ . '\\archive_title');


function sendinblue_opt_in( $posted_data ) { 
  if($posted_data['email-opt-in'][0] && $posted_data['list_id']){
    $mailin = new \Mailin('https://api.sendinblue.com/v2.0',SEND_IN_BLUE_KEY); 

    $data = array(
      "email" => $posted_data['your-email'],
      'listid' => array($posted_data['list_id'])
      );

    if($posted_data['your-name']){
        $data['attributes'] = array('NAME' => $posted_data['your-name']);
    }
    $mailin->create_update_user($data);        
  }
  return $posted_data; 
}; 
         
// add the filter 
add_filter( 'wpcf7_posted_data', __NAMESPACE__ . '\\sendinblue_opt_in', 10, 1 );