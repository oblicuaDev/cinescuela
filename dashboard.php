<?php include 'includes/head.php'; 
if(!isset($_SESSION['logged']['cod_us']) || $_SESSION['logged']['cod_us']==""){?>
<script>location.href="<?=$_GET['lang']?>/";</script>
<?php } ?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->

	<!--Panel-->
	<section class="dashboard">
		<div class="title">
			<h2><?=find_array($json,72, $lang_ct)?></h2>
			<?php $profile=$oreka->getRows($_SESSION['logged']['pro_us'])->$lang; 
			$user=$oreka->getRows($_SESSION['logged']['cod_us'])->$lang;?>
			<ul>
				<li><?=$_SESSION['logged']['usu_us']?></li>
				<li> <?=$profile->name_perfil?> - <? echo $_SERVER["REMOTE_ADDR"];?></li>
			</ul>
			<a href="<?=$_GET['lang']?>/subir-pelicula" class="upload"><?=find_array($json,73, $lang_ct)?></a>
		</div>

		<!--Publicidad-->
		<aside>
			<h2><?=find_array($json,90, $lang_ct)?></h2>
			<ul>
            <? $mes = $oreka->getByField($_SESSION['logged']['region_us'],"region_advertising",3,5,1,"lord","upward");
            if(is_array($mes)){
            for($k=0;$k<count($mes);$k++){ $post = $mes[$k]->$lang; ?>
				<li><a href="<?=$post->link_advertising;?>" target="_blank"><img src="<?=dev($post->img_advertising)?>" alt="<?=$post->tit_advertising?>"></a></li>
			<? } } ?>
			</ul>
        
		</aside>
		<!--Fin Publicidad-->

		<!--Peliculas disponibles-->
		<section class="disp">
			<h2><span id="dash_cycles"><?=find_array($json,102, $lang_ct)?></span> / <span id="dash_films"><?=find_array($json,74, $lang_ct)?></span></h2>
			<div class="scroll-bar-one">
			<?php 
			$disponibles=$user->cycles_user;
			$disponibles= str_replace(",,", ",", $disponibles);
			$discycles = explode(",",$disponibles);
			$allCycles = $oreka->getCollection(6,"lord","upward",0,1);
			
			for ($i=0; $i < count($allCycles); $i++) { 
				for ($j=0; $j < count($discycles); $j++) { 
					if ($discycles[$j] == $allCycles[$i]->{'es'}->rowID) {?>
						<article class="dash_cycle">
							<figure style="background-image:url(<?=dev($allCycles[$i]->{'es'}->img_cycle)?>);"></figure>
							<div>
								<h2><a href="<?=$_GET['lang']?>/ciclo/<?=get_alias($allCycles[$i]->{'es'}->tit_cycle)?>-<?=$allCycles[$i]->{'es'}->rowID?>" target="_blank"><?=$allCycles[$i]->{'es'}->tit_cycle?></a></h2>
								<p><?=$allCycles[$i]->{'es'}->month_cycle?> <?=$allCycles[$i]->{'es'}->year_cycle?></p>
							</div>
						</article>	
				<?php }
				}
			}

			// $cycles=$oreka->getRows($disponibles);
			// if(!is_array($cycles)){
			// 	$cycles=array($cycles);
			// }
			// for($i=0;$i<count($cycles);$i++){ $post=$cycles[$i]->$lang;?>
				<!-- <article class="dash_cycle"> -->
					<!-- <figure style="background-image:url(<?=dev($post->img_cycle)?>);"></figure> -->
					<!-- <div>
						<h2><a href="<?=$_GET['lang']?>/ciclo/<?=get_alias($post->tit_cycle)?>-<?=$post->rowID?>" target="_blank"><?=$post->tit_cycle?></a></h2>
						<p><?=$post->month_cycle?> <?=$post->year_cycle?></p>
					</div> -->
				</article>
			<? //}
			
			$disponibles=$user->films_user;
			$disponibles=str_replace(",,", ",", $disponibles);
			$movies=$oreka->getRows($disponibles);
			if(!is_array($movies)){
				$movies=array($movies);
			}
			for($i=0;$i<count($movies);$i++){ $post=$movies[$i]->$lang;?>
				<article class="dash_film" style="display: none;">
					<figure style="background-image:url(<?=dev($post->img_film)?>);"></figure>
					<div>
						<h2><a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->tit_film)?>-<?=$post->rowID?>" target="_blank"><?=$post->tit_film?></a></h2>
						<p><?=$post->direct_film?> / <?=$post->country_film?></p>
						<a href="acompanamientos-pedagogicos/<?=$_GET['lang']?>/presentacion/<?=get_alias($post->tit_film)?>-<?=$post->rowID?>" target="_blank" class="btn" onClick="ga('send', 'event', 'Mi cinescuela', 'click','Acompañamiento pedagógico - <?=$post->tit_film?>')"><?=find_array($json,75, $lang_ct)?></a>
					</div>
				</article>
			<? } ?>
			</div>
		</section>
        <!--Fin Peliculas disponibles-->

		<!--Actualidad en mi region-->
		<section class="news">
			<h2><?=find_array($json,76, $lang_ct)?></h2>
			<div class="scroll-bar-two">
            <? 
			 $mes = $oreka->getByField($user->region_user,"region_notice",3,4,1,'lord','upward'); 
			//$mes = posts_by_field("perfil-relacionado",intval($_SESSION['logged']['pro_us']),0); ?>
			<?php for($k=0;$k<count($mes);$k++){ $post = $mes[$k]->$lang;?>
				<article>
					<figure style="background-image:url(<?=dev($post->img_info)?>);"><a href="<?=$_GET['lang']?>/informacion/16/<?=get_alias($post->tit_info)?>-<?=$post->rowID?>" target="_BLANK"></a></figure>
					<div>
                    <?
					$date = new DateTime($post->publication_date);
					$newM = $date->format('M');
					$trad = array();
					$trad['Jan'] = "Ene";
					$trad['Feb'] = "Feb";
					$trad['Mar'] = "Mar";
					$trad['Apr'] = "Abr";
					$trad['May'] = "May";
					$trad['Jun'] = "Jun";
					$trad['Jul'] = "Jul";
					$trad['Aug'] = "Ago";
					$trad['Sep'] = "Sep";
					$trad['Oct'] = "Oct";
					$trad['Nov'] = "Nov";
					$trad['Dec'] = "Dic";
					
					$newD = $date->format('d');
					?>
						<time datetime="<?=$post->publication_date?>"><?=$trad[$newM]?> <?=$newD?></time>
						<h2><a href="<?=$_GET['lang']?>/informacion/16/<?=get_alias($post->tit_info)?>-<?=$post->rowID?>" target="_BLANK" onClick="ga('send', 'event', 'Mi cinescuela', 'click','Actualidad de la región - <?=$post->tit_info?>')"><?=$post->tit_info?></a></h2>
						<div class="desc">
							<?=$post->descsmall_info?>
						</div>
					</div>
				</article>
			<?php } ?>
			</div>
		</section><!--Fin Actualidad en mi region-->

		

		<!--Proximos eventos-->
		<section class="events">
			<h2><?=find_array($json,77, $lang_ct)?></h2>
			<div class="scroll-bar-two">
			<? $mes = $oreka->getByField($user->perfil_user,"profile_event",3,4,1,'lord','upward'); if(is_array($mes)){ ?>
			<?php for($k=0;$k<count($mes);$k++){ $post = $mes[$k]->$lang; ?>
				<article>
				
					<h2><a href="<?=$_GET['lang']?>/informacion/19745/<?=get_alias($post->name_event)?>-<?=$post->rowID?>" target="_BLANK" onClick="ga('send', 'event', 'Mi cinescuela', 'click','Eventos - <?=$post->name_event?>')"><?=$post->name_event?></a></h2>
					<?
					$date = new DateTime($post->date_event);
					$newM = $date->format('M');
					$trad = array();
					$trad['Jan'] = "Ene";
					$trad['Feb'] = "Feb";
					$trad['Mar'] = "Mar";
					$trad['Apr'] = "Abr";
					$trad['May'] = "May";
					$trad['Jun'] = "Jun";
					$trad['Jul'] = "Jul";
					$trad['Aug'] = "Ago";
					$trad['Sep'] = "Sep";
					$trad['Oct'] = "Oct";
					$trad['Nov'] = "Nov";
					$trad['Dec'] = "Dic";
					
					$newD = $date->format('d');
					?>
				<time datetime="<?=$post->publication_date?>"><span><?=$trad[$newM]?></span><?=$newD?></time>
				</article>
			<?php } } ?>
			</div>
		</section><!--Fin Proximos eventos-->
        
        <!--Utilidades-->
         <section class="events tools">
			<h2><?=find_array($json,91, $lang_ct)?></h2>
			<div class="scroll-bar-two">
			<? //$mes = posts_by_field("perfil-relacionadoe",intval($_SESSION['logged']['pro_us']),0);
				$mes = $oreka->getCollection(23,"lord","upward",10,1); 
				if(is_array($mes)){
			 ?>
			<?php for($k=0;$k<count($mes);$k++){ $post = $mes[$k]->$lang; ?>
				<article>
					<h2><a href="<?=$post->link_util?>" target="_BLANK" onClick="ga('send', 'event', 'Mi cinescuela', 'click','Utilidades - <?=$post->name_util?>')"><?=$post->name_util?></a></h2>
					<?
					/*$date = new DateTime(get_campo_adicional("fecha",$mes[$k],0));
					$newM = $date->format('M');
					$trad = array();
					$trad['Jan'] = "Ene";
					$trad['Feb'] = "Feb";
					$trad['Mar'] = "Mar";
					$trad['Apr'] = "Abr";
					$trad['May'] = "May";
					$trad['Jun'] = "Jun";
					$trad['Jul'] = "Jul";
					$trad['Aug'] = "Ago";
					$trad['Sep'] = "Sep";
					$trad['Oct'] = "Oct";
					$trad['Nov'] = "Nov";
					$trad['Dec'] = "Dic";
					
					$newD = $date->format('d');*/
					?>
				<!--<time datetime="<? //$post['publication_date']?>"><span><?=$trad[$newM]?></span><?=$newD?></time>-->
				</article>
			<?php } } ?>
			</div>
		</section><!--Fin utilidades-->
        

	</section><!--Fin Panel-->

	<!--lista peliculas mejor calificadas-->
	<!--<section class="list_movies">	
		<h2>Películas mejor calificadas</h2>
		<?php //for($i=1;$i<4;$i++){ ?>
		<article>
			<a href="movie.php">
				<span class="best"><?php //echo $i;?></span>
				<figure style="background-image:url(images/prueba/ciclo.jpg);"></figure>
				<div>
					<h2>Titulo de la pelicula lorem</h2>
					<p>Nombre Director Lorem Ipsum Dolor</p>
					<img src="images/site/min_rank_4.png" alt="ranking">
				</div>
			</a>
		</article>
		<?php //} ?>
	</section>-->
    <!--Fin lista peliculas mejor calificadas-->

	<!--Ciclo del mes-->
	<!--<article class="cycle_month_intern">
		<figure style="background-image:url(images/prueba/frases2.jpg);"></figure>
		<div>
			<h2><a href="#">Título del Ciclo del mes</a></h2>
			<span>Noviembre</span>
		</div>
		<span class="overlay"></span>
	</article>-->
    
    <!--Fin ciclo del mes-->

<?php include 'includes/footer.php'; ?>