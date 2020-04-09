<?php 
  if(!function_exists('uni_partial')){
    function uni_partial($path, $args = [], $echo = true) {
      if (!empty($args)) {
        extract($args);
      }
      if ($echo) {
        include(locate_template($path . '.php'));
        return;
      }
      ob_start();
      include(locate_template($path . '.php'));
      return ob_get_clean();
    }
  }

function add_slug_body_class( $classes ) {
  global $post;
  if ( isset( $post ) ) {
  $classes[] = $post->post_type . '-' . $post->post_name;
  }
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );
function get_link_by_slug($slug, $lang_slug = null, $type = 'post'){
  $post = get_page_by_path($slug, OBJECT, $type);
  $id = ($lang_slug) ? pll_get_post($post->ID, $lang_slug) : $post->ID;
  return get_permalink($id);
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Uni General Settings',
		'menu_title'	=> 'Uni Settings',
		'menu_slug' 	=> 'uni-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Uni Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'uni-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Uni Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'uni-general-settings',
	));
	
}