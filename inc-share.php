			<div class="art-share">
				<div><strong class="art-meta-tit"><?php _e('Share','vb'); ?></strong></div>
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
