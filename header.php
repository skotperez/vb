<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php include("general-vars.php"); ?>

<title>
<?php
	/* From twentyeleven theme
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'vb' ), max( $paged, $page ) );

	?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
// metatags generation
if ( is_single() || is_page() ) {
	$metadesc = $post->post_excerpt;
	if ( $metadesc == '' ) { $metadesc = $post->post_content; }
	$metadesc = wp_strip_all_tags($metadesc);
	$metadesc = strip_shortcodes($metadesc);
	$metadesc = str_replace(array("\"","'"),"",$metadesc);
	$metadesc_fb = substr( $metadesc, 0, 297 );
	$metadesc_tw = substr( $metadesc, 0, 200 );
	$metadesc = substr( $metadesc, 0, 154 );
	$metatit = $post->post_title;
	$metatit = str_replace(array("\"","'"),"",$metatit);
	$metatype = "article";
	$metatype_tw = ( has_post_thumbnail() ) ? "summary_large_image" : "summary";
	$metaperma = get_permalink();

} elseif ( is_category() ) {
	$term =	$wp_query->queried_object;
	$metadesc = $term->description;
	$metadesc_fb = substr( $metadesc, 0, 297 );
	$metadesc_tw = substr( $metadesc, 0, 200 );
	$metatit = $term->name;
	$metatype = "blog";
	$metatype_tw = "summary";
	$metaperma = "https://voragine.net/archivo/".$term->slug;

} elseif ( is_tag() ) {
	$term =	$wp_query->queried_object;
	$metadesc = "Contenidos en voragine.net con la etiqueta ".$term->name;
	$metadesc_fb = substr( $metadesc, 0, 297 );
	$metadesc_tw = substr( $metadesc, 0, 200 );
	$metatit = $term->name;
	$metatype = "blog";
	$metatype_tw = "summary";
	$metaperma = "https://voragine.net/etiquetas/".$term->slug;

} else {
	$metadesc = "Blog de Alfonso Sánchez Uzábal, skotperez, activo desde 2007: internet distribuido y neutral, software libre, desarrollo web, mucho WordPress.";
	$metadesc_tw = $site_description;
	$metadesc_fb = $site_description;
	$metatit = "Autonomía digital y tecnológica";
	$metatype = "blog";
	$metatype_tw = "summary";
	$metaperma = "https://voragine.net";
}
?>

<!-- generic meta -->
<meta content="Alfonso Sánchez Uzábal" name="author" />
<meta content="<?php echo $metadesc ?>" name="description" />
<meta content="software libre, free software, open source software, software de codigo abierto, datos libres, open data, wordpress, desarrollo web, HTML5, processing, Linux, Debian" name="keywords" />
<!-- facebook meta -->
<meta property="og:title" content="<?php echo $metatit ?>" />
<meta property="og:type" content="<?php echo $metatype ?>" />
<meta property="og:description" content="<?php echo $metadesc_fb ?>" />
<meta property="og:url" content="<?php echo $metaperma ?>" />
<!-- twitter meta -->
<meta name="twitter:card" content="<?php echo $metatype_tw ?>" />
<meta name="twitter:site" content="@skotperez">
<meta name="twitter:title" content="<?php echo $metatit ?>" />
<meta name="twitter:description" content="<?php echo $metadesc_tw ?>" />
<meta name="twitter:creator" content="@skotperez">

<meta property="twitter:account_id" content="1491442110" />

<link rel="author" href="https://plus.google.com/116735119659908730533"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo "$blogtheme/style.php" ?>" type="text/css" media="screen" />
<style>
@import 'https://fonts.googleapis.com/css?family=Merriweather:300,300i,700,700i|Libre+Franklin:100,200,300';
</style>

<link rel="alternate" type="application/rss+xml" title="<?php echo $blogname; ?> RSS Feed suscription" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php echo $blogname; ?> Atom Feed suscription" href="<?php bloginfo('atom_url'); ?>" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link type="image/x-icon" href="<?php echo $blogurl ?>/favicon.ico" rel="shortcut icon" />
<link type="image/png" sizes="256x256" href="<?php echo $blogurl ?>/favicon.png" rel="icon" />
<link href="<?php echo $blogurl ?>/icon-touch.png" rel="apple-touch-icon-precomposed" />

<!--[if IE 6 | IE 7 | IE 8]>
	<script src="<?php echo "$blogtheme/js/html5.js" ?>" type="text/javascript">
	</script>
<![endif]-->

<?php
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head(); ?>

</head>

<?php // better to use body tag as the main container ?>
<body <?php body_class(); ?>>

	<div id="pre">
		<header>
		<?php
		if ( function_exists('pll_the_languages') ) {
			$args = array(
				'hide_if_no_translation' => 0
			);
			echo '<nav id="vb-lang"><ul class="vb-lang">'; pll_the_languages($args); echo '</ul></nav>';
		}
		?>
		<img class="logo" src="<?php echo $blogtheme?>/images/vb.imago.png" alt="Imago voragine.net" />

			<?php // to display a banner on the top of the header
				//$banner = "<div id='banner'><img src='$blogtheme/images/500-cabera-07.png' alt='15 de octubre' /></div>";
				//echo $banner;
			$h = ( is_single() || is_page() ) ? "2" : "1"; ?>
				<h<?php echo $h; ?> id="blogname"><?php echo "<a href='$blogurl' title='Ir al inicio'>$blogname</a>"; ?></h<?php echo $h; ?>>
				<div id="blogdesc"><?php echo $blogdesc; ?></div>
			<?php
			$location = "primary";
			if ( has_nav_menu( $location ) ) {
				$args = array(
					'theme_location'  => $location,
					'container' => false,
					'menu_id' => 'parts',
					'menu_class' => 'vb-parts'
				);
				echo '<nav>';
				wp_nav_menu( $args );
				echo '</nav>';
			}

			$pt = ( array_key_exists('post_type',$_GET) ) ? sanitize_text_field($_GET['post_type']) : '';
			if ( is_page_template("page.link.php" ) || is_search() && $pt == 'link' ) {
				$perma = get_permalink();
				if ( array_key_exists('tags',$_GET) ) {
					$tags_count = sanitize_text_field($_GET['tags']);
					$tags_orderby = 'name';
					$tags_order = 'ASC';
					$tit = __('Linkoteca. Contexts','vb');
					$all_tags_out = '';
				} elseif ( array_key_exists('tag',$_GET) ) {
					$tags_count = '50';
					$tags_orderby = 'count';
					$tags_order = 'DESC';
					$tag = sanitize_text_field($_GET['tag']);
					$tag_data = get_term_by('slug',$tag,'post_tag');
					$tit = 'Linkoteca. '.$tag_data->name;
					$all_tags_out = '<li class="all-tags"><a href="'.$perma.'?tags=0"><i class="fa fa-hashtag"></i> '.__('All tags','vb').'</a></li>';
				} elseif ( is_search() ) {
					$query_s = $wp_query->query_vars['s'];
					$tags_count = '50';
					$tags_orderby = 'count';
					$tags_order = 'DESC';
					$tit = strintf(__('Linkoteca. Search results under ""%s"','vb'), $query_s);
					$all_tags_out = '<li class="all-tags"><a href="'.$perma.'?tags=0"><i class="fa fa-hashtag"></i> '.__('All tags','vb').'</a></li>';
				} else {
					$tags_count = '50';
					$tags_orderby = 'count';
					$tags_order = 'DESC';
					$tit = get_the_title();
					$all_tags_out = '<li class="all-tags"><a href="'.$perma.'?tags=0"><i class="fa fa-hashtag"></i> '.__('All tags','vb').'</a></li>';
				}
				if ( $paged >= 2 || $page >= 2 )
					$tit .= '. ' . sprintf( __( 'Page %s', 'vb' ), max( $paged, $page ) );


				$terms = get_terms( array(
					'taxonomy' => 'post_tag',
			        	'hide_empty' => true,
			        	'orderby' => $tags_orderby,
			        	'order' => $tags_order,
			        	'number' => $tags_count
				)); 
				echo '<h1 class="vb-parts-desc">'.$tit.'</h1>';

				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					echo '<div id="tag-list" class="simple-input">
						<label for="tag-filter"><i class="fa fa-filter"></i> '.__('Filter tags','vb').'</label>
						<input name="tag-filter" type="text" class="search" />
						<ul class="tag-list list">';
					echo $all_tags_out;
					foreach ( $terms as $t ) {
						$t_link = '?tag='.$t->slug;
						echo '<li><a class="name" href=/linkoteca'.$t_link.'>'.$t->name.'</a></li>';
					}
					echo '</ul></div>';
				}
			}
			elseif ( is_singular('link') ) {
				echo '<h2 class="vb-parts-desc">'.__('Linkoteca. Navigation archive','vb').'</h1>';
			}
			else {
				$location = "secondary";
				if ( has_nav_menu( $location ) ) {
					$args = array(
						'theme_location'  => $location,
						'container' => false,
						'menu_id' => 'pre-nav',
					);
					echo '<nav>';
					wp_nav_menu( $args );
					echo '</nav>';
				}
			}
			?>

			<?php if ( !array_key_exists('tags',$_GET) ) { ?>
				<div id="busca">
					<?php include "searchform.php"; ?>
				</div>
			<?php } ?>
		</header>

	</div><!-- end id pre -->

	<hr />
	<div id="content">
