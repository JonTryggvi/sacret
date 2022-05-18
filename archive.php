<?php 
	if (!defined('ABSPATH')) exit;
	get_header();
?>
	<main id="mainarea" class="mainarea" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
							
	<?php if (have_posts()) : ?>
		<section class="uni_section uni_section__has_title uni_section__posts  archive grid-with-margin" data-post-type="post" data-term-id="<?php echo get_queried_object()->term_id; ?>">
			<?php the_archive_title( '<h2>', '</h2>' ); ?>
			<div class="card-container"></div> 
			<?php 	uni_partial('parts/components/loadmore-button');	?>
		</section>
	<?php else : ?>
		<section class="uni_section uni_section__has_title archive grid-with-margin" >
			<h2><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h2>
			<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
		</section>

	<?php endif; ?>

</main>


<?php get_footer(); ?>
