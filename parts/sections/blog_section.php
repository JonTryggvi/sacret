<?php 
  $posts = get_posts([
    'numberposts' => 5,
    'orderby'  => 'date',
    'order'  => 'ACS',
  ]);
  $section_title = get_sub_field('blog_title', $post->ID) ? get_sub_field('blog_title', $post->ID) : false; 
  $section_has_title = $section_title !== false ? 'uni_section__has_title' : '';
?>
<section class="uni_section uni_section__posts <?php echo $section_has_title; ?> grid-with-margin">
  <?php if(false !== $section_title): ?>
    <h2><?php echo $section_title; ?></h2>  
  <?php endif; ?>
  <div class="uni_section__posts__container">

    <?php foreach ($posts as $key => $post) : 
      
      
      $card_size = $key <= 1 ? 'post-card--large' : 'post-card--small'; 
     
      uni_partial('parts/components/post-card', ['post' => $post, 'card_size' => $card_size]);
    endforeach; ?> 
  
  </div>

</section>