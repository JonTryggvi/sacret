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