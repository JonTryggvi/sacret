<?php
function uni_perlumodir_post() {
	register_post_type('perlumodir',
		array(
			'labels'      => array(
				'name'          => __('Perlumóðir', 'uni'),
				'singular_name' => __('Perlumóðir', 'uni'),
			),
				'public'      => true,
				'has_archive' => true,
        'rewrite'     => array( 'slug' => 'perlumodir' ),
        'menu_icon'   => 'dashicons-heart',
		)
	);
}
// add_action('init', 'uni_perlumodir_post');


function uni_perlumodir_cat() {
	 $labels = array(
		 'name'              => _x( 'Perlumóðir flokkar', 'uni' ),
		 'singular_name'     => _x( 'Flokkur perlumóður', 'uni' ),
		 'search_items'      => __( 'Leita í flokkum' ),
		 'all_items'         => __( 'Allir flokkar' ),
		 'parent_item'       => __( 'Parent flokkur' ),
		 'parent_item_colon' => __( 'Parent flokkur:' ),
		 'edit_item'         => __( 'Edit flokkur' ),
		 'update_item'       => __( 'Update flokkur' ),
		 'add_new_item'      => __( 'Add New flokkur' ),
		 'new_item_name'     => __( 'New flokkur Name' ),
		 'menu_name'         => __( 'Flokkur' ),
	 );
	 $args   = array(
		 'hierarchical'      => true, // make it hierarchical (like categories)
		 'labels'            => $labels,
		 'show_ui'           => true,
		 'show_admin_column' => true,
		 'query_var'         => true,
		 'rewrite'           => [ 'slug' => 'perlumodir_cat' ],
	 );
	 register_taxonomy( 'perlumodir_cat', [ 'perlumodir' ], $args );
}
// add_action( 'init', 'uni_perlumodir_cat' );