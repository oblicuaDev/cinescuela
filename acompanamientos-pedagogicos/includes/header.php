<?php include 'includes/head.php'; ?>
<!--Encabezado-->
<header id="page_header">
	<div>
		<div>
			<h1><span><?=$movie->tit_film?> - Cinescuela</span><img src="<?=dev($movie->logo_film)?>" alt="<?=$movie->tit_film?>"></h1>
			<div class="menu_top">
				<div>
					<a href="../<?=$_GET['lang']?>/pelicula/<?=get_alias($movie->tit_film)?>-<?=$movie->rowID?>" id="go_movie" target="_BLANK"><span></span><?=$json[103][$lang_j]?></a>
				</div><!--
			 -->
<?php $type=$movie->pedago_film;
$type=explode('.', $type);
if(end($type)=='pdf'){ ?>
			 	<div>
					<a href="<?=$movie->pedago_film?>" id="go_pdf" target="_BLANK"><span></span><?=$json[119][$lang_j]?></a>
				</div>
<?php } ?>
			 	<div>
					<a href="#" id="ruta_pedagogica"><span></span><?=$json[104][$lang_j]?><br><?=$json[105][$lang_j]?></a>
					<!--Ruta pedagogica-->
					<div id="lista_ruta">
						<ul>
                        <? $RutaRelacionada = $oreka->getByField($movie->rowID,"filmrel_route",3,1,1,"created","downward");
                        if(is_array($RutaRelacionada)){
                        	$RutaRelacionada=$RutaRelacionada[0]->$lang;
                        $step=["","one","two","three","four","five","six"];?>
						<?php for($j=1;$j<7;$j++){ ?>
                        <? 
							$paso ="step$step[$j]_route";
						if($RutaRelacionada->{$paso}!=""){ ?>
							<li>
								<span class="ico_num"><?php echo $j; ?></span><span class="vertical_line"></span>
								<div>
									<strong><?=$RutaRelacionada->{$paso}?></strong>
									<?=$RutaRelacionada->{"desc".$paso}?>
								</div><hr>
							</li>
                            <? } ?>
						<?php } } ?>
						</ul>
					</div><!--Fin Ruta pedagogica-->
				</div><!--
			 --><div>
					<span><?=$json[106][$lang_j]?></span>
					<ul class="social_networks">
						<li><a href="javascript:facebook_share('<?=currentURL()?>');" class="facebook"><span></span>facebook</a></li><!--
			 		 --><li><a href="https://twitter.com/intent/tweet?text=<?=urlencode($movie->tit_film." en Cinescuela ".currentURL())?>" target="_BLANK" class="twitter"><span></span>twitter</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div>
		<!--Menu principal-->
		<nav id="main_menu">		
			<h2><?=$json[52][$lang_j]?></h2><button id="btn_menu_top">open menu</button><!--
		 --><ul>
				<li><a <? if($_GET['cat']==19746){ echo "class='active'"; }?> href="<?=$_GET['lang']?>/presentacion/<?=get_alias($movie->tit_film)?>-<?=$movie->rowID?>"><?=$json[107][$lang_j]?></a></li>
				<li><a <? if($_GET['cat']==19747){ echo "class='active'"; $nCategoria="pelicula";}?> href="<?=$_GET['lang']?>/pelicula/<?=get_alias($movie->tit_film)?>-<?=$_GET['rowID']?>"><?=$json[108][$lang_j]?></a></li>
				<li><a <? if($_GET['cat']==19748){ echo "class='active'"; $nCategoria="contexto";}?>  href="<?=$_GET['lang']?>/contexto/<?=get_alias($movie->tit_film)?>-<?=$_GET['rowID']?>"><?=$json[109][$lang_j]?></a></li>
				<li><a <? if($_GET['cat']==19749){ echo "class='active'"; }?>  href="<?=$_GET['lang']?>/cultura-y-sociedad/<?=get_alias($movie->tit_film)?>-<?=$_GET['rowID']?>"><?=$json[110][$lang_j]?></a></li>
                <? 
					//$extras = posts_by_field("ficha-relacionada-25",$_GET['a'],0);
				if(count($extras)>0){// $extrasection = basic_post($extras[0]);?>
                	
                	<li><a <? if($_GET['m']==25){ echo "class='active'"; }?>  href="content.php?m=25&a=<?=$_GET['a']?>"><?=$extrasection['title']?></a></li>
                
                <? } ?>
                
                
				<!--<li><a href="#">Extra</a></li>-->
			</ul>
		</nav><!--Fin Menu principal-->
	</div>
</header><!--Fin Encabezado-->

<!--Imagen principal (fondo pantalla)-->
<img src="<?=dev($movie->backap_film)?>" alt="<?=$movie->tit_film?>" id="main_image">
<!--Fin Imagen principal (fondo pantalla)-->