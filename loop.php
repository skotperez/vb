<?php
// post vars
$post_type = get_post_type();
$post_format = get_post_format();
$post_perma = get_permalink();
$post_tit = get_the_title();
if ( $post_format != '' || $post_type == 'link' ) { $post_date_human = get_the_time('d\/m\/Y'); }
else { $post_date_human = get_the_time('d \d\e F \d\e Y'); }

$post_date = get_the_time('Y-m-d');
$u_time = get_the_time('U');
$u_modified_time = get_the_modified_time('U');
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="" itemtype="http://schema.org/BlogPosting">
<article>

	<?php if ( $post_type == 'link' ) {
		$link_url = get_post_meta( $post->ID, '_vb_metabox_link_url', true );
		$link_quote = get_post_meta( $post->ID, '_vb_metabox_link_quote', true );
		$link_quote_out = ( $link_quote != '' ) ? '<div class="art-quote"><div class="alignleft"><i class="fas fa-quote-left"></i></div>'.apply_filters('the_content',$link_quote).'</div>' : '';

		$h = ( is_single() ) ? "1" : "2";
		if ( is_single() ) { ?>
			<header class="link-header"><h1 class="link-tit entry-title" itemprop="name headline"><?php echo $post_tit ?></h1><a class="link-linkout" href="<?php echo $link_url ?>"><i class="fas fa-external-link-square-alt fa-lg"></i></a></header>
		<?php }
		else { ?>
			<header class="link-header"><h2 class="link-tit entry-title" itemprop="name headline"><a href="<?php echo $post_perma ?>"><?php echo $post_tit ?></a></h2><a class="link-linkout" href="<?php echo $link_url ?>"><i class="fas fa-external-link-square-alt fa-lg"></i></a></header>
		<?php } ?>
		<section>
			<div class="art-date">
				<div class='art-publisher' itemprop='publisher' itemscope itemtype='https://schema.org/Organization'>
	      				<div itemprop='logo' itemscope itemtype='https://schema.org/ImageObject'>
					<img src='<?php echo $blogtheme ?>/images/vb.imago.png' alt="Imago voragine.net" />
						<meta itemprop='url' content='<?php echo $blogtheme ?>/images/vb.imago.png' />
						<meta itemprop='width' content='27' />
						<meta itemprop='height' content='50' />
					</div>
					<meta itemprop='name' content='Voragine.net' />
				</div>
	
				<?php
				//echo "<a href='" .$post_perma. "'  title='Enlace permanente'>&infin;</a> &bull; ";
				echo "<a href='" .$post_perma. "'  title='Enlace permanente'><time class='published updated' datetime='$post_date' itemprop='datePublished'>" .$post_date_human. "</time></a> &bull; ";
				//the_tags('<span class="tags" itemprop="keywords">',', ','</span>');
				//the_taxonomies('<span class="tags" itemprop="keywords">',', ','</span>');
				$tags = get_the_terms($post->ID,'post_tag');
				if ( is_array($tags) ) {
					$tag_list = array();
					foreach ( $tags as $t ) {
						$tag_list[] = '<a rel="tag" href="/linkoteca?tag='.$t->slug.'">'.$t->name.'</a>';
					}
					$tag_list_out = join(", ",$tag_list);
					echo '<span class="tags" itemprop="keywords">'.$tag_list_out.'</span>';
				}
				if (is_single()) echo " &bull; Por <address itemscope itemprop='author' itemtype='http://schema.org/Person' class='author vcard'><span itemprop='name'><a itemprop='url' class='url fn' href='https://plus.google.com/u/0/116735119659908730533?rel=author'>Alfonso Sánchez Uzábal</a></span></address>";
				edit_post_link('Editar', ' &bull; ', ''); 
				?>
			</div>
			<?php echo $link_quote_out; ?>
		</section>
	<?php }
	else { // if is not link post type ?>

	<header>
	<?php //if ( $post_format == 'link' ) { } else {
		if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
			echo "<h2 class='art-tit entry-title' itemprop='name headline'><a href='$post_perma' title='Enlace permanente a $post_tit' rel='bookmark'>$post_tit</a></h2>";
		} else {
			echo "<h1 class='art-tit entry-title' itemprop='name headline'>$post_tit</h1>";
		} // end if home, archive, search
	//}
	if ( !is_page() ) { ?>

		<div class="art-date">
			<div class='art-publisher' itemprop='publisher' itemscope itemtype='https://schema.org/Organization'>
      				<div itemprop='logo' itemscope itemtype='https://schema.org/ImageObject'>
				<img src='<?php echo $blogtheme ?>/images/vb.imago.png' alt="Imago voragine.net" />
					<meta itemprop='url' content='".$blogtheme."/images/vb.imago.png' />
					<meta itemprop='width' content='27' />
					<meta itemprop='height' content='50' />
				</div>
				<meta itemprop='name' content='Voragine.net' />
			</div>

			<?php if ($u_modified_time >= $u_time + 86400) {
				if ( $post_format != '' ) { $post_modified_date_human = get_the_modified_time('d\/m\/Y'); }
				else { $post_modified_date_human = get_the_modified_time('d \d\e F \d\e Y'); }
				$post_modified_date = get_the_modified_time('Y-m-d');
				echo "<strong><time class='published' datetime='$post_date' itemprop='datePublished'>$post_date_human</time></strong> <span class='art-date-mod'>[actualizado el <time class='updated' datetime='$post_modified_date' itemprop='dateModified'>$post_modified_date_human</time>]</span>";
			} else {
				echo "<strong><time class='published updated' datetime='$post_date' itemprop='datePublished'>$post_date_human</time></strong>";
			} // end if modified data

			if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
				echo " &bull; Por
					<address itemscope='' itemprop='author' itemtype='http://schema.org/Person' class='author vcard'>
						<span itemprop='name'>
							<a itemprop='url' class='fn' href='https://plus.google.com/u/0/116735119659908730533?rel=author'>Alfonso Sánchez Uzábal</a>
						</span>
					</address>
				";
			}

			if ( $post_format == 'aside' || $post_format == 'link' ) {
				echo " &bull; <a href='" .$post_perma. "' title='" .$post_title. "' rel='bookmark'>Enlace permanente</a>";
			}
			edit_post_link('Editar', ' &bull; ', ''); ?>
		</div><!-- end class art-date -->
	</header>
	<?php } // end if not page ?>
