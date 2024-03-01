<?php include 'includes/head.php'; ?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; 
	$cycle = $cinescuela->getCiclos($_GET['cycleID']);
	?><!--Fin Encabezado-->
	<article class="intern cycle">
		<figure class="main_img" style="background-image:url(<?=$cycle->acf->imagen_principal_el_ciclo?>);"></figure>
		<div>
			<time><? echo (''.$cycle->acf->mes_del_ciclo.' '.$cycle->acf->ano_del_ciclo)?></time>
			<h2><?=$cycle->title->rendered?></h2><hr>
			<div class="desc">
				<?=$cycle->content->rendered?>
			</div>
		</div>

		<!--Carrusel peliculas-->
		<div class="content_carousel">
			<h3><?=find_array($json,55, $lang_ct)?></h3>
			<?php 
			$cycle->acf->peliculas_del_ciclo = array_map('strval', $cycle->acf->peliculas_del_ciclo);
			$data_movies = $cinescuela->getPeliculas($cycle->acf->peliculas_del_ciclo);
			if (count($data_movies)>1) {?>
				<ul id="carousel_movies_cycle">
				<?php for($k=0;$k<count($data_movies);$k++){ $post = $data_movies[$k]['response']; ?>
					<li><a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->title->rendered)?>-<?=$post->id?>"><img src="<?=$post->acf->afiche?>" alt="<?=$post->title->rendered?>" onClick="ga('send', 'event', 'Películas', 'click','slide peliculas - <?=$post->title->rendered?>')"></a></li>
				<?php } ?>
			</ul><?php 
			}else{?>
				<li><a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($data_movies->title->rendered)?>-<?=$data_movies->id?>"><img src="<?=$data_movies->acf->afiche?>" alt="<?=$data_movies->title->rendered?>" onClick="ga('send', 'event', 'Películas', 'click','slide peliculas - <?=$data_movies->title->rendered?>')"></a></li>
			<?php } ?>
		</div><!--Fin Carrusel peliculas-->
	</article><!--Fin ciclo-->

<?php include 'includes/footer.php'; ?>