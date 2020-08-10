<?php 
  $featured_img = get_the_post_thumbnail_url($post, 'medium_large');
  $post_link = get_the_permalink($post);
  $title = get_the_title($post);
  $excerpt = wp_trim_words($post->post_excerpt, 20, ' ...');
?>
<a href="<?php echo $post_link; ?>" class="post-card <?php echo $card_size; ?> item-fadein load-hidden">
  <article>
    <header>
      <figure>
        <img src="<?php echo $featured_img; ?>" alt="">
        </figure>

      </header>
      <main>
        <h2><?php echo $title; ?></h2>
        <?php echo $excerpt; ?>
      </main>
    </article>
  </a>