<?php include 'includes/head.php';?>
<!--Contenedor principal-->
<div id="main_container">
	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->

	<!--Contenido interna-->
	<article class="intern general">
    <? $ev=false;if($_GET['cat']=="19745"){$ev=true;} if($_GET['cat']!="" && $_GET['cat']!="12" && $_GET['cat']!="13" && $_GET['cat']!="14" && $_GET['cat']!="19745"){ ?>
		<span class="nom_secc"><?=$category->name_category;?></span>
        <? } $info=$rows;?>
		<h2><? echo $ev ? $info->name_event : $info->tit_info;?></h2>
        <?
			$date = new DateTime($info->publication_date);
			$newD = $date->format('Y-m-d');
			?>
		<time datetime="<?=$info->publication_date?>"><?=$newD?></time><hr>
		<div class="intro">
			<? echo $ev ? $info->shortdesc_event : $info->descsmall_info;?>
		</div>
		<ul class="shared">
			<li><a href="javascript:facebook_share('<?=currentURL()?>');" class="facebook">facebook</a></li>
			<li><a href="https://twitter.com/intent/tweet?text=<?=urlencode($ev ? $info->name_event : $info->tit_info." ".currentURL())?>" class="twitter" target="_BLANK">twitter</a></li>
			<li><a href="https://plus.google.com/share?url=<?=urlencode($ev ? $info->name_event : $info->tit_info." en Cinescuela ".currentURL())?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="googlemas">google +</a></li>
		</ul>
		<!--Imagen principal-->
		<? if($info->img_info[strlen($info->img_info)-1]!="/" && !$ev){ ?>
		<figure><img src="<?=dev($info->img_info)?>" alt="<?=$info->tit_info?>"></figure>
		<? } ?>
		<!--Fin Imagen principal-->
		<!--Contenido general-->
		<div class="content">
			<? echo $ev ? $info->desc_event : $info->desc_info;?>
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
        <? $related = $oreka->getByField($_GET['cat'],'category_info',3,5,1,'lord','upward') ?>
		<?php $count=0; for($i=0;$i<count($related);$i++){ $post = $related[$i]->$lang; if($post->rowID!=$_GET['rowID'] && $count<4){$count++;?>
		<article>
			<figure><a href="<?=$_GET['lang']?>/informacion/<?=$_GET['cat']?>/<?=get_alias($post->tit_info)?>-<?=$post->rowID?>" onClick="ga('send', 'event', 'Blog', 'click','Contenido relacionado - <?=$post->tit_info?>')"><img src="<?=dev($post->img_info)?>" alt="<?=$post->tit_info?>"></a></figure>
			<div>
            <?
			$date = new DateTime($post->publication_date);
			$newD = $date->format('Y-m-d');
			?>
				<time datetime="<?=$post->publication_date?>"><?=$newD?></time>
				<h2><a href="<?=$_GET['lang']?>/informacion/<?=$_GET['cat']?>/<?=get_alias($post->tit_info)?>-<?=$post->rowID?>" onClick="ga('send', 'event', 'Blog', 'click','Contenido relacionado - <?=$post->tit_info?>')"><?=$post->tit_info?></a></h2>
				<p><?=$post->descsmall_info?></p>
			</div>
		</article>
		<?php }} ?>
	</section><!--Fin Contenido relacionado-->
	<? } ?>


<?php include 'includes/footer.php'; ?>