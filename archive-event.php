<?php
get_header();
pageBanner(array(
	'title' => 'All Events',
	'subtitle' => 'See What is going on in our world'
));
?>
	
	<div class="container container--narrow page-section"> <!-- Start Page Container Div -->
		
		<?php
		while(have_posts()) {
			the_post();
			get_template_part('template-parts/content-event');
		};
		
		echo paginate_links();
		?>

		<hr class="section-break">
		<p>Looking for a recap of past events? Check out our <a href="<?php echo site_url('/past-events')?>">past events archive</a>.</p>
	</div> <!-- End Page Container Div -->


<?php get_footer(); ?>