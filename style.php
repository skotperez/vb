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

.current-s a,
.current-cat a,
#pre-nav li a:hover,
.vb-parts li a:hover,
.page-numbers li a:hover,
.art-more a:hover,
.vb-parts .active a,
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