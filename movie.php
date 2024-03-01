<?php 
include 'includes/head.php'; 
$rowID = $_GET['rowID']; 
$movie = $cinescuela->getPeliculas($rowID, 1, 1);
//echo $id."id";
?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php 
		include 'includes/header.php'; 
	?>
	<!--Fin Encabezado-->

	<!--Pelicula-->
	<article class="intern movie">
		<?php
		if(isset($_SESSION['logged'])){
		?>
		<a class="play_button" href="<?=$_GET['lang']?>/pelicula/<?=get_alias($movie->title->rendered)?>-<?=$movie->id?>/Play"><span><?=find_array($json, 47, $lang_ct)?></span></a>
		<? }?>
		<figure class="main_img" style="background-image:url(<?=$movie->acf->imagen_pelicula?>);">
        </figure>
		<div>
			<!--Trailer-->
            <?php 
            	$trailerSplit = explode("/",$movie->acf->url_trailer);
            	if(stripos($movie->acf->url_trailer, "vimeo"))
				{
					$urele = "http";
					if($_SERVER["HTTPS"] == "on"){ $urele.="s";}
					$urele .="://player.vimeo.com/video/".$trailerSplit[3];
				}else
				{
					$urele = "http";
					if($_SERVER["HTTPS"] == "on"){ $urele.="s";}
					$urele .="://www.youtube.com/embed/".$trailerSplit[3];
				}
			?>
			<a href="<?=$urele?>" class="v_trailer"><?=find_array($json, 48, $lang_ct)?></a>
			<!--Fin Trailer--><br>
			<ul class="info_movie">
				<!--<li class="ranking">
					<img src="images/site/y_rank_4.png" alt="ranking">
					<span><strong>30</strong> calificaciones</span>
				</li>-->
				<li class="main_info">
					<h2><?=$movie->title->rendered?></h2>
					<p><em><?=find_array($json, 49, $lang_ct)?> <strong><?=$movie->acf->director_pelicula?></strong></em></p>
					<ul>
						<li><?=$movie->acf->pais_pelicula?> <?=$movie->acf->ano_pelicula?></li>
						<li><?=$movie->acf->duracion_en_minutos?></li>
					</ul>
				</li>
				<li class="general_info">
					<p><?=$movie->content->rendered?></p>
				</li>
				<li>
					<div id="our_opinion">
						<h3><?=find_array($json, 51, $lang_ct)?></h3>
						<div>
							<?=$movie->acf->opinion?>
						</div>
					</div>
				</li>
			</ul><br>
			<?php 
			// Verifica si el usuario está autenticado y si la película tiene acompañamiento pedagógico
			if ((($_SESSION['logged']['cod_us'] > 0 || $_SESSION['logged']['cod_us'] != "") && $movie->acf->acompanamiento_pedagogico_privado == 1) || $movie->acf->acompanamiento_pedagogico_privado == 0 && $movie->acf->tiene_acompanamiento) { 
				// Establece el prefijo de la URL para los acompañamientos pedagógicos
				$urlPrefix = "acompanamientos-pedagogicos";
				// Sobrescribe el prefijo de la URL con "pedagogicos"
				$urlPrefix = "pedagogicos";
			?>
				<!-- Imprime un enlace con el título de la película y su ID de acompañamiento pedagógico -->
				<a href="<?=$urlPrefix?>/es/presentacion/<?=get_alias($movie->title->rendered)?>-<?=$rowID?>" target="_blank" class="a_peda">
					<!-- Reemplaza espacios con saltos de línea en el texto -->
					<?=str_replace(" ", "<br>", find_array($json, 52, $lang_ct))?>
				</a><br>
			<?php 
				} 
			?>
			<ul class="keywords">
<?php $tags = explode(',', $movie->acf->palabras_clave_de_esta_publicacion);
	for($i = 0 ; $i < count($tags) ; $i++){ ?>
				<li><?=$tags[$i]?></li>
<?php } ?>
			</ul><br>
			<ul class="shared">
				<li><a href="javascript:facebook_share('<?=currentURL()?>');" class="facebook">facebook</a></li>
				<li><a href="https://twitter.com/intent/tweet?text=<?=urlencode("Película ".$movie->title->rendered." en Cinescuela ".currentURL())?>" target="_BLANK" class="twitter">twitter</a></li>
				<li><a href="https://plus.google.com/share?url=<?=urlencode($movie->title->rendered." en Cinescuela ".currentURL())?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="googlemas">google +</a></li>
			</ul>
		</div>
		
	</article><!--Fin pelicula-->
	
	<!--lista peliculas relacionadas-->
	<section class="list_movies">	
		<h2><?=find_array($json, 53, $lang_ct)?></h2>
		<?php 
			for($i = 1;$i < 4;$i++){ 
			// $current_movie = "$movie"."->"."relac".$i."_film";
			// echo $current_movie;
			$rel_movie = $cinescuela->getPeliculas(strval($movie->acf->peliculas_relacionadas[$i]->ID));
			if($rel_movie->title->rendered!=""){
		?>
		<article>
			<a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($rel_movie->title->rendered)?>-<?=$rel_movie->id?>">
				<figure style="background-image:url(<?=$rel_movie->acf->imagen_pelicula?>);"></figure>
				<div>
					<h2><?=$rel_movie->title->rendered?></h2>
					<p><?=$rel_movie->acf->director_pelicula?></p>
				</div>
			</a>
		</article>
		<?php }} ?>
	</section><!--Fin lista peliculas relacionadas-->
	<!--Comentarios-->
	<section class="comments">
		<h2><?=find_array($json, 54, $lang_ct)?></h2>
		<div id="comments_container">
        	<fb:comments href="<?=currentURL()?>" numposts="5" width="100%"></fb:comments>
		</div>
	</section><!--Fin Comentarios-->

<?php include 'includes/footer.php'; ?>