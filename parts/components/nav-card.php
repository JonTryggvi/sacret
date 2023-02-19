<?php 
  // pprint(get_defined_vars());
  // return;
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
  // $excerpt = !empty(get_the_excerpt()) ? wp_trim_words(get_the_excerpt(), 20, ' ...') :  wp_trim_words(get_the_excerpt(), 20, ' ...');
  $card_color_class = !empty(get_field('overlay_copy', $slug.'_'.$object_id)) ? get_field('overlay_copy', $slug.'_'.$object_id) : '';
  $term_children = get_term_children($object_id, 'category');
  $term_has_children = !empty($term_children);
  // var_dump($term_children);
  $nav_classes = implode(' ', $classes);
?>



<?php if($term_has_children && 1==2) :?>
<div class="cat-card div-type item-fadein load-hidden ">
<?php else : ?>
<a href="<?php echo $post_link; ?>" class="nav-card item-fadein load-hidden <?php echo 'nav_'.$slug; ?> <?php echo $nav_classes; ?>">
<?php endif; ?>
  <div class="">
    <article>
      <header>
        <?php if(1 == 2 ) : ?>
        <figure>
          <img src="<?php echo $featured_img; ?>" alt="">
          <figcaption class="<?php echo $card_color_class; ?>"></figcaption>
        </figure>
        <?php endif; ?>
      </header>
      <main>
        <h2><?php echo $title; ?></h2>
        <?php 
          if(!empty($term_children) && 2==1) {
            ?>
            <div class="link_container">

              <a href="<?php echo $post_link; ?>"><?php echo $title; ?></a>
            <?php
            foreach ($term_children as $key => $child_id) :
              $child_term_obj = get_term($child_id);
              $child_link =get_category_link($child_id);
          ?>
              <a href="<?php echo $child_link; ?>"><?php  echo $child_term_obj->name ?></a> 
          
          <?php
            endforeach;
            ?>
            </div>
            <?php
          }
        ?>
        <!-- <p><?php # echo $excerpt; ?></p> -->
      </main>
    </article>   
  </div>
<?php if($term_has_children && 1==2) :?>
  </div>
<?php else : ?>
  </a>
<?php endif; ?>


