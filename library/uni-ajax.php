<?php
add_action('wp_ajax_nopriv_get_products', 'get_products');
add_action('wp_ajax_get_products', 'get_products');
function get_products() {
  check_ajax_referer( 'morning_rain', 'security' );
  if(!isset($_POST['action']) && empty($_POST['action'])) {
    exit('not happening');
  }
  $page = absint($_POST['page']);
  $per_page = absint($_POST['per_page']);
  $post_id = !empty($_POST['post_id']) ? absint($_POST['post_id']) : false;
  $preselected = 1 === absint($_POST['preselected']);
  $query = null;
  $products = [];
  if(!$preselected) {
    $query = new WP_Query( array(
      'posts_per_page' => $per_page,
      'paged' => $page,
      'fields' => 'ids',
      'post_type' => 'product',
      'post_status' => 'publish'
    ) );
    $products = $query->posts;
  } else {
    $acf_fields = $post_id ? get_fields($post_id) : null;
    if (is_array($acf_fields) && !empty($acf_fields['sections']) && is_array($acf_fields['sections'])) {
      foreach ($acf_fields['sections'] as $section) {
        if ('product_section' === $section['acf_fc_layout'] && !empty($section['selected_products'])) {
          $products = $section['selected_products'];
          break;
        }
      }
    }
  }


  $sProducts = '';
  if (!$preselected && $query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
     $sProducts .= uni_partial('parts/components/product-card', [], false);
    endwhile;
  else :
    if (!empty($products)) {
      foreach ($products as $key => $product) {
        $sProducts .= uni_partial('parts/components/product-card', ['product' => $product], false);
      }
    }
  endif;
  wp_reset_query();
  wp_send_json(['posted' => $_POST, 'products' => $sProducts, 'queryObject' => $query, 'per_page' => $per_page]);
  wp_die();
}

add_action('wp_ajax_nopriv_get_uni_posts', 'get_uni_posts');
add_action('wp_ajax_get_uni_posts', 'get_uni_posts');
function get_uni_posts() {
  check_ajax_referer( 'morning_rain', 'security' );
  if(!isset($_POST['action']) && empty($_POST['action'])) {
    exit('not happening');
  }
  $query = false;
  $posts = false;
  $page = absint($_POST['page']);
  $post_type = wp_strip_all_tags($_POST['post_type']);
  $field_posts = isset($_POST['field']) ? $_POST['field'] : false;
  $per_page = absint($_POST['per_page']);
  $preselected = 1 === absint($_POST['preselected']);
  $post_id = absint($_POST['post_id']) ?? false;
  $term_id = absint($_POST['term_id']) ?? false;
  $args = array(
    'posts_per_page' => $per_page,
    'paged' => $page,
    'post_type' => $post_type,
    'post_status' => "publish"
  );
  if(!!$term_id) {
    $args['cat'] = $term_id;
  }
  if(!$preselected) {
    $query = new WP_Query( $args );
    $posts = $query->posts;
  } else {
    $posts = [];
    $field_post_values = [];

    if (is_string($field_posts)) {
      $field_post_values = array_map('trim', explode(',', $field_posts));
    } elseif (is_array($field_posts)) {
      $field_post_values = array_values($field_posts);
    }

    if ($field_post_values && isset($field_post_values[0]) && 'false' === $field_post_values[0]) {
      $requested_ids = array_filter(array_map('absint', array_slice($field_post_values, 1)));

      if ($requested_ids) {
        $posts = get_posts([
          'numberposts' => count($requested_ids),
          'post__in' => $requested_ids,
          'orderby' => 'post__in',
          'post_type' => $post_type,
          'post_status' => 'publish',
        ]);
      }
    }

    if (!$posts) {
      $acf_fields = get_fields($post_id);
      if (!empty($acf_fields['sections'])) {
        foreach ($acf_fields['sections'] as $section) {
          if('blog_section' === $section['acf_fc_layout']) {
            $posts = $section['selected_posts'];
            break;
          }
        }
      }
    }
  }
  $s_posts = '';
  // wp_send_json(['posted' => $_POST, 'preselected' => $preselected, 'posts' => $posts]);
  // wp_die();
  if (!$preselected && $query->have_posts() ) :
    while ($query->have_posts()) : $query->the_post();
      $s_posts .= uni_partial('parts/components/post-card', [], false);
    endwhile;
  else :
    foreach ($posts as $key => $post) {
      $s_posts .= uni_partial('parts/components/post-card', ['post' => $post], false);
    }
  endif;
  wp_reset_query();
  wp_send_json(['posted' => $_POST, 'posts' => $s_posts, 'queryObject' => $query, 'p' => $posts, 'per_page' => $per_page, 'field' => $field_posts]);
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
