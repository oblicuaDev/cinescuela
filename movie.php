<?php include 'includes/head.php'; $rowID = $_GET['rowID']; $movie = $rows; 
//echo $rowID."rowid";
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
		$disponibles=$oreka->getRows($_SESSION['logged']['cod_us'])->$lang->films_user;
		$disponibles_array=explode(",", $disponibles);
		$search=array_search(intval($rowID) ,$disponibles_array);
		if(is_numeric($search)){
		?>
		<a class="play_button" href="<?=$_GET['lang']?>/pelicula/<?=get_alias($movie->tit_film)?>-<?=$movie->rowID?>/Play"><span><?=find_array($json, 47, $lang_ct)?></span></a>
		<? }?>
		<figure class="main_img" style="background-image:url(<?=dev($movie->img_film)?>);">
        </figure>
		<div>
			<!--Trailer-->
            <?php 
            	$trailerSplit = explode("/",$movie->trailer_film);
            	if(stripos($movie->trailer_film, "vimeo"))
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
					<h2><?=$movie->tit_film?></h2>
					<p><em><?=find_array($json, 49, $lang_ct)?> <strong><?=$movie->direct_film?></strong></em></p>
					<ul>
						<li><?=$movie->country_film?> <?=$movie->year_film?></li>
						<li><?=$movie->duration_film?></li>
					</ul>
				</li>
				<li class="general_info">
					<p><?=$movie->desc_film?></p>
				</li>
				<li>
					<div id="our_opinion">
						<h3><?=find_array($json, 51, $lang_ct)?></h3>
						<div>
							<?=$movie->opinion_film?>
						</div>
					</div>
				</li>
			</ul><br>
<?php if( ((($_SESSION['logged']['cod_us']>0 || $_SESSION['logged']['cod_us'] !="") && $movie->private_notice==1) || $movie->private_notice==0) && $movie->ac_film){ ?>
            
            <?php 
            
            $urlPrefix = "acompanamientos-pedagogicos";
            $pedagID = $movie->rowID;
            $newpedag = $oreka->getByMultipleField($movie->rowID.",1","movie_prest,".$_GET['lang']."_prest","3,3", 1, 1,'lord', 'upward'); 
           // print_r($newpedag);
            if(is_array($newpedag)){
                $urlPrefix = "pedagogicos";
                $pedagID = $newpedag[0]->es->rowID;
            }
    
            ?>
				<a href="<?=$urlPrefix?>/es/presentacion/<?=get_alias($movie->tit_film)?>-<?=$pedagID?>" target="_blank" class="a_peda"><?=str_replace(" ", "<br>", find_array($json, 52, $lang_ct))?></a><br>
<?php } ?>
			<ul class="keywords">
<?php $tags = explode(',', $movie->keywords_film);
	for($i = 0 ; $i < count($tags) ; $i++){ ?>
				<li><?=$tags[$i]?></li>
<?php } ?>
			</ul><br>
			<ul class="shared">
				<li><a href="javascript:facebook_share('<?=currentURL()?>');" class="facebook">facebook</a></li>
				<li><a href="https://twitter.com/intent/tweet?text=<?=urlencode("Película ".$movie->tit_film." en Cinescuela ".currentURL())?>" target="_BLANK" class="twitter">twitter</a></li>
				<li><a href="https://plus.google.com/share?url=<?=urlencode($movie->tit_film." en Cinescuela ".currentURL())?>" onclick="javascript:window.open(this.href,
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
			$rel_movie = $oreka->getRows($movie->{"relac".$i."_film"})->$lang;
			if($rel_movie->tit_film!=""){
		?>
		<article>
			<a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($rel_movie->tit_film)?>-<?=$rel_movie->rowID?>">
				<figure style="background-image:url(<?=dev($rel_movie->img_film)?>);"></figure>
				<div>
					<h2><?=$rel_movie->tit_film?></h2>
					<p><?=$rel_movie->direct_film?></p>
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