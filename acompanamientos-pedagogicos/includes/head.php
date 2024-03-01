<?
	@session_start();
	include ("../includes/connection.php");
	$lang_j=$_GET['lang']; 
	$json=json_decode(file_get_contents('../js/data_static.json'),true);
	var_dump($cinescuela);
	$movie_ap = $cinescuela->getAP($_GET['rowID']);
	var_dump($_GET['rowID']);
	var_dump($movie_ap['response']);
?>
<!DOCTYPE HTML>
<html>
<head>
	<base href="/acompanamientos-pedagogicos/">
	<?php 
		create_metas(); 
	?>
<?php if( !((($_SESSION['logged']['cod_us']>0 || $_SESSION['logged']['cod_us'] !="") && $movie->private_notice==1) || $movie->private_notice==0) ){ ?>
	<script>location.href="../<?=$_GET['lang']?>/pelicula/<?=get_alias($movie->tit_film)?>-<?=$rowID?>";</script>
<?php } ?>
    <!-- Metatags Facebook -->
	<meta property="og:image" content="<?=$metas['img']?>" />
    <meta property="og:title" content="<?=$metas['title']?>" />
    <meta property="og:url" content="<?=currentURL()?>" />
    <meta property="og:description" content="<?=$metas['desc']?>" />
    <!-- Metatags Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@nestorhez">
    <meta name="twitter:creator" content="@nestorhez">
    <meta name="twitter:title" content="<?=$metas['title']?>">
    <meta name="twitter:description" content="<?=$metas['desc']?>">
    <meta name="twitter:image:src" content="<?=$metas['img']?>">

	<link rel="icon" href="../favicon.ico">
	<!--Estilos Plugins-->
	<link href="css/reset.css" rel="stylesheet">
	<link href="css/perfect-scrollbar.min.css" rel="stylesheet">
	<link href="css/colorbox.css" rel="stylesheet">
	<link href="css/jquery.bxslider.css" rel="stylesheet">
	<!--Estilos generales-->
	<link href="css/styles_acpe.css" rel="stylesheet">

	<!--Librerias/scripts-->
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/modernizr.custom.61835.js"></script>
	<script src="js/prefixfree.min.js"></script>
	<script src="js/perfect-scrollbar.min.js"></script>
	<script src="js/jquery.bxslider.min.js"></script>
	<script src="js/jquery.colorbox-min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/imagesloaded.pkgd.min.js"></script>
	<!--funciones interfaz grafica-->
	<script src="js/interface_acpe.js"></script>
	
	<!--	Track para google analytics de youtube y vimeo-->
	<script src="js/vimeo.ga.min.js"></script>
	<script src="js/lunametrics-youtube.gtm.min.js"></script>
	
</head>

<!--id="light" para estilo blanco, para estilo oscuro sin id-->
<body <? if($movie->theme_film){ echo ' id="light" ';} ?>>
<!--Facebook sdk-->
<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '624279207678314',
          xfbml      : true,
          version    : 'v2.1'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
	   
	   
	   function facebook_share(url)
	   {
		 FB.ui({
		  method: 'share',
		  href: url,
		}, function(response){}); 
		 
		}
    </script>
    <!-- Cierra facebook SDK -->
<!-- Twitter SDK -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<!--Loading page-->
<div id="loading_page"><span><?=$json[52][$lang_j]?> <?=$movie->tit_film?></span></div><!--Fin Loading page-->
<!--Contenedor principal-->
<div id="main_wrapper">