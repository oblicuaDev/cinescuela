<?php include 'includes/head.php'; ?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->

	<!--peliculas-->
	<section class="intern news">
		<!--Titulo-->
		<h2><?=$category->name_category?></h2><!--Fin Titulo-->
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
        	$destacados = $oreka->getByMultipleField($_GET['cat'].",0",'category_info,fr_info',"3,3",6,$currentPage,'lord','upward');
		}else{
        	$destacados = $oreka->getByMultipleField($_GET['cat'].",1",'category_info,fr_info',"3,3",6,$currentPage,'lord','upward');
		}
		$totalPages=0;
		if(is_array($destacados)){
        $totalPosts = $destacados[0]->$lang->totalRows;
		$totalPages = ceil($totalPosts/6);
		?>
		<div class="list_news">
		<?php for($i=0;$i<count($destacados);$i++){ $post = $destacados[$i]->$lang; 
			//if(get_campo_adicional("perfil-relacionado",$destacados[$i],0)==""){
		?>	
			<article>
				<figure style="background-image:url(<?=dev($post->img_info)?>);"><a href="<?=$_GET['lang']?>/informacion/<?=$_GET['cat']?>/<?=get_alias($post->tit_info)?>-<?=$post->rowID?>" onClick="ga('send', 'event', 'Blog', 'click','Ver mas - <?=$post->tit_info?>')"></a></figure>
				<div>
                	<?
				$date = new DateTime($post->publication_date);
				$newD = $date->format('Y-m-d');
				?>
					<time datetime="<?=$post->publication_date?>"><?=$newD?></time>
					<h2><a href="<?=$_GET['lang']?>/informacion/<?=$_GET['cat']?>/<?=get_alias($post->tit_info)?>-<?=$post->rowID?>" onClick="ga('send', 'event', 'Blog', 'click','Ver mas - <?=$post->tit_info?>')"><?=$post->tit_info?></a></h2>
					<div class="desc">
						<?=$post->descsmall_info?>
					</div>
					<a href="<?=$_GET['lang']?>/informacion/<?=$_GET['cat']?>/<?=get_alias($post->tit_info)?>-<?=$post->rowID?>" class="more" onClick="ga('send', 'event', 'Blog', 'click','Ver mas - <?=$post->tit_info?>')">Ver más</a>
				</div>
			</article>
		<?php /*}*/ } }?>
		</div><!--Fin lista ciclos-->

		<div class="pager">
			<? pager($currentPage,$totalPages); ?>
		</div>
	
	</section><!--Fin peliculas-->

<?php include 'includes/footer.php'; ?>