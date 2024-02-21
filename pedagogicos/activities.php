<?
$actividades = $oreka->getRows($thecontent->{"acticomp".$i.$sufix});
if(!is_array($actividades)){$actividades=array($actividades);}
//$actividades = order_array_by_field($actividades,"orden-".$cat);
?>
<section class="act_comp">
				<h2><?=$language->tr15_langs?></h2>
				<ul class="carrousel_act" id="car_<?=$i?>">
				<?php for ($x=0; $x<count($actividades); $x++) { 
				//echo $actividades[$x]."-".get_campo_adicional($pest,$actividades[$x],0)." - ".$thecontent[$i]."<br>";
					$myac = $actividades[$x]->es;
					$link = ($myac->link_actcomp==""||$myac->link_actcomp==" ")?"javascript:;" : $myac->link_actcomp;
					if($link!="javascript:;"){
						if(strpos($link, "http")===false){
							$link = "http://".$link;
						}
					}
				?>
					<li class="general-scroll">
						<a target="_BLANK" href="<?=$link?>"><h3><?=$myac->desc_actcomp?></h3></a>
					</li>
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