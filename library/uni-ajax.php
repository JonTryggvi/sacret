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
    'posts_per_page' => 4,
    'paged' => $page,
    'orderby' => 'date',
    'order' => 'DESC',
    'fields' => 'ids',
    'post_type' => 'product',
    'post_status' => 'publish'
  ) );
  $products = $query->posts; 
  $sProducts = '';
  if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
    $sProducts .= uni_partial('parts/components/product-card', [], false);
  endwhile; endif;
  wp_reset_query();
  
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
  $args = array(
    'posts_per_page' => 4,
    'paged' => $page,
    'orderby' => 'modified',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => "publish"
  );
  // $page === 1 ? false : $args['offset'] = 5;
  $query = new WP_Query( $args );
  $posts = $query->posts; 
  $s_posts = '';
  if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
    $s_posts .= uni_partial('parts/components/post-card', [], false);
  endwhile; endif;
  wp_reset_query();
  wp_send_json(['posted' => $_POST, 'posts' => $s_posts, 'queryObject' => $query, 'p' => $posts]);
  wp_die();
}

add_action('wp_ajax_nopriv_call_mailchimp', 'call_mailchimp');
add_action('wp_ajax_call_mailchimp', 'call_mailchimp');
function call_mailchimp() {
  check_ajax_referer( 'morning_rain', 'security' );
  if(!isset($_POST['action']) && empty($_POST['action'])) {
    exit('not happening');
  }
  $email = sanitize_email($_POST['email']);
  $fname = '' !== sanitize_text_field($_POST['fname']) ? sanitize_text_field($_POST['fname']) : 'Subscribed from uni.is';
  $lname = '' !== sanitize_text_field($_POST['lname']) ? sanitize_text_field($_POST['lname']) : '';
  $email_md5 = md5($email);
  $audience_id = get_field('list_id', 'option');
  $api_key = get_field('api', 'option');
  $dc = substr($api_key,strpos($api_key,'-')+1); // datacenter, it is the part of your api key - us5, us8 etc
  $args = array(
    'headers' => array(
      'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
    )
  );
  
  $member_add_url = "https://$dc.api.mailchimp.com/3.0/lists/$audience_id/members/$email_md5";
  $member_body = ['email_address' => $email, 'status' => 'subscribed', "merge_fields" => ['FNAME' => $fname, 'LNAME' => $lname]];

  $args['body'] = json_encode($member_body);
  $args['method'] = 'PUT';
  $member_add_res = wp_remote_post($member_add_url, $args);

  wp_send_json(['posted' => $_POST, 'member_added' => $member_add_res]);
  wp_die();
}

