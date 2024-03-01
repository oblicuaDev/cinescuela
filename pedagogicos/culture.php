<?php include 'includes/header.php'; ?>

<!--Contenido general-->
<section id="main_container" class="cultura">
	<h2 class="hidden">Cultura y sociedad</h2>
	<!--Listado-->
	<div class="general-scroll">
		<div id="list_container">
        	<? $thecontent=$cinescuela->getCS($apedag->id);$toolsArray=array();?>
			<?php 
            for ($i=0; $i <count($thecontent) ; $i++) { $article = $thecontent[$i];
                ?>
			<article class="item">
				<ul class="tipo">
                	<?php
                    // Convert array of integers to array of strings
                    $stringsArray = array_map('strval', $article->acf->tools);
                    $tools=$cinescuela->getTools($stringsArray);
                    if(!is_array($tools)){$tools=array($tools);}
                    array_push($toolsArray, $tools);
                    for($j=0;$j<count($tools);$j++){ $tool=$tools[$j]['response']; ?>
                    <li>
                    <?  switch ($tool->acf->tipo_de_herramienta) {
                            case 17: ?>
                        <a href="javascript:;" target="_BLANK" class="t_video" title="Video"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Video')">Video</a>
                            <?  break;
                            case 18: ?>
                        <a href="javascript:;" target="_BLANK" class="t_imagen" title="Fotografía"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Imagen')">Imagen</a>
                            <?  break;
                            case 19: ?>
                        <a href="javascript:;" target="_BLANK" class="t_cartilla" title="Cartilla"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Cartilla')">Cartilla</a>
                            <?  break;
                            case 110: ?>
                        <a href="javascript:;" target="_BLANK" class="t_multi" title="Multimedia"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Multimedia')">Multimedia</a>
                            <?  break;
                            case 111: ?>
                        <a href="javascript:;" target="_BLANK" class="t_audio" title="Audio"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Audio')">Audio</a>
                            <?  break;
                            case 21400: ?>
                        <a href="javascript:;" target="_BLANK" class="t_estadistica" title="Infografía"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Infografía')">Infografía</a>
                            <?  break;
                        } 
                        if($tool->acf->tipo_de_herramienta!=21400){?>
                        <div class="detalle">
                            <p><?=$tool->content->rendered?></p>
                            <a href="<?=$tool->acf->enlace?>" target="_BLANK" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Ir a enlace')">Ir a enlace</a>
                            <span class="tri"></span>
                        </div>
                        <? }else{?>
                        <div class="detalle">
                            <p><?=$tool->content->rendered?></p>
                            <a href="<?=$lang?>/Infografia/<?=get_alias($movie->title->rendered)?>-<?=$movie->id?>/<?=$tool->id?>" target="_BLANK" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Ir a enlace')">Ir a enlace</a>
                            <span class="tri"></span>
                        </div>
                        <? }?>
                    </li>
                    <? } ?>
                </ul>
				<? 
                if($article->acf->backgroundimgcs!=""){ 
                    ?>
                <figure>
					<img src="<?=$article->acf->backgroundimgcs?>" alt="<?=$article->title->rendered?>">
				</figure>
                <? } ?>
				<h2><?=$article->title->rendered?></h2>
			</article>
			<?php } ?>
		</div>
	</div><!--Fin Listado-->
	<!--Menu Listado-->
	<div class="cont_list">
		<button id="o_post_list">VER LISTADO<span></span></button>
		<div id="post_list">
			<ul>
			<?php for ($i=0; $i <count($thecontent) ; $i++) { $article = $thecontent[$i];?>
				<li>
					<span class="i_list"><?=$article->title->rendered?></span>
                    <ul>
					<? $tools=$toolsArray[$i];
                    for($j=0;$j<count($tools);$j++){ $tool=$tools[$j]['response']; ?>
                        <li>
                           <?  switch ($tool->acf->tipo_de_herramienta) {
                                case 17: ?>
                            <a href="javascript:;" target="_BLANK" class="t_video" title="Video"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Video')">Video</a>
                                <?  break;
                                case 18: ?>
                            <a href="javascript:;" target="_BLANK" class="t_imagen" title="Fotografía"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Imagen')">Imagen</a>
                                <?  break;
                                case 19: ?>
                            <a href="javascript:;" target="_BLANK" class="t_cartilla" title="Cartilla"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Cartilla')">Cartilla</a>
                                <?  break;
                                case 110: ?>
                            <a href="javascript:;" target="_BLANK" class="t_multi" title="Multimedia"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Multimedia')">Multimedia</a>
                                <?  break;
                                case 111: ?>
                            <a href="javascript:;" target="_BLANK" class="t_audio" title="Audio"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Audio')">Audio</a>
                                <?  break;
                                case 21400: ?>
                            <a href="javascript:;" target="_BLANK" class="t_estadistica" title="Infografía"  onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Infografía')">Infografía</a>
                                <?  break;
                            } 
                            if($tool->acf->tipo_de_herramienta!=21400){?>
                            <div class="detalle">
                                <p><?=$tool->content->rendered?></p>
                                <a href="<?=$tool->acf->enlace?>" target="_BLANK" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Ir a enlace')">Ir a enlace</a>
                                <span class="tri"></span>
                            </div>
                            <? }else{?>
                            <div class="detalle">
                                <p><?=$tool->content->rendered?></p>
                                <a href="<?=$lang?>/Infografia/<?=get_alias($movie->title->rendered)?>-<?=$movie->id?>/<?=$tool->id?>" target="_BLANK" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Ir a enlace')">Ir a enlace</a>
                                <span class="tri"></span>
                            </div>
                            <? }?> 
                        </li>
                    <? }?>
                    </ul>
				</li>
			<?php } ?>
			</ul>
		</div>
	</div><!--Fin Menu Listado-->
</section><!--Fin Contenido general-->
</div><!--Fin Contenedor principal-->
</body>
</html>
<?php //include 'includes/footer.php'; ?>