<?php 
  $section_title = get_sub_field('product_title', $post->ID) ? get_sub_field('product_title', $post->ID) : false; 
  $section_has_title = $section_title !== false ? 'uni_section__has_title ' : ' ';
  $section_type = get_sub_field('type', $post->ID);
  $is_archive = 'archive' === $section_type ? true : false;
  $archive_class = $section_type;
 
?>

<section class="uni_section uni_section__products <?php echo $section_has_title; echo $archive_class; ?> grid-with-margin" data-type="<?php echo $section_type; ?>" data-post-type="product">
<?php if(false !== $section_title): ?>
  <h2><?php echo $section_title; ?></h2>
<?php endif; ?>
  <div class="card-container">
  
    
   
  </div>
  <?php if($is_archive): 
    uni_partial('parts/components/loadmore-button');
  else:
    uni_partial('parts/components/read-more', ['slug' => 'offerings']);
  endif; ?>
</section>