<?php
  $is_published = get_sub_field('publish_section');
  if(!$is_published) return;
  $section_title = get_sub_field('blog_title', $post->ID) ? get_sub_field('blog_title', $post->ID) : false;
  $section_has_title = $section_title !== false ? 'uni_section__has_title ' : ' ';
  $section_type = get_sub_field('type', $post->ID);
  $is_archive = 'archive' === $section_type;
  $archive_class = $section_type;
  $per_page = get_sub_field('per_page') ? get_sub_field('per_page') : 4;
  $uni_post_type = get_sub_field('post_type') ? get_sub_field('post_type') : 'post';
  $container_id = 'card_container_'.$i;
  $section_id = 'section_'.$i;
  $select_posts = get_sub_field('select_posts'); // bool
  $selected_posts = $select_posts ? get_sub_field('selected_posts') : []; // array

  $select_post_category = get_sub_field('select_post_category'); // array
  $select_post_category_not = get_sub_field('select_post_category_not'); // array
  $select_card_type = get_sub_field('select_card_type') ? get_sub_field('select_card_type') : 'u-shape';

  if(empty($selected_posts)) {
    $args = array(
      'post_type' => $uni_post_type,
      'posts_per_page' => $per_page,
      'post_status' => 'publish',
      'orderby' => 'date',
      'order' => 'DESC',
    );
    if(!empty($select_post_category)) {
      $args['category__in'] = $select_post_category;
    }
    if(!empty($select_post_category_not)) {
      $args['category__not_in'] = $select_post_category_not;
    }
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
      $selected_posts = $the_query->posts;
    }
  }

?>
  <?php if('u-shape' == $select_card_type) : ?>
    <section id="<?php echo $section_id; ?>" class="uni_section uni_section__posts <?php echo $section_has_title; echo $section_type; ?> grid-with-margin" data-post-type="post" data-section_order="<?php echo $i ?>" data-per_page="<?php echo $per_page ?>" data-post_type="<?php echo $uni_post_type; ?>" data-preselected="<?php echo $select_posts ?>" data-post_id="<?php echo $post->ID; ?>" data-post-cat_in="<?php echo !empty($select_post_category) ? esc_attr(implode(',', $select_post_category)) : '' ?>" data-post-cat_not_in="<?php echo !empty($select_post_category_not) ? esc_attr(implode(',', $select_post_category_not)) : '' ?>" >

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
  <?php elseif('o-shape' == $select_card_type) : ?>
    <section id="<?php echo $section_id; ?>" class="uni_section <?php echo $section_has_title; echo $section_type; ?> grid-with-margin uni_section__o"  data-section_order="<?php echo $i ?>" data-per_page="<?php echo $per_page ?>" >

      <?php if(false !== $section_title): ?>
        <h2><?php echo $section_title; ?></h2>
      <?php endif; ?>

      <div id="<?php echo $container_id; ?>" class="card-container">
      <?php


        if( $selected_posts ): ?>
          <?php foreach( $selected_posts as $sel_post): ?>
            <?php uni_partial('parts/components/post-card', ['post' => $sel_post, 'load' => 'onload', 'select_card_type' => $select_card_type], true); ?>
          <?php endforeach; ?>
        <?php else: ?>
          <p><?php _e('No posts found'); ?></p>
        <?php endif; ?>
      </div>
      <?php if($is_archive):
        uni_partial('parts/components/loadmore-button');
      else:
        $section_page_slug = get_sub_field('page_slug', $post->ID);
        uni_partial('parts/components/read-more', ['slug' => $section_page_slug]);
      endif; ?>

    </section>

  <?php endif; // end shape selecltor ?>
