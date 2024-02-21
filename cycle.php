<?php include 'includes/head.php'; ?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->

	<!--ciclo-->
	<?php $cycle = $rows;
	// print_r($cycle);
	 ?>
	<article class="intern cycle">
		<figure class="main_img" style="background-image:url(<?=dev($cycle->img_cycle)?>);"></figure>
		<div>
			<time><? echo (''.$cycle->month_cycle.' '.$cycle->year_cycle)?></time>
			<h2><?=$cycle->tit_cycle?></h2><hr>
			<div class="desc">
				<?=$cycle->desc_cycle?>
			</div>
		</div>

		<!--Carrusel peliculas-->
		<div class="content_carousel">
			<h3><?=find_array($json,55, $lang_ct)?></h3>
			<?php 
			// $movies = explode(",", $cycle->films_cycle);
			$data_movies = $oreka->getRows($cycle->films_cycle);
			if (count($data_movies)>1) {?>
				<ul id="carousel_movies_cycle">
				<?php for($k=0;$k<count($data_movies);$k++){ $post = $data_movies[$k]->$lang; ?>
					<li><a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->tit_film)?>-<?=$post->rowID?>"><img src="<?=dev($post->thumb_film)?>" alt="<?=$post->tit_film?>" onClick="ga('send', 'event', 'Películas', 'click','slide peliculas - <?=$post->tit_film?>')"></a></li>
				<?php } ?>
			</ul><?php 
			}else{?>
				<li><a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($data_movies->$lang->tit_film)?>-<?=$data_movies->$lang->rowID?>"><img src="<?=dev($data_movies->$lang->thumb_film)?>" alt="<?=$data_movies->$lang->tit_film?>" onClick="ga('send', 'event', 'Películas', 'click','slide peliculas - <?=$data_movies->$lang->tit_film?>')"></a></li>
			<?php } ?>
		</div><!--Fin Carrusel peliculas-->
	</article><!--Fin ciclo-->

<?php include 'includes/footer.php'; ?>