<?php
/*
 Template Name: Elements
*/
?>

<?php get_header(); ?>
		<?php // All Banners variations ACF ?>
		<?php include_once('parts/banners.php'); ?>

		<main role="main" id="mainarea" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">	
		
			<?php // All versions of Elements in ACF - Flexible Contents ?>
			<?php include_once('parts/elements.php'); ?>

		</main>	

<?php get_footer(); ?>
