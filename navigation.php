<?php 
global $wp_rewrite;			

$post_type = get_post_type();
if ( $post_type == 'link' && !is_search() )  {
	$the_query->query_vars['paged'] > 1 ? $current = $the_query->query_vars['paged'] : $current = 1;
	$total = $the_query->max_num_pages;
	$count_posts = $the_query->found_posts;
	$count_text = "enlaces";
} else {
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$total = $wp_query->max_num_pages;
	$count_posts = $wp_query->found_posts;
	$count_text = "artículos";
}

$pagination = array(
	'total' => $total,
	'current' => $current,
	'show_all' => false,
	'mid_size' => 3,
	'end_size' => 2,
	'prev_text' => __('«'),
	'next_text' => __('»'),
	'type' => 'list',
);

$url_raw = "http://" .$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url_raw = preg_replace('/\/page\/[0-9]*/','',$url_raw);
$pt_current = sanitize_text_field( $_GET['post_type'] );
if( $wp_rewrite->using_permalinks() )
	$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg(array('s','post_type'),$url_raw ) ) . "page/%#%/", 'paged');

if( !empty($wp_query->query_vars['s']) )
	$pagination['add_args'] = array('s'=>get_query_var('s'));

if( $pt_current != '' )
	$pagination['add_args'] = array('post_type'=>$pt_current);

echo "<div id='navega'><nav>";
echo paginate_links($pagination);
echo "<div class='nav-counter'>$count_posts $count_text</div>";
echo "</nav></div>";
?>
