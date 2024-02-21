<?php include 'includes/header.php'; ?>
<!--Contenido general-->
<section id="main_container" class="pelicula">
	<h2 class="hidden">Pelicula</h2>
	<!--Tabs contenido pelicula-->
	<div id="tabs">
    	<?
			switch($_GET['cat']){
				case 19747:
					$thecontent=$oreka->getByField($movie->rowID,"film_filmap",3,1,1,"created","downward")[0]->es;
					$sufix="_filmap";
				break;
				case 19748:
					$thecontent=$oreka->getByField($movie->rowID,"film_context",3,1,1,"created","downward")[0]->es;
					$sufix="_context";
				break;
			}
		?>	
		<ul>
		<? for($i=1; $i < 6; $i++){ 
			if($thecontent->{"tit".$i.$sufix}!=""){ ?>
			<li>
				<a href="<?=$_GET['lang']?>/<?=$nCategoria?>/<?=get_alias($movie->tit_film)?>-<?=$movie->rowID?>#tab-<?=$i?>" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Película - <?=$thecontent->{"tit".$i.$sufix}?>')">
					<span><strong><?=$i?></strong><?=$thecontent->{"tit".$i.$sufix}?></span>
				</a>
			</li>
		<? } }?>
		</ul>
		<?php for ($i=1; $i < 6; $i++) { ?>
        	<? if($thecontent->{"tit".$i.$sufix}!=""){ if(!$thecontent->{"imgleft".$i.$sufix}){ //Si es plantilla 1?>
            
            	<?
				$vinculo = $thecontent->{"url".$i.$sufix};
				$trailerSplit = explode("/",$vinculo);
				$videoCode = end($trailerSplit);
				
				$modo = 1;
				if(strpos($vinculo, "vimeo"))
				{
					$urele = "http";
					if($_SERVER["HTTPS"] == "on"){ $urele.="s";}
					$urele .="://player.vimeo.com/video/";
				}
				if(strpos($vinculo, "youtu.be"))
				{
					$urele = "http";
					if($_SERVER["HTTPS"] == "on"){ $urele.="s";}
					$urele .="://www.youtube.com/embed/";
				}
				if(strpos($vinculo, "soundcloud"))
				{
					$modo = 2;
					$urele = $vinculo;
				}
				
				if($modo==1) //Modo VIdeo
				{ ?>
				
                	<!--Tab item video-->
		<section id="tab-<?=$i?>">
			<!--Contenido left-->
			<div class="c_left">
				<div class="general-scroll">
					<div class="desc">
						<h2><?=$thecontent->{"tit".$i.$sufix}?></h2><hr>
						<?=$thecontent->{"desc".$i.$sufix}?>
					</div>
				</div>
			</div><!--Fin Contenido left-->
			<!--Contenido Right-->
			<div class="c_right">
            <? if($vinculo!=""){ ?>
				<figure class="video" style="background-image:url(<?=dev($thecontent->{"img".$i.$sufix})?>);">
					<a href="<?=$urele.$videoCode?>" class="open_video" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Reproducir - <?=$thecontent->{"tit".$i.$sufix}?>')">
						<img src="<?=dev($thecontent->{"img".$i.$sufix})?>" alt="Video">
						<span class="figcaption"><?=$json[118][$lang_j]?></span>
					</a>
				</figure>
                
				<div class="general-scroll two">
					<div class="footer_content">
						<p><?=$thecontent->{"desciv".$i.$sufix}?></p>
					</div>
				</div>
                <? } else{?>
                	<figure class="video" style="background-image:url(<?=dev($thecontent->{"img".$i.$sufix})?>);">
                	</figure>
                    <div class="general-scroll two">
					<div class="footer_content">
						<p><?=$thecontent->{"desciv".$i.$sufix}?></p>
					</div>
				</div>
                <? } ?>
			</div><!--Fin Contenido Right-->
    <!--Actividades complementarias-->
    <?  include "activities.php"; ?>    
            
            
            
            
		</section><!--Fin Tab item video-->
                	
				<? }
				else //Modo Audio
				{?>
				<!--Tab item audio-->
		<section id="tab-<?=$i?>">
			<!--Contenido left-->
			<div class="c_left">
				<div class="general-scroll">
					<div class="desc">
						<h2><?=$thecontent->{"tit".$i.$sufix}?></h2><hr>
						<?=$thecontent->{"desc".$i.$sufix}?>
					</div>
				</div>
			</div><!--Fin Contenido left-->
			<!--Contenido Right-->
			<div class="c_right">
            <? if($vinculo!=""){ ?>
				<figure class="audio" style="background-image:url('<?=dev($thecontent->{"img".$i.$sufix})?>')" alt="Video">');">
					<div>
                    	<?=$urele?>
						<!--AUDIO AQUI-->
					</div>
				</figure>
				<div class="general-scroll two">
					<div class="footer_content">
						<p><?=$thecontent->{"desciv".$i.$sufix}?></p>
					</div>
				</div>
                <? } else{?>
                	<figure class="video" style="background-image:url(<?=dev($thecontent->{"img".$i.$sufix})?>);">
                	</figure>
                    <div class="general-scroll two">
					<div class="footer_content">
						<p><?=$thecontent->{"desciv".$i.$sufix}?></p>
					</div>
				</div>
                <? } ?>
			</div><!--Fin Contenido Right-->
          <!--Actividades complementarias-->
    <?  include "activities.php"; ?>   
		</section><!--Fin Tab item audio-->	
				<? }
				?> 
            <? } ?>
            
            <? if($thecontent->{"imgleft".$i.$sufix}){ //Si es plantilla 2?>
            <!--Tab item imagenes-->
		<section id="tab-<?=$i+1?>">
			<!--Contenido left-->
			<div class="c_left">
				<div class="galeria">
					<div class="carrousel">
                    
                    <?
						$mygallery = get_gallery($thecontent[$i],0);
						$cantidadFotos = count($mygallery['files']);
						$paginas = ceil($cantidadFotos/6);
					?>
					<?php for ($a=0; $a < $paginas; $a++) { ?>
						<div>
						<?php for ($k=($a*2); $k < ($a*2+2); $k++) { ?>
                        <? if($mygallery['files'][$k] != ""){ ?>
							<figure style="background-image:url('../spina/upload/files/<?=$mygallery['files'][$k] ?>');">
							<a href="../spina/upload/files/<?=$mygallery['files'][$k] ?>" class="open_gallery">
							<img src="../spina/upload/files/<?=$mygallery['files'][$k] ?>" alt="imagen galeria">
							</a>
							</figure>
                            <? } ?>
						<?php } ?>
						</div>
					<?php } ?>
					</div>
				</div>
				<div class="general-scroll three">
					<div class="footer_content">
						<p><? campo_adicional("pie-de-multimedia",$thecontent[$i],0); ?></p>
					</div>
				</div>
			</div><!--Fin Contenido left-->
			<!--Contenido Right-->
			<div class="c_right">
				<div class="general-scroll">
					<div class="desc">
						<h2><?=$posttab['title']?></h2><hr>
						<?=$posttab['content']?>
					</div>
				</div>
			</div><!--Fin Contenido Right-->
            <!--Actividades complementarias-->
    <?  include "activities.php"; ?>  
		</section><!--Fin Tab item imagenes-->
            <? } ?>
        <? } }?>
	</div><!--Fin Tabs contenido pelicula-->
</section><!--Fin Contenido general-->

<?php include 'includes/footer.php'; ?>