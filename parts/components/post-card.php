<?php
  $post_id = isset($post) ? $post->ID : get_the_ID();
  $select_card_type = isset($select_card_type) ? $select_card_type : 'u-shape';
  $missing_img_array = get_field('missing_image', 'option');
  $missing_img = $missing_img_array['sizes']['medium_large'];
  $featured_img = get_the_post_thumbnail_url($post_id, 'medium_large') ? get_the_post_thumbnail_url($post_id, 'medium_large') : $missing_img;
  $post_link = get_the_permalink($post_id);
  $title = get_the_title($post_id);
  $excerpt = !empty(get_the_excerpt($post_id)) ? wp_trim_words(get_the_excerpt($post_id), 20, ' ...') :  wp_trim_words(get_the_excerpt($post_id), 20, ' ...');
  $card_color_class = get_field('overlay') ? get_field('overlay') : '';
  $set_load_classes = !isset($load) && 'onloaad' != $load ? 'item-fadein load-hidden' : ''; // onload or scroll
  $html_selector = [
    'u-shape' => function() use ($post_link, $featured_img, $title, $excerpt, $set_load_classes, $card_color_class) {
      ?>
        <a href="<?php echo $post_link; ?>" class="uni_card <?php echo $set_load_classes; ?>">
          <div class="card_container">
            <article>
              <header>
                <figure>
                  <img src="<?php echo $featured_img; ?>" alt="">
                  <figcaption class="<?php echo $card_color_class; ?>"><?php echo $title; ?></figcaption>
                </figure>
              </header>
              <main>
                <h2 class="visibility__none"><?php echo $title; ?></h2>
                <p><?php echo $excerpt; ?></p>
              </main>
            </article>
          </div>
        </a>

      <?php
    },
    'o-shape' => function() use ($post_link, $featured_img, $title, $excerpt, $set_load_classes, $card_color_class) {
      ?>
        <a href="<?php echo $post_link; ?>" class="uni_card__o-shape">
          <div class="card_container">
            <article>
              <header>
                <figure>
                  <img src="<?php echo $featured_img; ?>" alt="">
                </figure>
              </header>
              <main>
                <h2 class=""><?php echo $title; ?></h2>

              </main>
            </article>
          </div>
        </a>
      <?php
    }
  ];
  echo $html_selector[$select_card_type]();
?>
