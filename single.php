<?php 
	if (!defined('ABSPATH')) exit;
	get_header();
?>

		

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">


						<?php if (have_posts()) : while (have_posts()) : the_post(); 

							include_once('parts/elements.php');

						endwhile; endif; ?>

					</main>

			
		

<?php get_footer(); ?>
