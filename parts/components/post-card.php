<?php
  $post_id = get_the_ID() ? get_the_ID() : $post->ID;
  $missing_img_array = get_field('missing_image', 'option');
  $missing_img = $missing_img_array['sizes']['medium_large'];
  $featured_img = get_the_post_thumbnail_url($post_id, 'medium_large') ? get_the_post_thumbnail_url($post_id, 'medium_large') : $missing_img;
  $post_link = get_the_permalink($post_id);
  $title = get_the_title($post_id);
  $excerpt = !empty(get_the_excerpt($post_id)) ? wp_trim_words(get_the_excerpt($post_id), 20, ' ...') :  wp_trim_words(get_the_excerpt($post_id), 20, ' ...');
  $card_color_class = get_field('overlay') ? get_field('overlay') : '';
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
        <p><?php echo $excerpt; ?></p>
      </main>
    </article>
  </div>
</a>
