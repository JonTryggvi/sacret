<?php
$incoming_product = isset($product) ? $product : null;
$product = null;

if ($incoming_product instanceof WC_Product) {
  $product = $incoming_product;
} elseif ($incoming_product instanceof WP_Post) {
  $product = wc_get_product($incoming_product->ID);
} elseif (is_numeric($incoming_product)) {
  $product = wc_get_product((int) $incoming_product);
}

if (!$product) {
  $post_id = get_the_ID();
  if ($post_id) {
    $product = wc_get_product($post_id);
  }
}

if (!$product) {
  return;
}

$product_id = $product->get_id();
$product_title = $product->get_name();
$missing_img_array = get_field('missing_image', 'option');
$missing_img = isset($missing_img_array['sizes']['medium_large']) ? $missing_img_array['sizes']['medium_large'] : '';
$product_img_url = get_the_post_thumbnail_url($product_id);
$product_img_url = $product_img_url ? $product_img_url : $missing_img;
$product_text = wp_trim_words($product->get_description(), 20, ' ...');
$overlay_field = get_field('overlay', $product_id);
$card_color_class = $overlay_field ? $overlay_field : '';
?>
<a class="uni_card cell medium-4 item-fadein load-hidden" href="<?php echo get_the_permalink($product_id); ?>">
  <div class="card_container">
    <article>
      <header>
        <figure>
          <img src="<?php echo $product_img_url; ?>" alt="">
          <figcaption class="<?php echo $card_color_class; ?>"><?php echo $product_title; ?></figcaption>
        </figure>
      </header>
      <main>
        <h2 class="visibility__none"><?php echo $product_title; ?></h2>
        <p><?php echo $product_text; ?></p>
      </main>
    </article>
  </div>
</a>
