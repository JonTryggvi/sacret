<?php
/*
//	Banners - Advanced Custom fields - Flexible Content
*/
?> 
<?php if( have_rows('banners') ): ?>

    <?php while ( have_rows('banners') ) : the_row(); ?>

	    <?php if( get_row_layout() == 'something' ): ?>


	  	<?php elseif( get_row_layout() == 'something' ): ?>


	    <?php endif; ?>

    <?php endwhile; ?>

<?php endif; ?>