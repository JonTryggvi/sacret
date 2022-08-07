<?php
/*
**	Element Page - Advanced Custom fields - Flexible Content
*/
?> 


<?php 
if( have_rows('sections') ):
	$i = 0;
	while ( have_rows('sections') ) : the_row(); 
		$row_layout = get_row_layout() ? get_row_layout() : 'row_layout_not_found'; 
		uni_partial('parts/sections/'.$row_layout, ['post' => get_queried_object(), 'i' => $i]);
		$i++;
	endwhile; 
endif; ?>