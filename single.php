<?php
get_header();
include("general-vars.php"); ?>

<section>

<?php
$args = array(
	'post_type' => 'link',
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) : $the_query->the_post();

		include("loop.php");
		// if ( in_category('129') ) { // if breves category 
			// TODO: automatic system to include first image thumb of the post
			// diff between breves and the other caterories
		if ( is_single() || is_page() ) { comments_template(); }

		?>
	<?php endwhile;
 ?>


<?php } ?>
</section>

<?php get_footer(); ?>
