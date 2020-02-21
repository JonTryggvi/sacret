<?php 
  
?>
<a href="<?php echo $post_link; ?>" class="post-card <?php echo $card_size; ?>">
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