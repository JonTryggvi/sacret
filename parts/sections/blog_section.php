<?php
  $section_title = get_sub_field('blog_title', $post->ID) ? get_sub_field('blog_title', $post->ID) : false;
  $section_has_title = $section_title !== false ? 'uni_section__has_title ' : ' ';
  $section_type = get_sub_field('type', $post->ID);
  $is_archive = 'archive' === $section_type;
  $archive_class = $section_type;
  $per_page = get_sub_field('per_page') ? get_sub_field('per_page') : 4;
  $is_published = get_sub_field('publish_section');
  $uni_post_type = get_sub_field('post_type') ? get_sub_field('post_type') : 'post';
  $container_id = 'card_container_'.$i;
  $section_id = 'section_'.$i;
  $select_posts = get_sub_field('select_posts');

  if($is_published) :
?>
<section id="<?php echo $section_id; ?>" class="uni_section uni_section__posts <?php echo $section_has_title; echo $section_type; ?> grid-with-margin" data-post-type="post" data-section_order="<?php echo $i ?>" data-per_page="<?php echo $per_page ?>" data-post_type="<?php echo $uni_post_type; ?>" data-preselected="<?php echo $select_posts ?>" data-post_id="<?php echo $post->ID; ?>" >

<?php if(false !== $section_title): ?>
  <h2><?php echo $section_title; ?></h2>
  <?php endif; ?>
  <?php if(!$is_archive) : ?>
     <span class="scrollBtn scrollBack visibility__hidden"><?php uni_partial('library/images/ico-0003.svg') ?></i></span>
  <?php endif; ?>
  <div id="<?php echo $container_id; ?>" class="card-container common-cards">
  </div>
  <?php if($is_archive):
    uni_partial('parts/components/loadmore-button');
  else:
    $section_page_slug = get_sub_field('page_slug', $post->ID);
    uni_partial('parts/components/read-more', ['slug' => $section_page_slug]);
  endif; ?>
  <?php if(!$is_archive) : ?>
      <span class="scrollBtn scrollForward"><?php uni_partial('library/images/ico-0003.svg') ?></span>
  <?php endif; ?>

</section>

<?php endif; ?>