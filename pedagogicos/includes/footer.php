	<!--Pie de pagina-->
	<footer id="page_footer">
		<!--Menu principal cinescuela-->
		<nav id="bottom_menu">
			<div>
				<h2><a href="../<?=$_GET['lang']?>/" target="_BLANK">Menu Principal</a></h2><button id="btn_menu">open menu</button><!--
		 --><ul>
				<li><a href="../<?=$_GET['lang']?>/cinescuela-10190" target="_BLANK">Cinescuela</a></li><!--
			 --><li><a class="active" href="../<?=$_GET['lang']?>/peliculas" target="_BLANK"><?=$json[2][$lang_j]?></a></li><!--
			 --><li><a href="../<?=$_GET['lang']?>/ciclos" target="_BLANK"><?=$json[4][$lang_j]?></a></li><!--
			 --><li><a href="../<?=$_GET['lang']?>/educacion" target="_BLANK"><?=$json[5][$lang_j]?></a></li><!--
			 --><li><a href="../<?=$_GET['lang']?>/actualidad" target="_BLANK"><?=$json[6][$lang_j]?></a></li>
			</ul>
			</div>
		</nav><!--Fin Menu principal cinescuela-->
	</footer><!--Fin Pie de pagina-->
</div><!--Fin Contenedor principal-->
</body>
</html>