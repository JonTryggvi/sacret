<?php
  $section_title = get_sub_field('product_title', $post->ID) ? get_sub_field('product_title', $post->ID) : false;
  $section_has_title = $section_title !== false ? 'uni_section__has_title ' : ' ';
  $section_type = get_sub_field('type', $post->ID);
  $is_archive = 'archive' === $section_type;
  $archive_class = $section_type;
  $product_count = product_count_shortcode();
  $is_published = get_sub_field('publish_section');
  $per_page = get_sub_field('per_page') ? get_sub_field('per_page') : 4;
  $container_id = 'card_container_'.$i;
  $section_id = 'section_'.$i;
  $select_posts = get_sub_field('select_posts');
  if(!empty($product_count) && $is_published) :
?>
  <section id="<?php echo $section_id; ?>" class="uni_section uni_section__products <?php echo $section_has_title; echo $archive_class; ?> grid-with-margin" data-type="<?php echo $section_type; ?>" data-preselected="<?php echo $select_posts ?>" data-post-type="product" data-section_order="<?php echo $i ?>" data-per_page="<?php echo $per_page ?>"data-post_id="<?php echo $post->ID; ?>" >
    <?php if(false !== $section_title): ?>
      <h2 class="text"><?php echo $section_title; ?></h2>
    <?php endif; ?>
    <?php if(!$is_archive) : ?>
      <span class="scrollBtn scrollBack visibility__hidden"><?php uni_partial('library/images/ico-0003.svg') ?></i></span>
    <?php endif; ?>
    <div id="<?php echo $container_id; ?>" class="card-container product-cards">

    </div>
    <?php if(!$is_archive) : ?>
      <span class="scrollBtn scrollForward"><?php uni_partial('library/images/ico-0003.svg') ?></span>
     <?php endif; ?>
    <?php if($is_archive) :
      uni_partial('parts/components/loadmore-button');
    else :
      $section_page_slug = get_sub_field('page_slug', $post->ID);
      uni_partial('parts/components/read-more', ['slug' => $section_page_slug]);
    endif; ?>

  </section>
<?php endif; ?>