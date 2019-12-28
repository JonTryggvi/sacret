<?php 
  $featured_img = get_the_post_thumbnail_url($post->ID, 'medium_large');
  $post_link = get_the_permalink($post);
?>
<a href="<?php echo $post_link; ?>" class="post-card <?php echo $card_size; ?>">
  <article>
    <header>
      <figure>
        <img src="<?php echo $featured_img; ?>" alt="">
      </figure>

    </header>
    <main>
      <h2><?php echo $post->post_title; ?></h2>
      <?php echo $post->post_excerpt; ?>
    </main>
  </article>
</a>