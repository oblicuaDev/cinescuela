
<!--Banner pie de pagina-->
	<article class="banner_bottom">
          <figure><img src="<?=dev($gnrl->imgbanner_gnrl)?>" alt="<?=find_array($json,9, $lang_ct)?>"></figure>
		<div>
			<ul>
				<li><strong><?=$gnrl->numscho_gnrl?></strong><?=$gnrl->wordone_gnrl?></li>
				<li><strong><?=$gnrl->numcit_gnrl?></strong><?=$gnrl->wordtwo_gnrl?></li>
			</ul>
			<h2><?=$gnrl->footbanner_gnrl?></h2>
		</div><!--
	 --><div>
			<p><?=find_array($json,9, $lang_ct)?></p>
			<ul>
				<li><figure><img style="width:140px;" src="<?=dev($gnrl->logone_gnrl)?>"></figure></li>
				<li><figure><img style="width:140px;" src="<?=dev($gnrl->logtwo_gnrl)?>"></figure></li>
			</ul>
			<a href="<?=$_GET['lang']?>/informacion/12/cinescuela-21815" class="btn_more" onClick="ga('send', 'event', 'Banner home', 'click','Descubre mas - Cinescuela')"><?=$gnrl->textbutton_gnrl?></a>
		</div>
		<span class="overlay"></span>
	</article><!--Fin Banner pie de pagina-->
	
	<!--Menu principal pie de pagina-->
	<nav class="main_menu_footer">
		<ul>
        	<li><a <?php if($_GET['cat']==12){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/informacion/12/cinescuela-21815"><span></span>Cinescuela<hr></a></li><!--
		 --><li><a <?php if($_GET['cat']==19743){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/peliculas"><span></span><?=find_array($json,2, $lang_ct)?><hr></a></li><!--
		 --><li><a <?php if($_GET['cat']==19744){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/ciclos"><span></span><?=find_array($json,4, $lang_ct)?><hr></a></li><!--
		 --><li><a <?php if($_GET['cat']==15){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/educacion"><span></span><?=find_array($json,5, $lang_ct)?><hr></a></li><!--
		 --><li><a <?php if($_GET['cat']==16){ echo 'class="active"'; } ?> href="<?=$_GET['lang']?>/actualidad"><span></span><?=find_array($json,6, $lang_ct)?><hr></a></li>
		</ul>
	</nav><!--Menu principal pie de pagina-->
	
	<!--Pie de pagina-->
	<footer id="page_footer">
		<ul>
			<li><a href="<?=$_GET['lang']?>/informacion/13/acerca-de-21816" onClick="ga('send', 'event', 'Menú footer', 'click','Acerca de')"><?=find_array($json,10, $lang_ct)?></a></li><!--
		 --><li><a href="<?=$_GET['lang']?>/informacion/14/terminos-21817" onClick="ga('send', 'event', 'Menú footer', 'click','Términos legales')"><?=find_array($json,11, $lang_ct)?></a></li><!--
		<li><a href="info.php?a=13">Condiciones de uso</a></li>
		 --><li><a href="<?=$_GET['lang']?>/contacto" onClick="ga('send', 'event', 'Menú footer', 'click','Contacto')"><?=find_array($json,12, $lang_ct)?></a></li><!--
		 <?php if($_SESSION['logged']['cod_us']>0){ ?>
                --><li><a href="javascript:break_session();" class="" onClick="ga('send', 'event', 'Menú footer', 'click','Cerrar sesión')"><?=find_array($json,1, $lang_ct)?></a></li>
            <?php }else{ ?>
				--><li><a href="login.php?lang=<?=$lang_ct?>" class="open_login" onClick="ga('send', 'event', 'Menú footer', 'click','Iniciar sesión')"><?=find_array($json,0, $lang_ct)?></a></li>
			<?php } ?>
		</ul>
		<div><?php echo $gnrl->copyright_gnrl.' ' . date('Y');?></div>
	</footer>
	<!--Fin Pie de pagina-->
	
</div><!--Fin contenedor principal-->
<script src="js/oreka.js?1.1.2"></script>
<script src="js/interface.js?1.1.2"></script>
<script src="js/forms.js?1.1.2"></script>
</body>
</html>
<?php
//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
echo $ip_address;
echo $lang;

?>