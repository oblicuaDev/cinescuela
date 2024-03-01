<?php include 'includes/head.php'; ?>
<!--Contenedor principal-->
<div id="main_container">
	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->
	<!--peliculas-->
	<section class="intern cycles">
		<div class="list_cycle">
        <?php 
		$post = $cinescuela->getCiclos(strval($gnrl->cyclemonth_gnrl[0]));
		?>
        <article class="month">
			<a href="<?=$_GET['lang']?>/ciclo/<?=get_alias($post->title->rendered)?>-<?=$post->id?>" onClick="ga('send', 'event', 'Ciclos', 'click','<?=$post->title->rendered?>')">
				<figure style="background-image:url(<?=$post->acf->imagen_principal_el_ciclo?>);"></figure>
				<div>
					<h2><?=$post->title->rendered?></h2>
					<time><?=$post->acf->mes_del_ciclo?> <?=$post->acf->ano_del_ciclo?></time>
					<div class="desc">
						<hr>
						<?=$post->acf->descripcion_corta_del_ciclo?>
					</div>						
				</div>
			</a>
		</article>
		<? if($_GET['lang']=="es"){
			$destacados = $cinescuela->getCiclos("",1,100,['field'=>'ciclo_frances_','value'=>'0']);
		}else{
			$destacados = $cinescuela->getCiclos("",1,100,['field'=>'ciclo_frances_','value'=>'1']);
		}
		if(is_array($destacados)){
			for($i=0;$i<count($destacados["response"]);$i++){ $post = $destacados["response"][$i];
				$class=""; if($post->id!=$gnrl->cyclemonth_gnrl[0]){ ?>
			<article <?=$class?>>
				<a href="<?=$_GET['lang']?>/ciclo/<?=get_alias($post->title->rendered)?>-<?=$post->id?>" onClick="ga('send', 'event', 'Ciclos', 'click','<?=$post->title->rendered?>')">
					<figure style="background-image:url(<?=$post->acf->imagen_principal_el_ciclo?>);"></figure>
					<div>
						<h2><?=$post->title->rendered?></h2>
						<time><?=$post->acf->mes_del_ciclo?> <?=$post->acf->ano_del_ciclo?></time>
						<div class="desc">
							<hr>
							<?=$post->acf->descripcion_corta_del_ciclo?>
						</div>						
					</div>
				</a>
			</article>
		<?php } } } ?>
		</div>
	</section><!--Fin peliculas-->

<?php include 'includes/footer.php'; ?>