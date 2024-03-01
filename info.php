<?php include 'includes/head.php';?>
<!--Contenedor principal-->
<div id="main_container">
	<!--Encabezado-->
	<?php 
		include 'includes/header.php';
	?><!--Fin Encabezado-->

	<!--Contenido interna-->
	<article class="intern general">
    <?php if(isset($_GET['cat'])){ ?>
		<span class="nom_secc"><?=$category->name?></span>
        <?php 
			} 
			$info=$rows['response'];?>
		<h2><?=$info->title->rendered?></h2>
        <?
		$date = DateTime::createFromFormat('d/m/Y', $info->acf->fecha_de_publicacion);
		if ($date !== false) {
			$newD = $date->format('Y-m-d');
		} else {
			echo "La fecha proporcionada no es válida.";
		}
			
			?>
		<time datetime="<?=$info->acf->fecha_de_publicacion?>"><?=$newD?></time><hr>
		<div class="intro">
			<?=$info->acf->descripcion_corta?>
		</div>
		<ul class="shared">
			<li><a href="javascript:facebook_share('<?=currentURL()?>');" class="facebook">facebook</a></li>
			<li><a href="https://twitter.com/intent/tweet?text=<?=urlencode($info->title->rendered ." ".currentURL())?>" class="twitter" target="_BLANK">twitter</a></li>
			<li><a href="https://plus.google.com/share?url=<?=urlencode($info->title->rendered ." en Cinescuela ".currentURL())?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="googlemas">google +</a></li>
		</ul>
		<!--Imagen principal-->
		
		<figure><img src="<?=$info->acf->imagen?>" alt="<?=$info->title->rendered?>"></figure>
		<!--Fin Imagen principal-->
		<!--Contenido general-->
		<div class="content">
			<?= $info->content->rendered;?>
		</div><!--Fin Contenido general-->

	</article><!--Fin Contenido interna-->
<!--Comentarios-->
	<section class="comments">
		<h2><?=find_array($json,40, $lang_ct)?></h2>
		<div id="comments_container">
        	<fb:comments href="<?=currentURL()?>" numposts="5" width="100%"></fb:comments>
		</div>
	</section><!--Fin Comentarios-->
	

	<!--Contenido relacionado-->
    <? if($_GET['cat']!="" && $_GET['cat']!="12" && $_GET['cat']!="13" && $_GET['cat']!="14" && $_GET['cat']!="19745"){ ?>
	<section class="latest_news">
		<h2><?=find_array($json,41, $lang_ct)?></h2>
        <? 
		$related = $cinescuela->query("posts","","GET",1,4,['categories' => $_GET['cat']]) ;
		$related = $related['response'];
		?>
		<?php 
		$count = 0; 
		for ($i = 0; $i < count($related); $i++) {
			$post = $related[$i]; 
			if ($post->id != $_GET['rowID'] && $count < 4) {
				$count++; 
		?>
		<article>
			<figure>
				<a href="<?= $_GET['lang'] ?>/informacion/<?= $_GET['cat'] ?>/<?= get_alias($post->title->rendered) ?>-<?= $post->id ?>" onClick="ga('send', 'event', 'Blog', 'click','Contenido relacionado - <?= $post->title->rendered ?>')">
					<img src="<?= $post->acf->imagen ?>" alt="<?= $post->title->rendered ?>">
				</a>
			</figure>
			<div>
				<?php
				$date = DateTime::createFromFormat('d/m/Y', $post->acf->fecha_de_publicacion);
				if ($date !== false) {
					$newD = $date->format('Y-m-d');
				} else {
					$newD = "Invalid Date";
				}
				?>
				<time datetime="<?= $newD ?>"><?= $newD ?></time>
				<h2>
					<a href="<?= $_GET['lang'] ?>/informacion/<?= $_GET['cat'] ?>/<?= get_alias($post->title->rendered) ?>-<?= $post->id ?>" onClick="ga('send', 'event', 'Blog', 'click','Contenido relacionado - <?= $post->title->rendered ?>')">
						<?= $post->title->rendered ?>
					</a>
				</h2>
				<p><?= $post->descsmall_info ?></p>
			</div>
		</article>
		<?php 
			}
		} 
		?>

	</section><!--Fin Contenido relacionado-->
	<? } ?>


<?php include 'includes/footer.php'; ?>