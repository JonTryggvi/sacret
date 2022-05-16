<div id="inner-footer" class="grid-with-margin">
    <nav class="grid-span--4" role="navigation">
      <?php if( has_nav_menu('footer-links')) : ?>
      <p>Nytsamlegir hlekkir</p>
      <?php wp_nav_menu(array(
        'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
        'container_class' => 'footer-links',         // class of container (should you choose to use it)
        'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
        'menu_class' => 'nav footer-nav',            // adding custom nav class
        'theme_location' => 'footer-links',             // where it's located in the theme
        'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
        'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
      )); ?>
  <?php endif; ?>  
</nav>

  <div class="grid-span--4 maillist">
    <?php uni_partial('parts/components/mailchimp-form', ['id_index' => 2, 'columns' => 4, 'location' => 'footer']); ?>
  </div>
  <div class="grid-span--4 footer-contact">
    <div class="footer-contact--inner" >
      <?php uni_partial('library/icons/uni_logo.svg'); ?>
      <a href="mailto:uni@uni.is">Hafa samband</a>
    </div>
  </div>
</div>
<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>