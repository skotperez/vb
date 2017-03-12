<?php $query_s = $wp_query->query_vars['s'];

if ( is_page_template('page.link.php') || is_singular('link') ) {
	$post_type = "link";
	$textencaja = "Buscar enlaces";
} else {
	$post_type = "post";
	$textencaja = "Buscar entradas";
}
if ( !empty($query_s) ) {
	$formclass = " class='current-s'";
	$textencaja = "Buscar otra vez";
	$message = "<div class='query-s'>Resultados para la b&uacute;squeda <strong>$query_s</strong></div>";
}

?>

<form method="get" id="searchform"<?php echo "$formclass" ?> action="<?php bloginfo('url'); ?>/">
	<label for="s"><i class="fa fa-search"></i> <?php echo $textencaja ?></label>
	<input type="text" value="" name="s" id="s"/>
	<input type="hidden" name="post_type" value="<?php echo $post_type ?>" />
	<!--<input type="submit" id="searchsubmit" value="Search" />-->
</form>

<?php if ( isset($message) ) { echo $message; } ?>
