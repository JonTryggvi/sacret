<?php
/*
//	Element Page - Advanced Custom fields - Flexible Content
*/
?> 
<?php if( have_rows('elements') ): ?>

    <?php while ( have_rows('elements') ) : the_row(); ?>

	    <?php if( get_row_layout() == 'something' ): ?>


	  	<?php elseif( get_row_layout() == 'something' ): ?>


	    <?php endif; ?>

    <?php endwhile; ?>

<?php endif; ?>