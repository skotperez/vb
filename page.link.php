<?php /* Template Name: Linkoteca */
get_header();
include("general-vars.php"); ?>


<?php
$tags = ( array_key_exists('tags',$_GET) ) ? sanitize_text_field($_GET['tags']) : '';
if ( $tags == '' ) { // if is not tag mosaic
	
	$tag = ( array_key_exists('tag',$_GET) ) ? sanitize_text_field($_GET['tag']) : '';
	if ( $paged > 1 )
		$args['paged'] = $paged;
	$args['tag'] = ( $tag != '' ) ? $tag : false;
	$args['post_type'] = 'link';

	echo '<section>';
	// The Query
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		// The Loop
		while ( $the_query->have_posts() ) : $the_query->the_post();
			include("loop.php");
		endwhile;

		include("navigation.php");

	} else {
		$no_links_message = ( $tag != '' ) ? sprintf(__('No links under context %s','vb'),$tag) : __('There is still no links.','vb');
		echo $no_links_message;
	}
	echo '</section>';
}

get_footer(); ?>
