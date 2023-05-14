<?php
  $missing_img_array = get_field('missing_image', 'option');
  $missing_img = $missing_img_array['sizes']['medium_large'];
  $get_type_img = [
    'taxonomy' => !empty(get_field('tax_img', $object.'_'.$object_id)) ? get_field('tax_img', $object.'_'.$object_id)['sizes']['medium_large'] : $missing_img,
    'post_type' => get_the_post_thumbnail_url($object_id, 'medium_large') ? get_the_post_thumbnail_url($object_id, 'medium_large') : $missing_img
  ];

  $featured_img =  $get_type_img[$type];
  $post_link = $url;
  $title = $title;
  $slug = $slug = basename($url);
  $card_color_class = !empty(get_field('overlay_copy', $slug.'_'.$object_id)) ? get_field('overlay_copy', $slug.'_'.$object_id) : '';
  $term_children = get_term_children($object_id, 'category');
  $term_has_children = !empty($term_children);
  $nav_classes = implode(' ', $classes);
?>


<a href="<?php echo $post_link; ?>" class="nav-card uni_card item-fadein load-hidden <?php echo 'nav_'.$slug; ?> <?php echo $nav_classes; ?>">

  <div  class="card_container">
    <article>
      <?php if(1 == 2 ) : ?>
      <header>
        <figure>
          <img src="<?php echo $featured_img; ?>" alt="">
          <figcaption class="<?php echo $card_color_class; ?>"><?php echo $title ?></figcaption>
        </figure>
      </header>
      <?php endif; ?>
      <main>
        <h2><?php echo $title; ?></h2>

        <!-- <p><?php # echo $excerpt; ?></p> -->
      </main>
    </article>
  </div>
</a>



