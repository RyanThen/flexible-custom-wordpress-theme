<?php

function university_post_types() {
	//Events Post Type
	register_post_type('event', array(
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'excerpt'),
		'rewrite' => array('slug' => 'events'),
		'has_archive' => true,
		'public' => true,
		'labels' => array(
			'name' => 'Events',
			'add_new_item' => 'Add New Event',
			'edit_item' => 'Edit Event',
			'all_items' => 'All Events',
			'singular_name' => 'Event'
		),
		'menu_icon' => 'dashicons-calendar'
	));
	
	//Programs Post Type
	register_post_type('catalog', array(
		'show_in_rest' => true,
		'supports' => array('title', 'editor'),
		'has_archive' => true,
		'public' => true,
		'labels' => array(
			'name' => 'Catalog',
			'add_new_item' => 'Add New Program',
			'edit_item' => 'Edit Program',
			'all_items' => 'All Programs',
			'singular_name' => 'Program'
		),
		'menu_icon' => 'dashicons-awards'
	));
	
	//Professors Post Type
	register_post_type('professor', array(
		'show_in_rest' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'public' => true,
		'labels' => array(
			'name' => 'Professors',
			'add_new_item' => 'Add New Professor',
			'edit_item' => 'Edit Professor',
			'all_items' => 'All Professor',
			'singular_name' => 'Professor'
		),
		'menu_icon' => 'dashicons-welcome-learn-more'
	));
	
	//Note Post Type
	register_post_type('note', array(
		'show_in_rest' => true,
		'supports' => array('title', 'editor'),
		'public' => false,
		'show_ui' => true,
		'labels' => array(
			'name' => 'Notes',
			'add_new_item' => 'Add New Note',
			'edit_item' => 'Edit Note',
			'all_items' => 'All Notes',
			'singular_name' => 'Note'
		),
		'menu_icon' => 'dashicons-welcome-write-blog'
	));
	
}

add_action('init', 'university_post_types');

?>