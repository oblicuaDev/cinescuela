<?
$actividades = $contenido->actividades_complementarias;
if(!is_array($actividades)){$actividades=array($actividades);}
//$actividades = order_array_by_field($actividades,"orden-".$cat);
?>
<section class="act_comp">
				<h2>ACTIVIDADES COMPLEMENTARIAS</h2>
				<ul class="carrousel_act" id="car_<?=$i?>">
				<?php 
					for ($x=0; $x<count($actividades); $x++) { 
					$myac = $actividades[$x];
				?>
					<li class="general-scroll"><a href="javascript:;"><h3><?=$myac->post_title?></h3></a></li>
				<?php } ?>
				</ul>
			</section>
			<script>
				 var slider_<?=$i?> = $('#car_<?=$i?>').bxSlider({
					minSlides: 1,
					maxSlides: 4,
					slideWidth: 230,
					slideMargin: 0,
					controls:false,
					infiniteLoop:false,
					speed:1500
				});
				$("#tabs").on("tabsactivate",function(event,ui){slider_<?=$i?>.reloadSlider()});
				$(window).resize(function(){slider_<?=$i?>.reloadSlider()});
			</script>