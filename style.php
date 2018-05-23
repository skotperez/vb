<?php // to tell the browser this is a CSS file
header("Content-type: text/css");

// random color code
//$hover_colors = array('f00','0f0','00f','f0f','ff0','0ff');
$hover_colors = array('f00','0f0','0ff');
$hover_colorkey = array_rand($hover_colors, 1);
$hover_color = $hover_colors[$hover_colorkey];
?>

#blogname a:link,
#blogname a:visited {
	color: #000;
}

a:hover,
#blogname a:hover,
.error-tit,
.art-tit a:hover,
.link-tit a:hover,
.art-meta a:hover,
.art-social-bt:hover,
#epi a:hover {
	color: <?php echo "#$hover_color" ?>;
}

.category #parts .blog,
.category #parts .blog a,
.single-post #parts .blog,
.single-post #parts .blog a,
.post-type-archive-link #parts .linkoteca,
.post-type-archive-link #parts .linkoteca a,
.page-template-page-link #parts .linkoteca,
.page-template-page-link #parts .linkoteca a,
.single-link #parts .linkoteca,
.single-link #parts .linkoteca a,
.vb-parts .current-menu-item,
.vb-parts .current-menu-item a,
.current-s a,
.current-cat a,
#pre-nav .current-menu-item a,
#pre-nav li a:hover,
.vb-lang a:hover,
.vb-lang .current-lang a,
.vb-parts li:hover,
.vb-parts li:hover a,
.page-numbers li a:hover,
.art-more a:hover,
.vb-bt a:hover,
#commentform fieldset .comment-boton:hover {
	/*background-color: <?php echo "#$hover_color" ?>;*/
	background-color: #000;
	color: #fff !important;
}
/*.art-context:before {
	background-color: #fff;
	color: #000;
}*/
.thumbs img:hover {
	border: 3px solid <?php echo "#$hover_color" ?>;
}
