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


// let's create the function for the custom type
function custom_post_stellenangebote() { 
	// creating (registering) the custom type 
	register_post_type( 'stellenangebote', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Stellenangebote', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Stellenangebot', 'bonestheme'), /* This is the individual type */
			'all_items' => __('Alle Stellenangebote', 'bonestheme'), /* the all items menu item */
			//'add_new' => __('Neues Stellenangebot erstellen', 'bonestheme'), /* The add new menu item */
			//'add_new_item' => __('Neues Stellenangebot erstellen', 'bonestheme'), /* Add New Display Title */
			'add_new' => __('Neue Stellenangebote bitte NUR über das Eingabe-Formular erstellen!', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Neue Stellenangebote bitte NUR über das Eingabe-Formular erstellen!', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Stellenangebot bearbeiten', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Stellenangebot bearbeiten', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('Neues Stellenangebot', 'bonestheme'), /* New Display Title */
			'view_item' => __('Stellenangebote ansehen', 'bonestheme'), /* View Display Title */
			'search_items' => __('Stellenangebote suchen', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Dieser custom post type ist für die Stellenagebote gedacht', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			//'menu_icon' => get_stylesheet_directory_uri() . '/library/images/stellenangebote-icon.png', /* the icon for the custom post type menu */
			'menu_icon' => 'dashicons-format-aside',
			'rewrite'	=> array( 'slug' => 'stellenangebote', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'stellenangebote', /* you can rename the slug here */
			'capability_type' => 'post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'custom-fields', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type('category', 'stellenangebote');
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type('post_tag', 'stellenangebote');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_stellenangebote');

	function obj_custom_menu(){
		//add_posts_page(__('Drafts'), __('Drafts'), 'read', 'edit.php?post_status=draft&post_type=stellenangebote');
		add_submenu_page('edit.php?post_type=stellenangebote', 'Veröffentlichte', 'Veröffentlichte', 'read', 'edit.php?post_status=publish&post_type=stellenangebote');
		add_submenu_page('edit.php?post_type=stellenangebote', __('Drafts'), __('Drafts'), 'read', 'edit.php?post_status=draft&post_type=stellenangebote');
		add_submenu_page('edit.php?post_type=stellenangebote', __('Trash'), __('Trash'), 'read', 'edit.php?post_status=trash&post_type=stellenangebote');
		add_submenu_page('edit.php?post_type=stellenangebote', __('Archived'), __('Archived'), 'read', 'edit.php?post_status=archive&post_type=stellenangebote');
	}

	//extra submenu item fuer stellenangebote
	add_action( 'admin_menu', 'obj_custom_menu');

	function obj_remove_menu(){
		remove_submenu_page('edit.php?post_type=stellenangebote', 'post-new.php?post_type=stellenangebote');
	}

	//submenu item "Erstellen" entfernen
	add_action( 'admin_menu', 'obj_remove_menu');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'stellentyp', 
    	array('stellenangebote'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Stellentypen', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Stellentyp', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Stellentypen suchen', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'Alle Stellentypen', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom Category', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom Category:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom Category', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom Category', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Neue Kategorie für Stellentypen erstellen', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Category Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'stellentyp' ),
    	)
    );
    register_taxonomy_for_object_type('stellentyp', 'stellenangebote');

    register_taxonomy( 'einrichtungstyp', 
    	array('stellenangebote'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Einrichtungstypen', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Einrichtungstyp', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Einrichtungstypen suchen', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'Alle Einrichtungstypen', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom Category', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom Category:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom Category', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom Category', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Neue Kategorie für Einrichtungstypen erstellen', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Category Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'einrichtungstyp' ),
    	)
    );
    register_taxonomy_for_object_type('einrichtungstyp', 'stellenangebote');

	// now let's add custom tags (these act like categories)

    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */
	

?>
