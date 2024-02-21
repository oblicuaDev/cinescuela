<?php include 'includes/header.php'; ?>

<!--Contenido general-->
<section id="main_container" class="cultura">
	<h2 class="hidden">Cultura y sociedad</h2>
	<!--Listado-->
	<div class="general-scroll">
		<div id="list_container">
        	<? $thecontent = $oreka->getByField($movie->rowID,"film_culture",3,10,1,"lord","upward");$toolsArray=array();?>
			<?php for ($i=0; $i <count($thecontent) ; $i++) { $article = $thecontent[$i]->es;?>
			<article class="item">
				<ul class="tipo">
                	<? $tools=$oreka->getRows($article->create_culture);
                    if(!is_array($tools)){$tools=array($tools);}
                    array_push($toolsArray, $tools);
                    for($j=0;$j<count($tools);$j++){ $tool=$tools[$j]->es; ?>
                    <li>
                    <?  switch ($tool->type_culture) {
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
                        } if($tool->type_culture!=21400){?>
                        <div class="detalle">
                            <p><?=$tool->desc_culture?></p>
                            <a href="<?=$tool->link_culture?>" target="_BLANK" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Ir a enlace')"><?=$json[115][$lang_j]?></a>
                            <span class="tri"></span>
                        </div>
                        <? }else{?>
                        <div class="detalle">
                            <p><?=$tool->desc_culture?></p>
                            <a href="<?=$lang?>/Infografia/<?=get_alias($movie->tit_film)?>-<?=$movie->rowID?>/<?=$tool->rowID?>" target="_BLANK" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Ir a enlace')"><?=$json[115][$lang_j]?></a>
                            <span class="tri"></span>
                        </div>
                        <? }?>
                    </li>
                    <? } ?>
                </ul>
				<? if($article->back_culture!=""){ ?>
                <figure>
					<img src="<?=dev($article->back_culture)?>" alt="<?=$article->tit_culture?>">
				</figure>
                <? } ?>
				<h2><?=$article->tit_culture?></h2>
			</article>
			<?php } ?>
		</div>
	</div><!--Fin Listado-->
	<!--Menu Listado-->
	<div class="cont_list">
		<button id="o_post_list"><?=$json[116][$lang_j]?><span></span></button>
		<div id="post_list">
			<ul>
			<?php for ($i=0; $i <count($thecontent) ; $i++) { $article = $thecontent[$i]->es;?>
				<li>
					<span class="i_list"><?=$article->tit_culture?></span>
                    <ul>
					<? $tools=$toolsArray[$i];
                    for($j=0;$j<count($tools);$j++){ $tool=$tools[$j]->es;?>
                        <li>
                           <?  switch ($tool->type_culture) {
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
                            } if($tool->type_culture!=21400){?>
                            <div class="detalle">
                                <p><?=$tool->desc_culture?></p>
                                <a href="<?=$tool->link_culture?>" target="_BLANK" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Ir a enlace')"><?=$json[115][$lang_j]?></a>
                                <span class="tri"></span>
                            </div>
                            <? }else{?>
                            <div class="detalle">
                                <p><?=$tool->desc_culture?></p>
                                <a href="<?=$lang?>/Infografia/<?=get_alias($movie->tit_film)?>-<?=$movie->rowID?>/<?=$tool->rowID?>" target="_BLANK" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Cultura y sociedad - Ir a enlace')"><?=$json[115][$lang_j]?></a>
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

<?php include 'includes/footer.php'; ?>