<?php include 'includes/header.php'; ?>

<!--Contenido general-->
<section id="main_container" class="presentacion">
	<h2 class="hidden">Presentación</h2>
	<!--Left-->
	<div class="c_left">
		<!--Notas profesor-->
		<section class="notas">
			<h2><?=$json[111][$lang_j]?></h2>
			<div class="general-scroll">
				<div class="desc">
					<?=$oreka->getByField($movie->rowID,"film_notes",3,1,1,"created","downward")[0]->es->notes_teach
					?>
				</div>
			</div>
		</section><!--Fin Notas profesor-->
	</div><!--Fin Left-->
	<!--Right-->
	<div class="c_right">
		<!--Acordion presentacion-->
		<section id="accordion">
			<h2><?=$json[112][$lang_j]?></h2>
			<div class="general-scroll">
				<div class="desc">
					<?=$movie->sinop_film?>
				</div>
			</div>
			<h2><?=$json[113][$lang_j]?></h2>
			<div class="general-scroll">
				<div class="desc">
					<?=$movie->ficha_film?>
				</div>
				<div class="media">
                <?
				$vinculo = $movie->trailer_film;
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
						<img src="<?=dev($movie->logo_film)?>" alt="<?=$movie->tit_film?>">
						<!--<figcaption>Logo alusivo</figcaption>-->
					</figure>
				 	<figure class="trailer" style="background-image:url(<?=dev($movie->thumbtr_film)?>);">
						<a href="<?=$urele.$videoCode?>" class="open_video" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Miniatura de trailer')">
							<img src="<?=dev($movie->thumbtr_film)?>" alt="Triler">
							<span class="figcaption">VER TRAILER</span>
						</a>
					</figure>
				</div>
			</div>
			<h2><?=$json[114][$lang_j]?> <em>(Acknowledgement)</em></h2>
			<div class="general-scroll">
				<div class="desc">
					<?=$movie->reco_film?>
				</div>
			</div>
		</section><!--Fin Acordion presentacion-->
		<!--Palabras clave-->
		<div class="keywords">
			<ul>
				<? $tags =$movie->keywords_film; 
				$arrT = explode(",",$tags);
				for($i=0;$i<count($arrT);$i++){
			?>
				<li><?=$arrT[$i]?></li>
				<? } ?>
			</ul>
		</div><!--Fin Palabras clave-->
	</div><!--Fin Right-->
</section><!--Fin Contenido general-->

<?php include 'includes/footer.php'; ?>