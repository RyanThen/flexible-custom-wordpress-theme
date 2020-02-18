<?php
get_header();
pageBanner(array(
	'title' => 'Catalog',
	'subtitle' => 'Check out our catalog of programs.  There is something for everybody!'
));
?>
	
	<div class="container container--narrow page-section"> <!-- Start Page Container Div -->
		
		<ul class="link-list min-list">
		<?php
		$catalog = new WP_Query(array(
			'post_type' => 'catalog',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC'
		));
		while($catalog->have_posts()) {
			$catalog->the_post(); ?>
			
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		
		<?php };
		
		echo paginate_links();
		?>
		</ul>
		
	</div> <!-- End Page Container Div -->


<?php get_footer(); ?>