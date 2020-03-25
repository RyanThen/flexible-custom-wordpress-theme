<?php

// Create New Route (endpoint) for JSON Data
add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch() {
	register_rest_route('university/v1', 'search', array(
		'methods' => WP_REST_SERVER::READABLE,   // 'GET'
		'callback' => 'universitySearchResults'
	));
}

function universitySearchResults() {
	return 'New Route';
}