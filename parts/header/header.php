<header class="uni_header header grid-with-margin" role="banner" itemscope itemtype="http://schema.org/WPHeader">

  <div id="inner-header" class="uni_header__inner-container">

    <?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
    <a href="<?php echo home_url(); ?>" class="uni_header__logo-link">Uni<?php uni_partial('library/svg_php/logo.svg'); ?></a>

    <nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
      <span class="magic-line"></span>
      <?php wp_nav_menu(array(
                'container' => false,                           // remove nav container
                'container_class' => 'menu',                 // class of container (should you choose to use it)
                'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
                'menu_class' => 'nav top-nav uni_header__nav-list',               // adding custom nav class
                'theme_location' => 'main-nav',                 // where it's located in the theme
                'before' => '',                                 // before the menu
                      'after' => '',                                  // after the menu
                      'link_before' => '',                            // before each link
                      'link_after' => '',                             // after each link
                      'depth' => 0,                                   // limit the depth of the nav
                'fallback_cb' => ''                             // fallback function (if there is one)
      )); ?>
    </nav>

  </div>

</header>