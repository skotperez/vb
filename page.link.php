<?php /* Template Name: Linkoteca */
get_header();
include("general-vars.php"); ?>

<section>

<?php
$tag = ( array_key_exists('tag',$_GET) ) ? sanitize_text_field($_GET['tag']) : '';
$args = array(
	'tag' => $tag,
	'post_type' => 'link',
);
if ( $paged > 1 ) {
  $args['paged'] = $paged;
}

// The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	// The Loop
	while ( $the_query->have_posts() ) : $the_query->the_post();

		include("loop.php");

	endwhile;

	include("navigation.php");

} else { ?>
No result message.
<?php } ?>
</section>

<?php get_footer(); ?>
