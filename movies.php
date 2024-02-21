<?php include 'includes/head.php'; ?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->
	<script>
	$(document).ready(function(e) {
    });
	</script>
	<!--peliculas-->
	<section class="intern">
		<div class="green_title">
			<!--<h2>Películas</h2>-->
			<!--Filtro-->
			<div class="filter">
				<div>
					<form action="Peliculas" method="get" id="fSearch">
					<input type="text" placeholder="<?=find_array($json, 44, $lang_ct)?>" id="search" class="txt_search" name="s" value="<?=$_GET['s']?>">
					</form>
				</div>
				<div>
                	<form action="Peliculas" method="get" id="featured">
					<select id="select_todas" name="featured">
						<option value="2" <? echo $sel=($_GET['featured']==2)?"selected":"" ?> ><?=find_array($json, 42, $lang_ct)?></option>
						<option value="1" <? echo $sel=($_GET['featured']==1)?"selected":"" ?> ><?=find_array($json, 43, $lang_ct)?></option>
					</select>
                     </form>
				</div>
				<div>
                	<form action="Peliculas" method="get" id="subject">
					<select id="select_asignaturas" name="subject">
						<option value="-1"><?=find_array($json, 45, $lang_ct)?></option>
                        	<?
							$asignaturas = $oreka->getCollection(18, 'lord', 'upward', 0, 1);
							for($i=0;$i<count($asignaturas);$i++){ $post = $asignaturas[$i]->$lang_ct; ?>
                        <option value="<?=$post->rowID?>" <? if($_GET['subject']==$post->rowID){ echo "selected";} ?>><?=$post->name_subject?></option>
                            <? } ?>
					</select>
                    </form>
				</div>
				<div>
                	<form action="Peliculas" method="get" id="topic">
					<select id="select_etiquetas" name="topic">
						<option value="-1"><?=find_array($json, 46, $lang_ct)?></option>
                        <?
							$tematicas = $oreka->getCollection(19, "lord", 'upward', 0, 1);
							for($i=0;$i<count($tematicas);$i++){ $post = $tematicas[$i]->$lang_ct; ?>
                            <option value="<?=$post->rowID?>" <? if($_GET['topic']==$post->rowID){ echo "selected";} ?>><?=$post->name_thematic?></option>
                            <? } ?>
					</select>
                    </form>
				</div>
			</div>
			<!--Fin Filtro-->

		</div><!--Fin Titulo-->
		<? if((!isset($_GET['subject']) && !isset($_GET['topic']) && !isset($_GET['featured']) && !isset($_GET['s']))){ //Si no hay filtro alguno 
		?>
		<!--lista peliculas-->
		<div class="list_movies">
        
        <?	
			if(!isset($_GET['page']))
			{
				$currentPage = 1;
			}else
			{
				$currentPage = $_GET['page'];
			}
			if($_GET['lang']=="es"){
				$posts = $oreka->getByMultipleField("0,0","featured_film,fr_film","3,3", 9, $currentPage,'lord', 'upward');
			}
			else{
				$posts = $oreka->getByMultipleField("0,1","featured_film,fr_film","3,3", 9, $currentPage,'lord', 'upward');
			}
			$totalPages=0;
			if(is_array($posts)){
				$totalPosts = $posts[0]->$lang->totalRows;
				$totalPages = ceil($totalPosts/9);
			}
		?>
		<? 
		if($_GET['lang']=="es"){
			$destacados = $oreka->getByMultipleField("1,0",'featured_film,fr_film',"3,3",2,1,'lord','upward');
		}
		else{
			$destacados = $oreka->getByMultipleField("1,1",'featured_film,fr_film',"3,3",2,1,'lord','upward');
		}
		if($currentPage==1 && is_array($destacados)){
		//Traigo las dos primeras peliculas destacadas
		for($i=0;$i<count($destacados);$i++){ $post = $destacados[$i]->$lang; ?>
        <? $class=""; if($i==0){ $class='class="big"'; } if($i==1){ $class='class="big_two"'; } ?>
			<article <?=$class?>>
				<a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->tit_film)?>-<?=$post->rowID?>" onClick="ga('send', 'event', 'Películas', 'click', '<?=$post->tit_film?>')">
					<figure style="background-image:url(<?=dev($post->img_film)?>);"></figure>
					<div>
						<h2><?=$post->tit_film?></h2>
						<p><?=$post->direct_film?></p>
						<!--<img src="images/site/min_rank_4.png" alt="ranking">-->
					</div>
				</a>
			</article>
		<?php } }?>
        
        
		<?
		if(is_array($posts)){
        //Traigo el resto de peliculas, estas quedan paginadas
		for($i=0;$i<count($posts);$i++){ $post = $posts[$i]->$lang; ?>
			<article>
				<a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->tit_film)?>-<?=$post->rowID?>">
					<figure style="background-image:url(<?=dev($post->img_film)?>);"></figure>
					<div>
						<h2><?=$post->tit_film?></h2>
						<p><?=$post->direct_film?></p>
						<!--<img src="images/site/min_rank_4.png" alt="ranking">-->
					</div>
				</a>
			</article>
		<?php } } ?>
		</div><!--Fin lista peliculas-->
		
		<div class="pager">
			<? pager($currentPage,$totalPages); ?>
		</div>
	<? }else{ //Si existe algun tipo de filtro... ?>
        <div class="list_movies">
        <?
		if($_GET['featured']!=1 && $_GET['featured']!=2){
			if(!isset($_GET['page']))
			{
				$currentPage = 1;
			}else
			{
				$currentPage = $_GET['page'];
			}
			if(isset($_GET['subject'])) //si el filtro es por asignatura
			{
				if($_GET['lang']=="es"){
					$busqueda = $oreka->getByMultipleField($_GET['subject'].",0",'subjects_film,fr_film',"1,3",9,$currentPage,'lord','upward');
				}
				else{
					$busqueda = $oreka->getByMultipleField($_GET['subject'].",1",'subjects_film,fr_film',"1,3",9,$currentPage,'lord','upward');
				}
			}
			if(isset($_GET['topic'])) //si el filtro es por temática
			{
				if($_GET['lang']=="es"){
					$busqueda = $oreka->getByMultipleField($_GET['topic'].",0",'thematic_film,fr_film',"1,3",9,$currentPage,'lord','upward');
				}else{
					$busqueda = $oreka->getByMultipleField($_GET['topic'].",1",'thematic_film,fr_film',"1,3",9,$currentPage,'lord','upward');
				}
				//print_r($busqueda);
			}
			if(isset($_GET['s']))
			{
				$final_search = str_replace("_", " ", $_GET['s']);
				$busqueda=$oreka->getSearch(8,$final_search);
			}
			$totalPages=0;
			if(is_array($busqueda)){
			$totalPosts = $busqueda[0]->$lang->totalRows;
			$totalPages = ceil($totalPosts/9);
			//Pinto los articulos recorriendo los 3 espacios de busqueda
			for($i=0;$i<count($busqueda);$i++){ $post = $busqueda[$i]->$lang; ?>
			<article>
				<a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->tit_film)?>-<?=$post->rowID?>">
					<figure style="background-image:url(<?=dev($post->img_film)?>);"></figure>
					<div>
						<h2><?=$post->tit_film?></h2>
						<p><?=$post->direct_film?></p>
					</div>
				</a>
			</article>
		<?php } } if(!isset($_GET['s'])){?>
			<div class="pager">
				<? pager($currentPage,$totalPages); ?>
			</div>
		
			<? } }elseif($_GET['featured']==2){ ?>
			<div class="list_movies">
			<?	if(!isset($_GET['page']))
				{
					$currentPage = 1;
				}else
				{
					$currentPage = $_GET['page'];
				}
				if($_GET['lang']=="es"){
					$posts = $oreka->getByField(0,"fr_film",3, 9, $currentPage,'modify', 'upward');
				}
				else{
					$posts = $oreka->getByField(1,"fr_film",3, 9, $currentPage,'modify', 'upward');
				}
				$totalPages=0;
				if(is_array($posts)){
					$totalPosts = $posts[0]->$lang->totalRows;
					$totalPages = ceil($totalPosts/9);
			        //Traigo el resto de peliculas, estas quedan paginadas
					for($i=0;$i<count($posts);$i++){ $post = $posts[$i]->$lang; ?>
						<article>
							<a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->tit_film)?>-<?=$post->rowID?>">
								<figure style="background-image:url(<?=dev($post->img_film)?>);"></figure>
								<div>
									<h2><?=$post->tit_film?></h2>
									<p><?=$post->direct_film?></p>
									<!--<img src="images/site/min_rank_4.png" alt="ranking">-->
								</div>
							</a>
						</article>
					<?php } } else{echo $posts->message;} ?>
					</div><!--Fin lista peliculas-->
					
					<div class="pager">
						<? pager($currentPage,$totalPages); ?>
					</div>
			<? }else{
				if($_GET['lang']=="es"){
					$destacados = $oreka->getByMultipleField("1,0",'featured_film,fr_film',"3,3",9,1,'lord','upward');
				}else{
					$destacados = $oreka->getByMultipleField("1,1",'featured_film,fr_film',"3,3",9,1,'lord','upward');
				}
				if(is_array($destacados)){
				for($i=0;$i<count($destacados);$i++){ $post = $destacados[$i]->$lang;?>
			<article>
				<a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->tit_film)?>-<?=$post->rowID?>" onClick="ga('send', 'event', 'Películas', 'click', '<?=$post->tit_film?>')">
					<figure style="background-image:url(<?=dev($post->img_film)?>);"></figure>
					<div>
						<h2><?=$post->tit_film?></h2>
						<p><?=$post->direct_film?></p>
						<!--<img src="images/site/min_rank_4.png" alt="ranking">-->
					</div>
				</a>
			</article>
		<?php } }
				
			}
		?>
        </div><!--Fin lista peliculas-->
		<? } ?>
        
	</section><!--Fin peliculas-->

<?php include 'includes/footer.php'; ?>