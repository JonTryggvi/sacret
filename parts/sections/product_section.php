<?php 
  $section_title = get_sub_field('product_title', $post->ID) ? get_sub_field('product_title', $post->ID) : false; 
  $section_has_title = $section_title !== false ? 'uni_section__has_title' : '';
?>

<section class="uni_section uni_section__products <?php echo $section_has_title; ?> grid-with-margin">
<?php if(false !== $section_title): ?>
  <h2><?php echo $section_title; ?></h2>
<?php endif; ?>
  <div class="card-container">
    
      <?php
        $query = new WC_Product_Query( array(
          'limit' => 3,
          'orderby' => 'date',
          'order' => 'DESC',
          'return' => 'ids',
        ) );
        $products = $query->get_products(); 
        foreach ($products as $key => $product_id) {
          $product = wc_get_product($product_id);
          uni_partial('parts/components/product-card', [
            'product' => $product,
            'product_id' => $product_id
          ]);
        }
      
      ?>
    
   
  </div>
</section>