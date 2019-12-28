<section class="uni_section uni_section__content grid-with-margin grid-row-content">
  <h1><?php the_title(); ?></h1>
  <div class="uni_section__content__wrap">
    <?php 
      $blocks = parse_blocks( $post->post_content );  
     
      foreach ($blocks as $key => $block) {
        echo $block['blockName'] == 'core/shortcode' ? do_shortcode($block['innerHTML']) : $block['innerHTML'];
      } 
    ?>
    </div>
</section>