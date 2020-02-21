<?php 
add_action('wp_ajax_nopriv_get_products', 'get_products');
add_action('wp_ajax_get_products', 'get_products');
function get_products() {
  check_ajax_referer( 'morning_rain', 'security' );
  if(!isset($_POST['action']) && empty($_POST['action'])) {
    exit('not happening');
  }
  $page = absint($_POST['page']);
  $query = new WP_Query( array(
    'posts_per_page' => 3,
    'paged' => $page,
    'orderby' => 'date',
    'order' => 'DESC',
    'fields' => 'ids',
    'post_type' => 'product'
  ) );
  $products = $query->posts; 
  $sProducts = '';
  foreach ($products as $key => $product_id) {
    $product = wc_get_product($product_id);
    $sProducts .= uni_partial('parts/components/product-card', [
      'product' => $product,
      'product_id' => $product_id
    ], false);
  }
  
  wp_send_json(['posted' => $_POST, 'products' => $sProducts, 'queryObject' => $query]);
  wp_die();
}

add_action('wp_ajax_nopriv_get_uni_posts', 'get_uni_posts');
add_action('wp_ajax_get_uni_posts', 'get_uni_posts');
function get_uni_posts() {
  check_ajax_referer( 'morning_rain', 'security' );
  if(!isset($_POST['action']) && empty($_POST['action'])) {
    exit('not happening');
  }
  $page = absint($_POST['page']);
  $per_page = $page === 1 ? 5 : 5;
  $args = array(
    'posts_per_page' => $per_page,
    'paged' => $page,
    'orderby' => 'modified',
    'order' => 'ASC',
    'post_type' => 'post'
  );
  // $page === 1 ? false : $args['offset'] = 5;
  $query = new WP_Query( $args );
  $posts = $query->posts; 
  $s_posts = '';
  foreach ($posts as $key => $post) {
    $card_size = $key <= 1 && $page === 1 ? 'post-card--large' : 'post-card--small'; 
    $featured_img = get_the_post_thumbnail_url($post, 'medium_large');
    $post_link = get_the_permalink($post);
    $s_posts .= uni_partial('parts/components/post-card', [
      'card_size' => $card_size,
      'featured_img' => $featured_img,
      'post_link' => $post_link,
      'excerpt' => $post->post_excerpt,
      'title' => $post->post_title
    ], false);

  } 
  
  wp_send_json(['posted' => $_POST, 'posts' => $s_posts, 'queryObject' => $query]);
  wp_die();
}

