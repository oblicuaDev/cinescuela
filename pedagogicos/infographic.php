<?php include 'includes/header.php'; ?>

<!--Contenido general-->
<section id="main_container" class="interna">
	<!--interna-->
    <? $infographic = $oreka->getRows($_GET['i'])->es; ?>
	<div class="general-scroll">
		<div class="desc">
			<h2><?=$infographic->desc_culture?></h2>
			<!--Infografia-->
			<figure class="infografia">
				<img src="<?=dev($infographic->info_culture)?>" alt="<?=$infographic->tit_culture?>" class="img_info">
				<!--Items-->
				<!--Posibles posiciones de la casa de texto:
					left top, left center, left bottom
					right top, right center, right bottom
					center top, center bottom, center center-->
				<?
					for($l = 0;$l<5;$l++){ 
					if($infographic->{"desc".$l."_tooltip"}!=""){
					
					$position = explode(",",$infographic->{"pos".$l."_tooltip"});
					?>
					
                    
                    <div class="tooltip" style="top:<?=$position[1]?>px;left:<?=$position[0]?>px;">
					<button class="ico"></button>
					<div class="msn" data-position-x="right" data-position-y="center">
						<p><?=$infographic->{"desc".$l."_tooltip"}?></p>
                        <? 
							$vinculo = $infographic->{"link".$l."_tooltip"};
							if($vinculo!=""){
						?>
						<a href="<?=$vinculo?>" target="_blank" class="btn" onClick="ga('send', 'event', 'Acompañamiento pedagógico', 'click','Infographic - Ir a enlace')">Ir al enlace</a>
                        <? } ?>
						<span class="tri"></span>
                        </div>
                    </div>
                    
                    		
					<? } }
				?>
				<!--Fin Items-->
			</figure><!--Fin Infografia-->
		</div>
	</div><!--Fin interna-->
</section><!--Fin Contenido general-->

<?php include 'includes/footer.php'; ?>