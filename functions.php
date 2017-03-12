<?php
// theme setup main function
add_action( 'after_setup_theme', 'vb_theme_setup' );
function vb_theme_setup() {

	// don't print wordpress version in site head section
	remove_action('wp_head', 'wp_generator');

	// post formats
	add_theme_support( 'post-formats', array( 'aside','link','quote','video' ) );

	/* Load JavaScript files on the 'wp_enqueue_scripts' action hook. */
	add_action( 'wp_enqueue_scripts', 'vb_load_scripts' );
	/* Load JavaScript files on admin panel. */
//	add_action( 'admin_enqueue_scripts', 'vb_load_admin_scripts' );

	// custom post type
	add_action( 'init', 'vb_create_post_type', 0 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'vb' ),
		'lang' => esc_html__( 'Languages', 'vb' ),
		'secondary' => esc_html__( 'Secondary', 'vb' ),
	) );

}

// load js scripts in the site
function vb_load_scripts() {
	wp_enqueue_style(
		'fa-css',
		get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css'
	);

} // end load js scripts in the site

// load js scripts in admin panel
function vb_load_admin_cripts() {
	wp_enqueue_script(
		'clone-metabox-js',
		get_template_directory_uri() . '/js/clone.metabox.js',
		array( 'jquery' ),
		'0.1',
		FALSE
	);

} // end load js scripts in admin panel

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

// custom meta box in link CPT
function vb_metabox_link() {
		add_meta_box(
			'_vb_metabox_link_url', // ID
			'URL', // title
			'vb_metabox_link_render', // callback function
			'link', // post type
			'normal', // context: normal, side, advanced
			'high' // priority: high, core, default, low
		);
}
add_action( 'add_meta_boxes', 'vb_metabox_link', 10, 2 );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function vb_metabox_link_render( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'vb_metabox_link_render', 'vb_metabox_link_render_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_vb_metabox_link_url', true );

  echo '<label for="_vb_metabox_link_url">Link URL</label> ';
  echo '<input type="text" id="_vb_metabox_link_url" name="_vb_metabox_link_url" value="' . esc_attr( $value ) . '" size="95%" />';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function vb_metabox_link_save( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['vb_metabox_link_render_nonce'] ) )
    return $post_id;

  $nonce = $_POST['vb_metabox_link_render_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'vb_metabox_link_render' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $mydata = sanitize_text_field( $_POST['_vb_metabox_link_url'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_vb_metabox_link_url', $mydata );
}
add_action( 'save_post', 'vb_metabox_link_save' );


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

// custom post types
function vb_create_post_type() {
	// Proyectos custom post type
	register_post_type( 'link', array(
		'labels' => array(
			'name' => __( 'Links' ),
			'singular_name' => __( 'Link' ),
			'add_new_item' => __( 'Añadir un link' ),
			'edit' => __( 'Editar' ),
			'edit_item' => __( 'Editar este link' ),
			'new_item' => __( 'Nuevo link' ),
			'view' => __( 'Ver link' ),
			'view_item' => __( 'Ver este link' ),
			'search_items' => __( 'Buscar links' ),
			'not_found' => __( 'No se ha encontrado ningún link' ),
			'not_found_in_trash' => __( 'Ningún link en la papelera' ),
			'parent' => __( 'Superior' )
		),
		'taxonomies' => array('post_tag'),
		'has_archive' => true,
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'menu_position' => 5,
		//'menu_icon' => get_template_directory_uri() . '/images/icon-post.type-integrantes.png',
		'hierarchical' => false, // if true this post type will be as pages
		'query_var' => true,
		'supports' => array('title','author','trackbacks','comments' ),
		'rewrite' => array('slug'=>'link','with_front'=>false),
		'can_export' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
	));
}

// Show posts of 'post', 'link' post types on single pages
add_action( 'pre_get_posts', 'vb_add_custom_post_types_to_query' );
function vb_add_custom_post_types_to_query( $query ) {
	if ( is_single() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'link' ) );
	if ( is_page_template("page.link.php") )
		$query->set( 'posts_per_page', '50' );
	return $query;
}

/* Meta Box plugin CF registration */
add_filter( 'rwmb_meta_boxes', 'vb_register_meta_boxes' );
/**
* Register meta boxes
*
* Remember to change "your_prefix" to actual prefix in your project
*
* @param array $meta_boxes List of meta boxes
*
* @return array
*/
function vb_get_cf() {
	global $wpdb;
	
	$table_pm = $wpdb->prefix . "postmeta";
	$sql_query = "
		SELECT
		  pm.meta_value
		FROM $table_pm pm
		WHERE pm.meta_key = '_vb_year'
		ORDER BY pm.meta_value
	";
	$query_results = $wpdb->get_results( $sql_query , OBJECT_K );
	$options = array();
	foreach ( $query_results as $r ) {
		$options[$r->meta_value] = $r->meta_value;
	}
	return $options;
}

function vb_register_meta_boxes( $meta_boxes ) {
	/**
	* prefix of meta keys (optional)
	* Use underscore (_) at the beginning to make keys hidden
	* Alt.: You also can make prefix empty to disable it
	*/
	// Better has an underscore as last sign
	$prefix = '_vb_';

	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id' => 'testing',
		'title' => 'Testing box', // Meta box title - Will appear at the drag and drop handle bar. Required.	
		'post_types' => array( 'link' ), // Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'context' => 'side', // Where the meta box appear: normal (default), advanced, side. Optional.	
		'priority' => 'high',// Order of meta box: high (default), low. Optional.
		// Auto save: true, false (default). Optional.
		'autosave' => true,
		// List of meta fields
		'fields' => array(
//			array(
//				'name' => 'URL',
//				'id' => "{$prefix}testing_url",
//				'desc' => __( 'Text description', 'meta-box' ),
//				'type' => 'text',	
//				'std' => __( 'Default text value', 'meta-box' ),// Default value (optional)
//				'clone' => true,	// CLONES: Add to make the field cloneable (i.e. have multiple value)
	//			),
			// CHECKBOX LIST
			array(
				'name' => 'Years',
				'id' => "{$prefix}year",
				'type' => 'checkbox_list',
				// Options of checkboxes, in format 'value' => 'Label'
				'options' => vb_get_cf()
			),

		)
	);
	return $meta_boxes;
}

?>
