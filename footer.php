<?php include("general-vars.php"); ?>

	</div><!-- end id content -->
	<hr />

	<div id="epi">
	<footer>
		<?php
//		$projects_list = array(
//			'title_li' => '',
//			'echo' => 0,
//			'category' => 38,
//			'categorize' => 0,
//		);
//		$projects = wp_list_bookmarks($projects_list);
//		$links_list = array(
//			'title_li' => '',
//			'echo' => 0,
//			'category' => 102,
//			'categorize' => 0,
//		);
//		$links = wp_list_bookmarks($links_list);

		$epi_blog = "
			<div class='epi-col3'>
				<h2 id='about'>Sobre este blog</h2>
				<img class='logo' src='". $blogtheme."/images/vb.imago.png' alt='Imago voragine.net' />
				<p><strong><a href='".$blogurl."'>Autonomía digital y tecnológica</a></strong> es el blog de Alfonso Sánchez Uzábal (aka skotperez) desde 2007. En él encontrarás trozos de código en diferentes lenguajes de programación (<a href='http://en.wikipedia.org/wiki/Snippet_(programming)' title='Snippets -- Wikipedia'>snippets</a>), reflexiones sobre <a href='/archivo/autonomia-digital-2' title='Autonomía digital -- voragine.net'>autonomía digital y tecnológica</a>, <a href='/archivo/linux' title='Software libre, GNU/Linux -- voragine.net'>software libre</a> y <a href='/archivo/cultura-libre/'>cultura libre</a> en general. Los textos están disponibes bajo <a href='http://voragine.net/licencia-de-contenidos' title='Licencia de contenidos'>Creative Commons</a>, y el código bajo <a href='http://www.gnu.org/copyleft/gpl.html' title='GNU General Public License -- Free Software Foundation'>GPL</a>.</p>
			</div>
		";
		$epi_author = "
			<div class='epi-col3'>
				<figure class='alignleft'><img src='".$blogtheme."/images/alfonso.sanchez.uzabal.jpg' alt='Alfonso Sánchez Uźabal' /><figcaption>Foto: <a href='http://cecilehuet.com/'>Cécile Huet</a></figcaption></figure>
				<address><strong><a href='http://skotperez.net'>Alfonso Sánchez Uzábal</a></strong></address>
<ul class='linelist'>
				<li><a href='https://twitter.com/skotperez' title='@skotperez en Twitter'><i class='fab fa-twitter fa-2x'></i></a></li>
				<li><a href='https://plus.google.com/116735119659908730533' title='+skotperez en Google Plus'><i class='fab fa-google-plus fa-2x'></i></a></li>
				<li><a href='https://github.com/skotperez' title='skotperez en GitHub'><i class='fab fa-github fa-2x'></i></a></li>
				<li><a href='https://instagram.com/skotperez' title='skotperez en Instagram'><i class='fab fa-instagram fa-2x'></i></a></li>
				<li><a href='https://social.coop/@skotperez' title='@skotperez en Mastodon'><i class='far fa-circle fa-2x'></i></a></li>

</ul>
<p>Desarrollador de software libre en <a href='https://montera34.com'>Montera34</a>, estudio de desarrollo web que puso en marcha en 2004 junto a compañeros de la Escuela Técnica Superior de Arquitectura de Madrid, donde estudió arquitectura.</p>
<p>Mientras estudiaba arquitectura trabajó como corrector y editor de textos, webmaster y administrador de la red GNU/Linux en la <a href='http://habitat.aq.upm.es'>Biblioteca Ciudades para un Futuro más Sostenible</a>.</p>
<p>Interesado en el potencial de los ecosistemas de colaboración libres y las cartografías digitales ciudadanas, en 2007 lanza con otros arquitectos y programadores <a href='http://meipi.org'>Meipi</a>, plataforma para la creación de espacios colaborativos georreferenciados.</p>
<p>En 2007 crea con unos amigos <a href='http://obsoletos.org'>Obsoletos</a> un proyecto de investigación, creación y difusión de sistemas creativos de transformación de residuos tecnológicos; es decir, un espacio para el \"cacharreo\" y el hackeo en grupo.</p>
<p>Es miembro fundador de <a href='http://lab.place'>Lab Place</a>, un espacio de fabricación digital, de experimentación y aprendizaje colectivo en Oust, un pueblo del Pirineo francés, donde vive.</p>
<p>Forma parte del colectivo 15muebles con el que ha puesto en marcha la plataforma <a href='http://ciudad-escuela.org'>Ciudad Escuela</a> para el reconocimiento de aprendizajes informales en proyectos urbanos comunitarios usando la infraestructura libre Openbadges.</p>
<p>Investiga sobre la repercusión del uso de software y tecnologías libres en proyectos y procesos colectivos. En 2013 participó en el libro <em>Ciberoptimismo, conectados a una actitud</em> con el artículo <a href='https://voragine.net/cultura-libre/logica-distribuida-para-la-autoorganizacion-ciudadana'>Lógica distribuida para la autoorganización ciudadana</a>.</p>
			</div>
		";

//		$epi_center = "
//			<nav class='epi-col'>
//				<h2>Proyectos</h2>
//				<ul>
//					$projects
//				</ul>
//			</nav>
//		";
//		$epi_right = "
//			<nav class='epi-col'>
//				<h2>Red</h2>
//				<ul>
//					$links
//				</ul>
//			</nav>
//		";
//		$epi_right = "
//			<nav class='epi-col3'>
//				<h2>Red</h2>
//		<div id='widget-2011'></div>
//<script src='http://2011.pro/widget/2011.widget.js'></script>
//			</nav>
//		";

		echo $epi_blog;
//		echo $epi_projects;
//		echo $epi_links;
		echo $epi_author;
		?>
	</footer>
	</div>

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
