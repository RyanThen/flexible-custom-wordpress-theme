<?php
get_header();
pageBanner(array(
	'title' => 'All Events',
	'subtitle' => 'See what is going on in our world'
));
?>
	
	<div class="container container--narrow page-section"> <!-- Start Page Container Div -->
		
		<?php
		
		$today = date('Ymd');
		$pastEvents = new WP_Query(array(
			'paged' => get_query_var('paged', 1),
			'post_type' => 'event',
			'meta_key' => 'events_date',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key' => 'events_date',
					'compare' => '<',
					'value' => $today,
					'type' => 'numeric'
				)
			)
		));
		
		while($pastEvents->have_posts()) {
			$pastEvents->the_post();
			get_template_part('template-parts/content-event');
		};
		
		echo paginate_links(array(
			'total' => $pastEvents->max_num_pages
		));
		?>
	</div> <!-- End Page Container Div -->


<?php get_footer(); ?>