<?php 
  $missing_img_array = get_field('missing_image', 'option');
  $missing_img = $missing_img_array['sizes']['medium_large'];
  $featured_img =  !empty(get_field('tax_img', $taxonomy.'_'.$term_id)) ? get_field('tax_img', $taxonomy.'_'.$term_id)['sizes']['medium_large'] : $missing_img;
 
  $post_link = get_category_link($term_id);
  $title = $name;
  // $excerpt = !empty(get_the_excerpt()) ? wp_trim_words(get_the_excerpt(), 20, ' ...') :  wp_trim_words(get_the_excerpt(), 20, ' ...');
  $card_color_class = !empty(get_field('overlay_copy', $taxonomy.'_'.$term_id)) ? get_field('overlay_copy', $taxonomy.'_'.$term_id) : '';
  $term_children = get_term_children($term_id, 'category');
  $term_has_children = !empty($term_children);
  // var_dump($term_children);
?>
<?php if($term_has_children) :?>
<div href="<?php echo $post_link; ?>" class="uni_card item-fadein load-hidden">
<?php else : ?>
<a href="<?php echo $post_link; ?>" class="uni_card item-fadein load-hidden">
<?php endif; ?>
  <div class="card_container">
    <article>
      <header>
        <figure>
          <img src="<?php echo $featured_img; ?>" alt="">
          <figcaption class="<?php echo $card_color_class; ?>"><?php echo $title; ?></figcaption>
        </figure>
      </header>
      <main>
        <h2><?php echo $title; ?></h2>
        <?php 
          if(!empty($term_children)) {
            ?>
            <div class="link_container">


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
<?php if($term_has_children) :?>
  </div>
<?php else : ?>
  </a>
<?php endif; ?>


