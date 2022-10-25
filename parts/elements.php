<?php
/*
**	Element Page - Advanced Custom fields - Flexible Content
*/
?> 


<?php 
if( have_rows('sections') ):
	$i = 0;
	$hero_title = false;
	while ( have_rows('sections') ) : the_row(); 
		$row_layout = get_row_layout() ? get_row_layout() : 'row_layout_not_found'; 
		if('hero_slider_cont' == $row_layout) $hero_title = true;
		
		uni_partial('parts/sections/'.$row_layout, ['post' => get_queried_object(), 'i' => $i, 'hero_title' => $hero_title]);
		$i++;
	endwhile; 
endif; ?>