<?php include 'includes/head.php'; ?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->

	<!--peliculas-->
	<section class="intern cycles">

		<!--Titulo
		<div class="green_title">
			<h2>Ciclos</h2>

		</div> Fin Titulo-->

		<!--lista ciclos-->
		<div class="list_cycle">
        <?php $post = $oreka->getRows($gnrl->cyclemonth_gnrl)->$lang;?>
        <article class="month">
			<a href="<?=$_GET['lang']?>/ciclo/<?=get_alias($post->tit_cycle)?>-<?=$post->rowID?>" onClick="ga('send', 'event', 'Ciclos', 'click','<?=$post->tit_cycle?>')">
				<figure style="background-image:url(<?=dev($post->img_cycle)?>);"></figure>
				<div>
					<h2><?=$post->tit_cycle?></h2>
					<time><?=$post->month_cycle?> <?=$post->year_cycle?></time>
					<div class="desc">
						<hr>
						<?=$post->shortdesc_cycle?>
					</div>						
				</div>
			</a>
		</article>
		<? if($_GET['lang']=="es"){
				$destacados = $oreka->getByField(0,"fr_cycle",3,50,1,'lord','upward');
			}else{
				$destacados = $oreka->getByField(1,"fr_cycle",3,50,1,'lord','upward');
			}
			if(is_array($destacados)){
			for($i=0;$i<count($destacados);$i++){ $post = $destacados[$i]->$lang;
				$class=""; if($post->rowID!=$gnrl->cyclemonth_gnrl){ ?>
			<article <?=$class?>>
				<a href="<?=$_GET['lang']?>/ciclo/<?=get_alias($post->tit_cycle)?>-<?=$post->rowID?>" onClick="ga('send', 'event', 'Ciclos', 'click','<?=$post->tit_cycle?>')">
					<figure style="background-image:url(<?=dev($post->img_cycle)?>);"></figure>
					<div>
						<h2><?=$post->tit_cycle?></h2>
						<time><?=$post->month_cycle?> <?=$post->year_cycle?></time>
						<div class="desc">
							<hr>
							<?=$post->shortdesc_cycle?>
						</div>						
					</div>
				</a>
			</article>
		<?php } } } ?>
		</div>
        <!--Fin lista ciclos-->

		<!--<div class="pager">
			<ul>
				<li><a href="#" class="prev">prev</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#" class="active">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">8</a></li>
				<li><a href="#" class="next">next</a></li>
			</ul>
		</div>-->
	
	</section><!--Fin peliculas-->

<?php include 'includes/footer.php'; ?>