<?php 

  $section_title = get_sub_field('blog_title', $post->ID) ? get_sub_field('blog_title', $post->ID) : false; 
  $section_has_title = $section_title !== false ? 'uni_section__has_title ' : ' ';
  $section_type = get_sub_field('type', $post->ID);
  $is_archive = 'archive' === $section_type ? true : false;
  $archive_class = $section_type;
?>
<section class="uni_section uni_section__posts <?php echo $section_has_title; echo $section_type; ?> grid-with-margin" data-post-type="post">
  <?php if(false !== $section_title): ?>
    <h2><?php echo $section_title; ?></h2>  
  <?php endif; ?>
  <div class="uni_section__posts__container">

    
  
  </div> 
  <?php if($is_archive): 
    uni_partial('parts/components/loadmore-button');
  else:
    uni_partial('parts/components/read-more', ['slug' => 'news']);
  endif; ?>
</section>