<?php
$art_text_class = "art-text";
//// display all post thumbs with link to original size
//// this code will desapear
//$thumbs_class = "thumbs";
//if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
//
//	$args = array(
//		'post_type' => 'attachment',
//		'numberposts' => -1,
//		'post_status' => null,
//		'post_parent' => $post->ID
//	);
//	$img_out = "";
//	$attachments = get_posts($args);
//	if ( $attachments ) { // if there is anyone
//		$count = 0;
//		foreach ( $attachments as $attachment ) { // loop
//			$img_type = $attachment->post_mime_type;
//			if ( $img_type == 'image/png' || $img_type == 'image/jpeg' || $img_type == 'image/gif' ) {
//				$count++;
//				//$img_mini = wp_get_attachment_image_src($attachment->ID, array(90,90));
//				//$img_mini = wp_get_attachment_image($attachment->ID, 'thumbnail');
//				$img_mini = wp_get_attachment_link($attachment->ID, 'thumbnail',false);
//				//$img_medium = wp_get_attachment_image_src($attachment->ID, 'medium');
//				$img_out .= $img_mini;
//			}
//		}
//		if ( $count == '1' ) { $art_text_class = "art-text one-thumb"; $thumbs_class = "thumbs alignleft"; }
//		echo "
//			<div class='$thumbs_class'>
//				$img_out
//			</div><!-- end .thumbs -->
//		";
//	}
//
//} // end display all post thumbs ?>

		<?php if ( is_page() || is_single() && $post_format != 'link' || $post_format == 'quote' || $post_format == 'aside' || $post_format == 'video' ) { // if single, or is not standard format
			echo '<section itemprop="articleBody">
			<div class="' .$art_text_class. '">';
			the_content();
			wp_link_pages( array( 'before' => '<section><div class="art-nav">P&aacute;ginas: ', 'after' => '</div></section>' ) );
		} elseif ( $post_format == 'link' ) {
			echo '<section itemprop="articleBody">
			<div class="' .$art_text_class. '">';
			$link = wp_strip_all_tags(get_the_content()); ?>
			<strong><a href="<?php echo $link; ?>"><?php the_title(); ?></a></strong>. <?php the_excerpt_rss();?>
		<?php } else {
			echo '<section itemprop="description">
			<div class="' .$art_text_class. '">';
			the_excerpt_rss();
		} ?>
	</div><!-- end class art-text -->
	</section>

	<?php // meta info: contexto, author, share buttons, related posts
	if ( is_page() ) {
		// if page no meta info

	} else { ?>
	<section>
	<div class="art-meta">
		<?php // contexto: categories and tags ?>
		<div class="art-context">
			<div><strong class="art-meta-tit">Contexto</strong></div>
			<div class="art-keywords" itemprop="keywords">
			<?php $postcats = get_the_category(); $count = 0;
			foreach ( $postcats as $cat ) {
				if ( $cat->term_id != $brevesid ) {
					$count++;
					$cat_link = get_category_link( $cat->term_id );
					if ( $count == 1 ) { echo "<strong><a href='$cat_link'>$cat->name</a></strong>"; }
					else { echo ", <strong><a href='$cat_link'>$cat->name</a></strong>"; }
				}
			}
			the_tags(', <span class="tags">',', ','</span>'); ?>
			</div><!-- end class art-keywords -->
		</div><!-- end class art-context -->
		<?php // end contexto: categories and tags	

		if ( is_single() || is_page() ) {
			// author info
			$aut_nickname = get_the_author_meta('nickname');
			$aut_completename = get_the_author_meta('first_name'). " " .get_the_author_meta('last_name');
			// $aut_description = get_the_author_meta('description');
			echo "
			<div class='art-author'>
				<div><strong class='art-meta-tit'>Autor</strong></div>
				<div itemprop='author' itemscope='' itemtype='http://schema.org/Person'>
 			 	<address class='author vcard'><strong itemprop='name'><a class='url fn' href='https://plus.google.com/u/0/116735119659908730533?rel=author' itemprop='url' rel='author'>" .$aut_completename. "</a></strong></address>, aka <span itemprop='nickname'>" .$aut_nickname. "</span>
			 	</div>
			</div><!-- .art-author -->
			";
			// end author info

			// related posts
			$art_related = vb_related_posts('<strong class="art-meta-tit">Contenido relacionado</strong>');
			echo "
				<div class='art-related'>
					" .$art_related. "
				</div><!-- end .art-related -->
			";
			// end related posts

			// display twitter share button ?>
			<div class="art-share">
				<div><strong class="art-meta-tit">Compartir</strong></div>
				<ul class='linelist'>
					<?php // vars to share
					$post_perma_enc = urlencode($post_perma);
					$post_tit_enc = urlencode($post_tit);
					//$tw_share_url = "https://twitter.com/intent/tweet?original_referer=" .$post_perma_enc. "&text=" .$post_tit_enc. "&tw_p=tweetbutton&url=" .$post_perma_enc. "&via=" .$tw_user;
					$tw_share_url = "http://twitter.com/home?status=" .$post_tit_enc. " " .$post_perma_enc. " v/ @skotperez";
					$fb_share_url = "http://facebook.com/sharer.php?u=" .$post_perma_enc;
					$gplus_share_url = "https://plus.google.com/share?url=" .$post_perma_enc;
					?>
					<li><a href="<?php echo $tw_share_url?>" title="Compartir en Twitter" target="_blank"><i class="fab fa-twitter fa-2x"></i></a></li>
					<li><a href="<?php echo $fb_share_url ?>" title="Compartir en Facebook" target="_blank"><i class="fab fa-facebook fa-2x"></i></a></li>
					<li><a href="<?php echo $gplus_share_url ?>" title="Compartir en Google Plus" target="_blank"><i class="fab fa-google-plus fa-2x"></i></a></li>
				</ul><!-- end .linelist -->
			</div><!-- end .art-share -->
			
	<?php	} // end if single post ?>
	</div><!-- end .art-meta -->
	</section>

	<?php } // end if page
	// end meta info

	// leer mas link
	if ( $post_format != '' ) { // if post format is not standard
	} else {
		if ( is_home() || is_archive() || is_search() ) { // if home, archive, search
			echo "<div class='art-more'><a href='$post_perma' itemprop='url'>Leer el art&iacute;culo</a></div>";
		}
	}
	// end leer mas link ?>

	<?php } // end if link post type ?>

</article>
</div><!-- end class hentry -->

		<?php	//comments_popup_link('0&nbsp;comentarios', '1&nbsp;comentario', '%&nbsp;comentarios'); ?>
