<?php 
   
  $img_objs = get_sub_field('images');
  $section_title = get_sub_field('section_title', $post->ID) ? get_sub_field('section_title', $post->ID) : false; 
  if(have_rows('images')): ?>
    <section class="uni_section" data-section_order="<?php echo $i ?>">
      
      <div class="uni_section__gallery grid-with-margin grid-row-content__12_row" role="main" > 
          <?php if(false !== $section_title): ?>
            <h2><?php echo $section_title; ?></h2>
          <?php  endif;  ?>
        <?php
          $a_class = [
            0 => 'img_1',
            1 => 'img_2',
            2 => 'img_3',
          ];
          $a_img_count = [
            1 => 'one',
            2 => 'two',
            3 => 'three'
          ];
          $total_imgs = count($img_objs) > 3 ? 3 : count($img_obj);
          $layout_class = $a_img_count[$total_imgs];
          foreach($img_objs as $key => $img_obj): 
            $class = $a_class[$key] ? $a_class[$key] : 'hideme';
        ?>
          <figure class="<?php echo $class.' '.$layout_class; ?>">
            <img src="<?php echo $img_obj['sizes']['medium_large']; ?>" alt="">
          </figure>
	
      <?php	endforeach; ?>
    </div>
  </section>
<?php endif; ?>