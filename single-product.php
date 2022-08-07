<?php get_header();
  $post_id = get_the_id();
  $product = wc_get_product($post_id);
  $product_id = $product->get_id();
  $title = $product->get_name();
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
  // $description = $product->get_description();
  $the_price = $product->get_price();

?>

<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">


  <?php if (have_posts()) : while (have_posts()) : the_post(); 

    include_once('parts/elements.php');

  endwhile;  endif; ?>



</main>


<?php get_footer(); ?>