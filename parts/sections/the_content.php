<?php if('product' ==get_post_type()) :
 $post_id = get_the_id();
  $product = wc_get_product($post_id);
  $product_id = $product->get_id();
  $title = $product->get_name();
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
  // $description = $product->get_description();
  $the_price = $product->get_price(); ?>
  <section class="uni_section uni_section__single-product grid-with-margin grid-row-content__single-prod grid-row-content"  data-section_order="<?php echo $i ?>">
    <!-- <figure>
      <img src="<?php echo $image[0]; ?>" alt="">
    </figure>
    <h2 class="uni_section__single-product__h2"><?php echo $title; ?></h2>  -->
    <div class="uni_section__single-product__description">
      <?php # echo $description; ?>
      <?php the_content(); ?>
      <div class="addToCart__container">
        <button type="button" class="btn btn--lilac addToCart" data-product-id="<?php echo $product_id; ?>"><?php _e('Bæta í körfu'); ?></button>
        <span class="uni_section__single-product__price"><?php echo wc_price( $the_price); ?></span>
      </div>
    </div>
  </section>
<?php else : 
  $grid_class = $hero_title ? '' : ' grid-row-content'
  ?>
  <section class="uni_section uni_section__content grid-with-margin <?php echo $grid_class; ?>" data-section_order="<?php echo $i ?>">
    <?php if(!$hero_title): ?>
    <h1><?php the_title(); ?></h1>
    <?php endif; ?>
    <div class="uni_section__content__wrap">
      <?php   
        $blocks = parse_blocks( $post->post_content );  
        foreach ($blocks as $key => $block) {
          echo $block['blockName'] == 'core/shortcode' ? do_shortcode($block['innerHTML']) : render_block( $block );
        } 
      ?>
      </div>
  </section>

<?php endif; ?>