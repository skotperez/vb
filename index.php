<?php
get_header();
include("general-vars.php"); ?>

<section>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();

		include("loop.php");
		// if ( in_category('129') ) { // if breves category 
			// TODO: automatic system to include first image thumb of the post
			// diff between breves and the other caterories
		if ( is_single() ) { comments_template(); }

		?>
	<?php endwhile;
 ?>

	<?php if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
		include("navigation.php");
	} ?>

<?php else : ?>
No result message.
<?php endif; ?>
</section>

<?php get_footer(); ?>
