<?php

require get_theme_file_path('/inc/search-route.php');

// Customize Existing Rest API
function universityCustomRest() {
	register_rest_field('post', 'authorName', array(
		'get_callback' => function(){ return get_the_author(); }
	));
}

add_action('rest_api_init', 'universityCustomRest');

// Page Banner Function
function pageBanner($args = NULL) {
	
	if (!$args['title']) {
		$args['title'] = get_the_title();
	}
	if (!$args['subtitle']) {
		$args['subtitle'] = get_field('page_banner_subtitle');
	}
	if (!$args['image']) {
		if (get_field('page_banner_background_image')) {
			$args['image'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
		} else {
			$args['image'] = get_theme_file_uri('images/ocean.jpg');
		}
	} ?>
	
	<div class="page-banner">
		<div class="page-banner__bg-image" style="background-image: url(<?php echo $args['image']; ?>);"></div>
		<div class="page-banner__content container container--narrow">
			<h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
			<div class="page-banner__intro">
				<p><?php echo $args['subtitle']; ?></p>
			</div>
		</div>
	</div>
<?php
}

// Enqueue Files
function fictional_university_files() {
	wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('udemy-styles', get_template_directory_uri() . '/css/u-styles.css');
	wp_enqueue_style('main-stylesheet', get_stylesheet_uri());
	
	wp_enqueue_script('main-javascript', get_theme_file_uri('js/scripts-bundled.js'), NULL, microtime(), true);
	
	wp_localize_script('main-javascript', 'universityData', array(
		'root_url' => get_site_url()
	));
}
add_action('wp_enqueue_scripts', 'fictional_university_files');

// Theme Features
function fu_theme_features(){
	register_nav_menu('primary', 'Primary Navigation Menu');
	register_nav_menu('footerOne', 'Footer Navigation 1');
	register_nav_menu('footerTwo', 'Footer Navigation 2');
	
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	
	add_image_size('professorLandscape', 400, 260, true);
	add_image_size('professorPortrait', 480, 650, true);
	add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'fu_theme_features');

// Adjust Default Queries
function university_query_adjustments($query) {
	if (!is_admin() AND is_post_type_archive() AND $query->is_main_query()) {
		$today = date('Ymd');
		$query->set('meta_key', 'events_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
				array(
					'key' => 'events_date',
					'compare' => '>=',
					'value' => $today,
					'type' => 'numeric'
				)
			)
		);
	}
}

add_action('pre_get_posts', 'university_query_adjustments');

// Redirect subscriber accounts out of admin and onto front page
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
	$ourCurrentUser = wp_get_current_user();
	
	if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		wp_redirect(site_url('/'));
		exit;
	}
}

// Remove admin bar from subscriber roles
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
	$ourCurrentUser = wp_get_current_user();
	
	if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
		show_admin_bar(false);
	}
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
	return esc_url(site_url('/'));
}

  // load styles/scripts on login screen
add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
	wp_enqueue_style('main-stylesheet', get_stylesheet_uri());
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}
  // customize tooltip when hovering over login header title
add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
	return get_bloginfo('name');
}

?>