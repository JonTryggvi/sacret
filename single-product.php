<?php get_header();
  $post_id = get_the_id();
  $product = wc_get_product($post_id);
  $product_id = $product->get_id();
  $title = $product->get_name();
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
  $description = $product->description;
  $the_price = $product->get_price();

?>

<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">


  <?php if (have_posts()) : while (have_posts()) : the_post(); 

    include_once('parts/elements.php');

  endwhile;  endif; ?>
  <section class="uni_section uni_section__single-product grid-with-margin grid-row-content__single-prod">
    <!-- <figure>
      <img src="<?php echo $image[0]; ?>" alt="">
    </figure>
    <h2 class="uni_section__single-product__h2"><?php echo $title; ?></h2>  -->
    <span class="uni_section__single-product__price"><?php echo wc_price( $the_price); ?></span>
    <div class="uni_section__single-product__description">
      <?php # echo $description; ?>
      <?php the_content(); ?>
      <div class="addToCart__container">
        <button type="button" class="btn btn--lilac addToCart" data-product-id="<?php echo $product_id; ?>"><?php _e('Bæta í körfu'); ?></button>
      </div>
    </div>
  </section>
</main>


<?php get_footer(); ?>