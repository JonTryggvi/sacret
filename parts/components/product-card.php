<?php 
$product = wc_get_product(get_the_ID());
$product_title = $product->get_name();
$product_id = $product->get_id();
$product_img_url = get_the_post_thumbnail_url($product_id) ? get_the_post_thumbnail_url($product_id) : ''; # get_field('missing_image', 'option');
$product_text = wp_trim_words($product->get_description(), 20, ' ...');
$card_color_class = get_field('overlay') ? get_field('overlay') : '';
?>
<a class="uni_card cell medium-4 item-fadein load-hidden" href="<?php echo get_the_permalink($product_id); ?>">
  <article >
    <header>
      <figure>
        <img src="<?php echo $product_img_url; ?>" alt="">
        <figcaption class="<?php echo $card_color_class; ?>"><?php echo $product_title; ?></figcaption>
      </figure>
    </header>
    <main>
      <h2><?php echo $product_title; ?></h2>
      <p><?php echo $product_text; ?></p>
    </main>
  </article>
</a>

