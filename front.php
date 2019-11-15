<?php
/*
Template Name: Front
*/
get_header(); ?>



<?php while ( have_posts() ) : the_post(); ?>
<?php
	$a_hero_args = ['hero_title' => get_the_title()];
	uni_partial('parts/component-hero', $a_hero_args); 
	
	uni_partial('parts/sections/product-section');
	uni_partial('parts/component-zen');
	?>
<?php endwhile; ?>






<?php get_footer();
