
<?php

get_header();

while(have_posts()) {
	the_post();
	pageBanner();
	?>
	
	<div class="container container--narrow page-section">
		Custom code will go here.
	</div>

<?php };

get_footer();

?>