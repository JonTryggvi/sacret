<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require( 'library/bones.php' );
require( 'inc/remove-comments.php' );
require( 'library/uni-translations.php' );
require( 'library/uni-function.php') ;
require( 'library/uni_custom_posttypes.php' );
require( 'library/uni-ajax.php' );
// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
// add_image_size( 'bones-thumb-600', 600, 150, true );
// add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'site-banner', 1800, 1600, true );
add_image_size( 'site-banner-nc', 1800, 1600, false );
add_image_size( 'site-thumb-square', 800, 800, true );
add_image_size( 'site-thumb-square-nc', 800, 800, false );

add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {
  return array_merge( $sizes, array(
    'site-thumb-square' => __( 'Unis Square 800x800' ),

  ) );
}

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/*
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722

  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162

  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');

  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

// add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

// Add Scroll to anchor on gravity form confirm
add_filter( 'gform_confirmation_anchor', '__return_true' );

// Add SVG upload option to media library
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Add Active class a menu
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active';
    }
    return $classes;
}

// Add Option Page to ADCF
// if( function_exists('acf_add_options_page') ) {
//     acf_add_options_page('Stillingar');
// }

// Add Google API key for Advanced Custom Fields
function my_acf_init() {
  acf_update_setting('google_api_key', 'AIzaSyCD61O31_QHfKo1rPqQBjGNZPfda6rCGgY');

  if( function_exists('acf_register_block') ) {
    acf_register_block(array(
      'name'              => 'card-deck',
      'title'             => __('Card deck'),
      'description'       => __('A way to show cards in content.'),
      'render_callback'   => 'card_rack',
      'category'          => 'formatting',
      'icon'              => 'admin-post',
      'keywords'          => array( 'cards', 'posts' ),
    ));
  }
}

add_action('acf/init', 'my_acf_init');

function card_rack( $block ) {
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $post_id = get_queried_object() ? get_queried_object()->ID : $_GET['post'];
    $slug = str_replace('acf/', '', $block['name']);
    $posts = $block['data']['posts'];
    $field_name = $block['data']['_posts'];
    // $posts = get_field($field_name);
    $is_archive = false;
    $section_type = 'content_block';
    $select_posts = 1;
    $section_id = random_int(1111, 9999);
    ?>
    <section id="<?php echo $section_id; ?>" class="uni_section uni_section__posts grid-with-margin" data-post-type="post" data-section_order="<?php echo 1 ?>" data-per_page="<?php echo 1 ?>" data-post_type="post" data-field="<?php echo implode(',',$posts); ?>"  data-preselected="<?php echo $select_posts ?>" data-post_id="<?php echo $post_id; ?>" >

    <?php if(false !== $slug): ?>
      <h2><?php echo $slug; ?></h2>
    <?php endif; ?>
      <?php if(!$is_archive) : ?>
        <span class="scrollBtn scrollBack visibility__hidden"><?php uni_partial('library/images/ico-0003.svg') ?></i></span>
      <?php endif; ?>
      <div id="<?php echo "container_$section_id"; ?>" class="card-container common-cards">
      </div>
      <?php if($is_archive):
        uni_partial('parts/components/loadmore-button');

      endif; ?>
      <?php if(!$is_archive) : ?>
          <span class="scrollBtn scrollForward"><?php uni_partial('library/images/ico-0003.svg') ?></span>
      <?php endif; ?>

    </section>
    <?php
    // include a template part from within the "template-parts/block" folder
    // if( file_exists( get_theme_file_path("/template-parts/block/content-{$slug}.php") ) ) {
    //     include( get_theme_file_path("/template-parts/block/content-{$slug}.php") );
    // }
}

// WPML language switcher
// Language Code language_code
// Language name native_name
// function for placement language_selector();
function language_selector(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        foreach($languages as $l){
            if(!$l['active']){
                echo '<a href="'.$l['url'].'">' . $l['native_name'] . '</a>';
            }
        }
    }
}


// Declare Woocommerce Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );

}




/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <?php /*<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" /> */ ?>
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/* DON'T DELETE THIS CLOSING TAG */ ?>
