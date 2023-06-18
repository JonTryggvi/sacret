<header class="uni_header header grid-with-margin" role="banner" itemscope itemtype="http://schema.org/WPHeader" data-theme_color="<?php echo $theme_color; ?>">

  <div id="inner-header" class="uni_header__inner-container grid-12-container">

    <?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
    <h1 class="uni_header__logo-h1"><a href="<?php echo home_url('/', 'https'); ?>" class="uni_header__logo-link">Uni<?php uni_partial('library/icons/uni_logo.svg'); ?></a></h1>

    <nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
      <span class="menu_hamburger"><span></span><span></span></span>
      <!-- <span class="magic-line"></span> -->
      <div></div>
      <?php
        wp_nav_menu(array(
          'container' => 'div',
          'container_class' => 'main-menu',
          'menu' => __( 'The Main Menu', 'bonestheme' ),
          'menu_class' => 'nav top-nav uni_header__nav-list text-pink',
          'theme_location' => 'main-nav',
          'before' => '',
          'after' => '',
          'link_before' => '',
          'link_after' => '',
          'depth' => 2,
          'fallback_cb' => '',
          // 'walker' => new Walker_Nav_Menu()
        ));
      ?>

    </nav>
  </div>

</header>