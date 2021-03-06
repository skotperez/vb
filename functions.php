<?php
// theme setup main function
add_action( 'after_setup_theme', 'vb_theme_setup' );
function vb_theme_setup() {

	// don't print wordpress version in site head section
	remove_action('wp_head', 'wp_generator');

	// post formats
	add_theme_support( 'post-formats', array( 'aside','link','quote','video' ) );

	// thumbnails
	add_theme_support( 'post-thumbnails' ); 

	/* Load JavaScript files on the 'wp_enqueue_scripts' action hook. */
	add_action( 'wp_enqueue_scripts', 'vb_load_scripts' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'vb' ),
		'secondary' => esc_html__( 'Secondary', 'vb' ),
	) );

	// load language files
	load_theme_textdomain('vb', get_template_directory(). '/lang');
}

/**
 * Register our sidebars and widgetized areas.
 *
 */
function vb_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer sidebar',
		'id'            => 'vb_widget_footer',
		'before_widget' => '<div class="epi-col3">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-tit">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'vb_widgets_init' );

// load js scripts in the site
function vb_load_scripts() {
	wp_enqueue_script(
		'fa-js',
		get_template_directory_uri() . '/js/fontawesome-all.min.js',NULL,NULL,true
	);

	if ( is_page_template('page.link.php') ) {
		wp_enqueue_script(
			'list-js',
			get_template_directory_uri() . '/js/list.min.js',NULL,NULL,true
		);
	}
} // end load js scripts in the site

function vb_extra_scripts() {
	if ( is_page_template('page.link.php') ) {
		echo "<script type='text/javascript'>
			var options = {
				valueNames: [ 'name' ]
			};
			var tagList = new List('tag-list', options);</script>";
	}
} // end load js scripts in the site
add_action('wp_footer','vb_extra_scripts',999);

// Twenty Eleven theme comments function with some modifications
if ( ! function_exists( 'vb_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function vb_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<span class="ping-tit"><?php comment_author_link(); ?></span><br />
		<?php edit_comment_link('Editar', '<span class="edit-link">', '</span> | ');
		comment_text(); ?>
	</li>
	<?php	break;
		default :

			if ($comment->comment_approved == '0') { // if comment is not approved ?>
				<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
					<p>Tu comentario ser&aacute; revisado antes de aparecer publicado.</p>
       				</li>
	<?php		} else { // if comment is approved ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<?php // $avatar_size = 68;
		// if ( '0' != $comment->comment_parent ) { $avatar_size = 39; } ?>
		<?php // echo get_avatar( $comment, $avatar_size ); ?>
		<ul class="comment-meta">
			<li>Por <?php comment_author_link(); ?> &bull; <time datetime="<?php comment_date('Y-m-Y') ;?>" class="comment-date"><?php comment_date('d \d\e F \d\e Y'); ?></time></li>
		</ul>
		<div class="comment-text">
			<?php comment_text(); ?>
		</div>
		<ul class="comment-meta">
			<li class="vb-bt"><a href="<?php comment_link( $comment->comment_ID ); ?>" title="Enlace permanente a este comentario">&infin;</a></li>
			<li id="reply-bt" class="vt-bt"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => '&crarr;', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ;?></li>
		</ul>
	</li><!-- end #comment -->
			
	<?php }
		break;
	endswitch;
}
endif; // ends check for vb_comment()

// trackbacks and pingbacks counter
function trackback_count() {
global $wpdb;
global $post;
$postid = $post->ID;
$count = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = 'pingback' AND comment_approved = '1' AND comment_post_ID = '$postid'";
//$count = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = 'pingback'";
$counter = $wpdb->get_var($count);
if ( $counter == 0 ) { echo "No hay trackbacks"; }
elseif ( $counter == 1 ) { echo "Un trackback"; }
else { echo "$counter trackbacks"; }
}

// human comments counter
function human_comment_count() {
global $wpdb;
global $post;
$postid = $post->ID;
$count = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = '' AND comment_approved = '1' AND comment_post_ID = '$postid'";
$counter = $wpdb->get_var($count);
if ( $counter == 0 ) { echo "No hay comentarios"; }
elseif ( $counter == 1 ) { echo "Un comentario"; }
else { echo "$counter comentarios"; }
}

// related posts
/**
 * Shows related posts by tag if available and category if not
 *
 * @author Justin Tallant
 * @param string $title h4 above list of related posts
 * @param int $count max number of posts to show
 * @return mixed related posts wrapped in div or null if none found
 */
function vb_related_posts($title = 'Contenido relacionado', $count = 5) {

	global $post;

	$tag_ids = array();

	$current_cat = get_the_category($post->ID);
	$current_cat = $current_cat[0]->cat_ID;
	$this_cat = '';

	$tags = get_the_tags($post->ID);

	if ( $tags ) {
		foreach($tags as $tag) {
			$tag_ids[] = $tag->term_id;
		}
	} else {
		$this_cat = $current_cat;
	}

	$args = array(
		'post_type'   => get_post_type(),
		'numberposts' => $count,
		'orderby'     => 'rand',
		'tag__in'     => $tag_ids,
		'cat'         => $this_cat,
		'exclude'     => $post->ID
	);

	$related_posts = get_posts($args);

	/**
	 * If the tags are only assigned to this post try getting
	 * the posts again without the tag__in arg and set the cat
	 * arg to this category.
	 */
	if ( empty($related_posts) ) {
		$args['tag__in'] = '';
		$args['cat'] = $current_cat;
		$related_posts = get_posts($args);
	}

	if ( empty($related_posts) ) {
		return;
	}

	$post_list = '';

	foreach($related_posts as $related) {
		$post_list .= '<li><a href="' . get_permalink($related->ID) . '">' . $related->post_title . '</a></li>';
	}

	return sprintf('
			%s
			<ul>%s</ul>
	', $title, $post_list );
} // end related posts function


// Show posts of 'post', 'link' post types on single pages
add_action( 'pre_get_posts', 'vb_add_custom_post_types_to_query' );
function vb_add_custom_post_types_to_query( $query ) {
	if ( is_single() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'link' ) );
	if ( is_page_template("page.link.php") )
		$query->set( 'posts_per_page', '50' );
	return $query;
}

// add custom post types to main feed
add_filter('request', 'prefix_feed_request');
function prefix_feed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'link');
	return $qv;
}
?>
