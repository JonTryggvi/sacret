<?php 
  $missing_img_array = get_field('missing_image', 'option');
  $missing_img = $missing_img_array['sizes']['medium_large'];
  $featured_img =  !empty(get_field('tax_img', $taxonomy.'_'.$term_id)) ? get_field('tax_img', $taxonomy.'_'.$term_id)['sizes']['medium_large'] : $missing_img;
 
  $post_link = get_category_link($term_id);
  $title = $name;
  // $excerpt = !empty(get_the_excerpt()) ? wp_trim_words(get_the_excerpt(), 20, ' ...') :  wp_trim_words(get_the_excerpt(), 20, ' ...');
  $card_color_class = !empty(get_field('overlay_copy', $taxonomy.'_'.$term_id)) ? get_field('overlay_copy', $taxonomy.'_'.$term_id) : '';
?>
<a href="<?php echo $post_link; ?>" class="uni_card item-fadein load-hidden">
  <div class="card_container">
    <article>
      <header>
        <figure>
          <img src="<?php echo $featured_img; ?>" alt="">
          <figcaption class="<?php echo $card_color_class; ?>"><?php echo $title; ?></figcaption>
        </figure>
      </header>
      <main>
        <h2><?php echo $title; ?></h2>
        <!-- <p><?php # echo $excerpt; ?></p> -->
      </main>
    </article>   
  </div>
</a>

