<?php 
  if(!function_exists('uni_partial')){
    function uni_partial($path, $args = [], $echo = true) {
      $path_explode = explode('.', $path);
	    $extension = empty($path_explode[1]) ? '.php' : ''; // safe way to update function without messing upp older paths
      if (!empty($args)) {
        extract($args);
      }
      if ($echo) {
        include(locate_template($path . $extension));
        return;
      }
      ob_start();
      include(locate_template($path . $extension));
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

add_filter('woocommerce_add_to_cart_redirect', 'uni_add_to_cart_redirect');
function uni_add_to_cart_redirect() {
  global $woocommerce;
  $checkout_url = wc_get_checkout_url();
  return $checkout_url;
}

// add_filter( 'wp_nav_menu_items', 'lunchbox_add_loginout_link', 10, 2 );
function lunchbox_add_loginout_link( $items, $args ) {
  $cart_is_empty = WC()->cart->is_empty();
  if ($args->theme_location == 'main-nav' && !$cart_is_empty) {
      $svg = uni_partial('library/images/shopping-basket.svg',[],false);
      $cart_url = wc_get_cart_url();
      return $items . "<li class='menu-item menu-item-type-post_type menu-item-object-page'><a href='$cart_url'>$svg</a></li>";
  }
  return $items;
}

function product_count_shortcode () {
  $count_posts = wp_count_posts('product');
  return $count_posts-> publish;
}


add_filter( 'woocommerce_return_to_shop_redirect', 'custom_empty_cart_redirect_url' );
function custom_empty_cart_redirect_url(){
  return home_url();
}

//custom archive header
add_filter( 'get_the_archive_title', 'errorsea_archive_title' );
function errorsea_archive_title( $title ) {
	if ( is_category() ) {
		// Remove prefix in category archive page
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		// Remove prefix in tag archive page
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		// Remove prefix in author archive page
		$title = get_the_author();
	}
	return $title;
}