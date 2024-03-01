<?php include 'includes/head.php'; ?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->

	<!--peliculas-->
	<section class="intern news">
		<!--Titulo-->
		<h2><?=$category->name?></h2><!--Fin Titulo-->
		<!--lista ciclos-->
        <?
		if(!isset($_GET['page']))
		{
			$currentPage = 1;
		}else
		{
			$currentPage = $_GET['page'];
		}
		if($_GET['lang']=="es"){
        	$destacados = $cinescuela->consultarRecursos("posts", "", "", "GET", $currentPage, 6, ['categories'=>$_GET['cat'], 'informativa_frances_'=>0]);
		}else{
        	$destacados = $cinescuela->consultarRecursos("posts", "", "", "GET", $currentPage, 6, ['categories'=>$_GET['cat'], 'informativa_frances_'=>1]);
		}
		$totalPages=0;
		if(is_array($destacados)){
		$totalPages = $destacados["total_pages"];
		?>
		<div class="list_news">
		<?php
		 for($i=0;$i<count($destacados["response"]);$i++){ $post = $destacados["response"][$i]; 
			//if(get_campo_adicional("perfil-relacionado",$destacados[$i],0)==""){
		?>	
			<article>
				<figure style="background-image:url(<?=$post->acf->imagen?>);"><a href="<?=$_GET['lang']?>/informacion/<?=$_GET['cat']?>/<?=get_alias($post->title->rendered)?>-<?=$post->id?>" onClick="ga('send', 'event', 'Blog', 'click','Ver mas - <?=$post->title->rendered?>')"></a></figure>
				<div>
                	<?
						$date = DateTime::createFromFormat('d/m/Y', $post->acf->fecha_de_publicacion);
						if ($date !== false) {
							$newD = $date->format('Y-m-d');
						} else {
							echo "La fecha proporcionada no es válida.";
						}
				?>
					<time datetime="<?=$post->acf->fecha_de_publicacion?>"><?=$newD?></time>
					<h2><a href="<?=$_GET['lang']?>/informacion/<?=$_GET['cat']?>/<?=get_alias($post->title->rendered)?>-<?=$post->id?>" onClick="ga('send', 'event', 'Blog', 'click','Ver mas - <?=$post->title->rendered?>')"><?=$post->title->rendered?></a></h2>
					<div class="desc">
						<?=$post->descsmall_info?>
					</div>
					<a href="<?=$_GET['lang']?>/informacion/<?=$_GET['cat']?>/<?=get_alias($post->title->rendered)?>-<?=$post->id?>" class="more" onClick="ga('send', 'event', 'Blog', 'click','Ver mas - <?=$post->title->rendered?>')">Ver más</a>
				</div>
			</article>
		<?php /*}*/ } }?>
		</div><!--Fin lista ciclos-->

		<div class="pager">
			<? pager($currentPage,$totalPages); ?>
		</div>
	
	</section><!--Fin peliculas-->

<?php include 'includes/footer.php'; ?>