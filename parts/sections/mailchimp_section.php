<?php 
  global $post;
?>
<section class="uni_section grid-with-margin" data-section_order="<?php echo $i ?>">
  <main class="mailchimp-container grid-12-container">
  <?php uni_partial('parts/components/mailchimp-form', ['id_index' => 1, 'columns' => 6, 'location' => $post->post_name]);  ?>
  </main>

</section>