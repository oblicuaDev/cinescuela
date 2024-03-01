<?php include 'includes/header.php'; ?>

<!--Contenido general-->
<section id="main_container" class="presentacion">
	<h2 class="hidden">Presentación TEST</h2>
	<!--Left-->
	<div class="c_left">
		<!--Notas profesor-->
		<section class="notas">
			<h2>NOTAS PARA EL PROFESOR</h2>
			<div class="general-scroll">
				<div class="desc">
					<?=$apedag->acf->notas_para_el_profesor?>
				</div>
			</div>
		</section><!--Fin Notas profesor-->
	</div><!--Fin Left-->
	<!--Right-->
	<div class="c_right">
		<!--Acordion presentacion-->
		<section id="accordion">
			<h2>SINOPSIS</h2>
			<div class="general-scroll">
				<div class="desc">
					<?=$apedag->acf->presentaciones->sinopsis?>
				</div>
			</div>
			<h2>FICHA TÉCNICA</h2>
			<div class="general-scroll">
				<div class="desc">
				<?=$apedag->acf->presentaciones->ficha_tecnica?>
				</div>
				<div class="media">
                <?
				$vinculo = $movie->acf->url_trailer;
				$trailerSplit = explode("/",$vinculo);
				$videoCode = end($trailerSplit);
				
				if(strpos($vinculo, "vimeo"))
				{
					$urele = "http";
					if($_SERVER["HTTPS"] == "on"){ $urele.="s";}
					$urele .="://player.vimeo.com/video/";
				}else
				{
					$urele = "http";
					if($_SERVER["HTTPS"] == "on"){ $urele.="s";}
					$urele .="://www.youtube.com/embed/";
				}
				?>
					<figure class="logo">
						<img src="<?=$movie->acf->logo_de_la_pelicula?>" alt="<?=$movie->title->rendered?>">
						<!--<figcaption>Logo alusivo</figcaption>-->
					</figure>
				 	<figure class="trailer" style="background-image:url(<?=$movie->acf->miniatura_del_trailer?>);">
						<a href="<?=$urele.$videoCode?>" class="open_video" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Miniatura de trailer')">
							<img src="<?=$movie->acf->miniatura_del_trailer?>" alt="Triler">
							<span class="figcaption">VER TRAILER</span>
						</a>
					</figure>
				</div>
			</div>
			<h2>RECONOCIMIENTOS</h2>
			<div class="general-scroll">
				<div class="desc">
				<?=$apedag->acf->presentaciones->reconocimientos?>
				</div>
			</div>
		</section><!--Fin Acordion presentacion-->
		<!--Palabras clave-->
		<div class="keywords">
			<ul>
				<? $tags =$apedag->acf->presentaciones->palabras_clave; 
				$arrT = explode(",",$tags);
				for($i=0;$i<count($arrT);$i++){
			?>
				<li><?=$arrT[$i]?></li>
				<? } ?>
			</ul>
		</div><!--Fin Palabras clave-->
	</div><!--Fin Right-->
</section><!--Fin Contenido general-->
</div><!--Fin Contenedor principal-->
</body>
</html>
<?php //include 'includes/footer.php'; ?>