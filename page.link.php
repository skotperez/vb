<?php /* Template Name: Linkoteca */
get_header();
include("general-vars.php"); ?>


<?php
$tags = ( array_key_exists('tags',$_GET) ) ? sanitize_text_field($_GET['tags']) : '';
$tag = ( array_key_exists('tag',$_GET) ) ? sanitize_text_field($_GET['tag']) : '';
$args = array(
	'tag' => $tag,
	'post_type' => 'link',
);
if ( $paged > 1 ) {
  $args['paged'] = $paged;
}

if ( $tags == '' ) {
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
	}
	echo '</section>';
}

get_footer(); ?>
