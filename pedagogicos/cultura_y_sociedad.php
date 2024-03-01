<?php include 'includes/head.php'; ?>
<?php include 'includes/header.php'; ?>

<!--Contenido general-->
<section id="main_container" class="cultura">
	<h2 class="hidden">Cultura y sociedad</h2>
	<!--Listado-->
	<div class="general-scroll">
		<div id="list_container">
			<?php for ($i=1; $i <count() ; $i++) { ?>
			<article class="item">
				<ul class="tipo">
					<li><a href="#" class="t_video" title="Video">Video</a></li>
					<li><a href="#" class="t_audio" title="Audio">Audio</a></li>
					<li><a href="infografia.php" class="t_imagen" title="Fotografía">Imagen</a></li>
					<li><a href="#" class="t_cartilla" title="Cartilla">Cartilla</a></li>
					<li><a href="#" class="t_estadistica" title="Estadisticas">Estadistica</a></li>
				</ul>
				<figure>
					<img src="images/prueba/art_<?php echo $i; ?>.jpg" alt="Imagen articulo">
				</figure>
				<h2>TÍTULO DE LA PUBLICACIÓN LOREM IPSUM DOLOR</h2>
				<div class="desc">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non augue at elit consequat tristique venenatis at ipsum.</p>
				</div>
			</article>
			<?php } ?>
		</div>
	</div><!--Fin Listado-->
	<!--Menu Listado-->
	<div class="cont_list">
		<button id="o_post_list">Ver Listado<span></span></button>
		<div id="post_list">
			<ul>
			<?php for ($n=0; $n <2 ; $n++) { ?>
				<li>
					<span class="i_list">Lorem ipsum dolor sit amet</span>
					<ul>
						<li><a href="#" class="t_video">Video</a></li>
						<li><a href="#" class="t_audio">Audio</a></li>
						<li><a href="#" class="t_imagen">Imagen</a></li>
						<li><a href="#" class="t_cartilla">Cartilla</a></li>
						<li><a href="#" class="t_estadistica">Estadistica</a></li>
					</ul>
				</li>
				<li><span class="i_list">Lorem ipsum dolor sit amet</span></li>
				<li><span class="i_list">LoConsectetur adipiscing elit</span></li>
				<li><span class="i_list">Vestibulum ante quis, malesuada</span></li>
				<li><span class="i_list">Lorem ipsum dolor sit amet</span></li>
			<?php } ?>
			</ul>
		</div>
	</div><!--Fin Menu Listado-->
</section><!--Fin Contenido general-->

<?php include 'includes/footer.php'; ?>