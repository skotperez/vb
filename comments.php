<?php // Do not delete these lines
if ( isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
	die ('Please do not load this page directly. Thanks!<br />Por favor, no intentes acceder a esta p&aacute;gina directamente. Gracias.');
?>

<?php if ( comments_open() || have_comments() ) { ?>
<div id="comments">

	<?php if ( post_password_required() ) :
		echo '<p class="nopassword">Esta entrada está protegida con contraseña. Introduce la contraseá para leer los comentarios.</p>
		</div><!-- end id comments -->';
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;

	if ( have_comments() ) : ?>
		<h2 class="comments-tit"><?php human_comment_count();?></h2>

		<ol class="comments-list">
			<?php // human comments list
			 wp_list_comments( array(
				'style' => 'ol',
				'type' => 'comment',
				'avatar_size' => 64,
				'reply_text' => 'responder a este comentario',
				'login_text' => 'iniciar sesión para comentar',
				'callback' => 'vb_comment'
			 ) );
			?>
		</ol><!-- end class comments-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comments-nav">
			<div class="nav-previous"><?php previous_comments_link('Comentarios anteriores'); ?></div>
			<div class="nav-next"><?php next_comments_link('Comentarios'); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	<?php else : // this is displayed if there are no comments so far

		if ('open' == $post->comment_status) { // If comments are open, but there are no comments
			$comment_message = 'No hay comentarios en esta entrada.';
		} else { // comments are closed 
			$comment_message = 'Los comentarios est&aacute;n cerrados en esta entrada.';
		}
	endif; // end have_comments()

	//comment_form();
	// comment form
	if ( comments_open() ) { // to comment is enabled ?>
		<div id="respond">
			<div id="cancel-comment-reply">
				<?php cancel_comment_reply_link("&times;"); ?>
			</div>

			<h2 class="comments-tit"><?php comment_form_title( 'Dejar un comentario', 'Responder al comentario de %s' ); ?></h2>
			<div class="nocomments"><?php echo $comment_message ?></div>

			<?php if(get_option('comment_registration') && !$user_ID) { // registration needed ?>
				<p>Debes <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">iniciar sesi&oacute;n</a> para comentar.</p>

			<?php } else { // registration don't needed ?>

				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if($user_ID) { // user is logged in ?>
					<fieldset>Sesi&oacute;n iniciada como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Cerrar sesi&oacute;n</a></fieldset>

				<?php } else { // user is not logged in ?>
					<fieldset>
						<?php if($req) echo "<span class='req'>*</span>"; ?>
						<label for="author">Nombre</label>
						<input type="text" name="author" id="author" value="" size="22" tabindex="1" />  
					</fieldset>
					<fieldset>
						<?php if($req) echo "<span class='req'>*</span>"; ?>
						<label for="email">E-mail (no se publicará) </label>
						<input type="text" name="email" id="email" size="22" tabindex="2" value="" />
					</fieldset>
					<fieldset>
						<label for="url">Sitio web</label>
						<input type="text" name="url" id="url" size="22" tabindex="3" value="" />
					</fieldset>

				<?php } // end log in sentence ?>

				<fieldset>
<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />
					<?php comment_id_fields(); ?>
					<label for="comment">Comentario</label>
					<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea>
				</fieldset>  
				<fieldset>
					<input class="comment-boton" name="submit" type="submit" id="submit" tabindex="5" value="Enviar comentario" />
					<!--<input type="hidden" name="comment_post_ID" value="<?php //echo $id; ?>" />-->
				</fieldset>  
				<?php do_action('comment_form', $post->ID); ?>
			</form></div>
		<?php } // end registration need sentence ?>

	<?php } else { // to comment is not enabled ?>

	<?php } // end to comment enabled sentence 
	// end comment form ?>


</div><!-- end id comments -->
<?php } ?>

<?php if ( pings_open() ) { ?>
<div id="pingbacks">
	<h2 class="pings-tit"><?php trackback_count(); ?></h2>
	<ul class="pings-list">
	<?php // pings list
	 wp_list_comments( array(
		'style' => 'ul',
		'type' => 'pings',
//		'avatar_size' => 64,
//		'reply_text' => 'responder a este comentario',
//		'login_text' => 'iniciar sesión para comentar',
		'callback' => 'vb_comment'
	 ) );
	?>
	</ul>
</div><!-- end id pingbacks -->
<?php } ?>
