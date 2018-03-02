<?php include("general-vars.php"); ?>

	</div><!-- end id content -->
	<hr />

	<?php if ( is_active_sidebar( 'vb_widget_footer' ) ) : ?>
		<footer id="epi" role="complementary">
			<?php dynamic_sidebar( 'vb_widget_footer' ); ?>
		</footer><!-- #epi -->
	<?php endif; ?>

<?php
// get number of queries
//echo "<div style='display: none;'>".get_num_queries()."</div>";
wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1405261-7', 'auto');
  ga('send', 'pageview');

</script>

</body><!-- end body as main container -->
</html>
