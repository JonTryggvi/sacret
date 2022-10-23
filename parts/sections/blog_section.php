<?php 

  $section_title = get_sub_field('blog_title', $post->ID) ? get_sub_field('blog_title', $post->ID) : false; 
  $section_has_title = $section_title !== false ? 'uni_section__has_title ' : ' ';
  $section_type = get_sub_field('type', $post->ID);
  $is_archive = 'archive' === $section_type;
  $archive_class = $section_type;
  $per_page = get_sub_field('per_page') ? get_sub_field('per_page') : 4;
  $is_published = get_sub_field('publish_section');
  if($is_published) :
?>
<section class="uni_section uni_section__posts <?php echo $section_has_title; echo $section_type; ?> grid-with-margin" data-post-type="post" data-section_order="<?php echo $i ?>" data-per_page="<?php echo $per_page ?>" >
  <?php if(false !== $section_title): ?>
    <h2><?php echo $section_title; ?></h2>  
  <?php endif; ?>
  <div class="card-container">

    
  
  </div> 
  <?php if($is_archive): 
    uni_partial('parts/components/loadmore-button');
  else:
    $section_page_slug = get_sub_field('page_slug', $post->ID);
    uni_partial('parts/components/read-more', ['slug' => $section_page_slug]);
  endif; ?>
</section>

<?php endif; ?>