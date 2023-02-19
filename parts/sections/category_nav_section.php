<?php 
  $section_title = get_sub_field('section_title', $post->ID) ? get_sub_field('section_title', $post->ID) : false; 
  $section_has_title = $section_title !== false ? 'uni_section__has_title ' : ' ';
  $is_published = get_sub_field('publish_section');
  $selected_categories = get_sub_field('post_category');

  $menu_name = 'uni-custom';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
  if(!empty($menuitems) && $is_published) :

?>
  <section class="uni_section uni_section__cat_nav <?php echo $section_has_title;  ?> grid-with-margin" data-type="post_category" >
  <?php if(false !== $section_title): ?>
    <h2 class="text"><?php echo $section_title; ?></h2>
  <?php endif; ?>
    <div class="cat-nav-container">
      <?php foreach ($menuitems as $key => $cat) :
        uni_partial('parts/components/nav-card', (array)$cat);
      endforeach; ?>
    </div>
  </section>
<?php endif; ?>