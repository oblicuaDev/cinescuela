<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1452288861719550&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function break_session()
{
	$("#sess").submit();
}
<? if($_GET['l']==1){ ?>
$(document).ready(function(e) {
    $(".open_login").trigger("click");
});
<? } ?>
var lang='<?=$_GET['lang']?>';
</script>
<header id="page_header">
	<!--Menu superior-->
	<div class="top_menu">
		<ul>
			<li>
				<ul class="networks">
					<li><a href="<?=$gnrl->face_gnrl?>" target="_blank" class="facebook" onClick="ga('send', 'event', 'Siguenos', 'click','facebook')">facebook</a></li>
					<li><a href="<?=$gnrl->twitt_gnrl?>" target="_blank" class="twitter" onClick="ga('send', 'event', 'Siguenos', 'click','twitter')">twitter</a></li>
					<li><a href="<?=$gnrl->chanYT_gnrl?>" target="_blank" class="youtube" onClick="ga('send', 'event', 'Siguenos', 'click','youtube')">youtube</a></li>
				</ul>
			</li>
			<? if($_SESSION['logged']['cod_us']>0){ ?>	
          	    <li><a href="<?=$_GET['lang']?>/usuario/<?=get_alias($_SESSION['logged']['usu_us'])?>" onClick="ga('send', 'event', 'Menú header', 'click','Mi Cinescuela')"><?=find_array($json, 7, $lang_ct)?></a></li>
            	<li><a href="javascript:;" style="cursor: default;" class="" onClick="ga('send', 'event', 'Menú header', 'click','<?=$_SESSION['logged']['usu_us']?>')"><?=$_SESSION['logged']['usu_us']?></a></li>
			<?php if($_GET['lang']=="es"){ ?>
			<!--<li><a href="<?=changeLang('fr')?>">Francia</a></li>-->
			<?	}else{ ?>
			<!-- <li><a href="<?=changeLang('es')?>">Latinoamérica</a></li> -->
			<?	} if(!isset($_SESSION['loggedByIp'])){ ?>
                <li><a href="javascript:break_session();" class="" onClick="ga('send', 'event', 'Menú header', 'click','Cerrar sesión')"><?=find_array($json, 1, $lang_ct)?></a></li>
            <? } }else{ 
				?>
			<?php if($_GET['lang']=="es"){ ?>
			<!-- <li><a href="<?=changeLang('fr')?>">Francia</a></li> -->
			<?	}else{ ?>
			<!-- <li><a href="<?=changeLang('es')?>">Latinoamérica</a></li> -->
			<?	} ?>
				<li><a href="login.php?lang=<?=$lang_ct?>" class="open_login" onClick="ga('send', 'event', 'Menú header', 'click','Iniciar sesión')"><?=find_array($json, 0, $lang_ct)?></a></li>
			<? } ?>
		</ul>
	</div><!--Fin Menu superior-->
    <form id="sess" action="break_session.php" method="post">
    	<input type="hidden" name="url" value="<?=$_GET['lang']?>/"/>
    </form>
	<!--Menu principal-->
	<nav id="main_menu">
		<div>
			<h2><a href="<?=$_GET['lang']?>/">Menu Principal</a></h2><button id="btn_menu"><?=find_array($json, 8, $lang_ct)?></button><!--
		 --><ul>
				<li><a <? if($_GET['cat']==12){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/informacion/12/cinescuela-10190">Cinescuela</a></li><!--
			 --><li><a <? if($_GET['cat']==19743){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/peliculas"><?=find_array($json, 2, $lang_ct)?></a></li><!--
			 --><li><a <? if($_GET['cat']==19744){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/ciclos"><?=find_array($json, 4, $lang_ct)?></a></li><!--
			 --><li><a <? if($_GET['cat']==15){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/educacion"><?=find_array($json, 5, $lang_ct)?></a></li><!--
			 --><li><a <? if($_GET['cat']==16){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/actualidad"><?=find_array($json,6, $lang_ct)?></a></li>
			</ul>
		</div>
	</nav><!--Fin Menu principal-->
</header>