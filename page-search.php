
<?php

get_header();

while(have_posts()) {
	the_post();
	pageBanner();
	?>
	
	<div class="container container--narrow page-section">
		
		<?php
		$the_parent = wp_get_post_parent_id(get_the_ID());
		if ($the_parent) { ?>
			<div class="metabox metabox--position-up metabox--with-home-link">
				<p><a class="metabox__blog-home-link" href="<?php echo get_permalink($the_parent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($the_parent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
			</div>
		<?php } ?>
		
		<?php
		$testArray = get_pages(array(
			'child_of' => get_the_ID()
		));
		
		if ($the_parent or $testArray) { ?>
			<div class="page-links">
				<h2 class="page-links__title"><a href="<?php echo get_permalink($the_parent) ?>"><?php echo get_the_title($the_parent); ?></a></h2>
				<ul class="min-list">
					<?php
					if ($the_parent) {
						$find_children_of = $the_parent;
					} else {
						$find_children_of = get_the_ID();
					}
					
					wp_list_pages(array(
							'title_li' => NULL,
							'child_of' => $find_children_of,
							'sort_column' => 'menu_order'
						)
					);
					?>
				</ul>
			</div>
		<?php }; ?>
		
		<div class="generic-content">
			<form class="search-form" method="get" action="<?php echo esc_url(site_url('/')); ?>">
				<label class="headline headline--medium" for="s">Perform your new search</label>
				<div class="search-form-row">
					<input class="s" type="search" name="s" id="s" placeholder="What are you looking for?">
					<input class="search-submit" type="submit" value="Submit">
				</div>
				
			</form>
		</div>
	
	</div>

<?php };

get_footer();

?>