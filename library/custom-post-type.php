<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// Person custom post type
function person_custom_type() { 
	// creating (registering) the custom type 
	register_post_type( 'people', // (http://codex.wordpress.org/Function_Reference/register_post_type) 
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'People', 'bonestheme' ), 
			'singular_name' => __( 'Person', 'bonestheme' ), 
			'all_items' => __( 'All People', 'bonestheme' ),
			'add_new' => __( 'Add New', 'bonestheme' ),
			'add_new_item' => __( 'Add New Person', 'bonestheme' ),
			'edit' => __( 'Edit', 'bonestheme' ),
			'edit_item' => __( 'Edit Person', 'bonestheme' ),
			'new_item' => __( 'New Person', 'bonestheme' ),
			'view_item' => __( 'View Person', 'bonestheme' ),
			'search_items' => __( 'Search Person', 'bonestheme' ),
			'not_found' =>  __( 'Nothing found in the Database.', 'bonestheme' ),
			'not_found_in_trash' => __( 'Nothing found in Trash', 'bonestheme' ),
			'parent_item_colon' => ''
			),
			'description' => __( 'For people involved in shows: cast and crew', 'bonestheme' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-universal-access',
			'rewrite'	=> array( 'slug' => 'people', 'with_front' => false ),
			//'has_archive' => 'show',
			'has_archive' => false,
			'hierarchical' => false,
				'capability_type' => 'post',
			// the next one is important, it tells what's enabled in the post editor 
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
		) // end of options 
	); // end of register post type 
	
}

// adding the function to the Wordpress init
add_action( 'init', 'person_custom_type');

register_taxonomy( 'person_cat', 
	array('people'),
	array('hierarchical' => true,
		'labels' => array(
			'name' => __( 'People Categories', 'bonestheme' ),
			'singular_name' => __( 'People Category', 'bonestheme' ),
			'search_items' =>  __( 'Search People Categories', 'bonestheme' ),
			'all_items' => __( 'All People Categories', 'bonestheme' ),
			'parent_item' => __( 'Parent People Category', 'bonestheme' ),
			'parent_item_colon' => __( 'Parent People Category:', 'bonestheme' ),
			'edit_item' => __( 'Edit People Category', 'bonestheme' ),
			'update_item' => __( 'Update People Category', 'bonestheme' ),
			'add_new_item' => __( 'Add New People Category', 'bonestheme' ),
			'new_item_name' => __( 'New People Category Name', 'bonestheme' )
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'cast' ),
	)
);
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
	register_taxonomy( 'custom_cat', 
		array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'Custom Categories', 'bonestheme' ), /* name of the custom taxonomy */
				'singular_name' => __( 'Custom Category', 'bonestheme' ), /* single taxonomy name */
				'search_items' =>  __( 'Search Custom Categories', 'bonestheme' ), /* search title for taxomony */
				'all_items' => __( 'All Custom Categories', 'bonestheme' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent Custom Category', 'bonestheme' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent Custom Category:', 'bonestheme' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit Custom Category', 'bonestheme' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update Custom Category', 'bonestheme' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New Custom Category', 'bonestheme' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New Custom Category Name', 'bonestheme' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'custom-slug' ),
		)
	);
	
	

?>
