<?php
/*
	Template Name: Elements
*/
	if ( ! defined( 'ABSPATH' ) )	exit; // Exit if accessed directly
	get_header(); ?>


	<main role="main" id="mainarea" class="mainarea" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">	
		<?php include_once('parts/elements.php'); ?>
		<!-- <div class="uni-minicart"><div class="mini-inner"><?php woocommerce_mini_cart() ?></div></div> -->
	</main>	

<?php get_footer(); ?>
