<?php
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	@session_start();
	include 'connection.php';
	$json = read_json($json);
	$_SESSION['lang'] = $lang_ct;
	$lang_ct = filter_input(INPUT_GET,'lang');
?>
<!DOCTYPE HTML>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<? if (empty($token) && empty($user)) { ?>
	<base href="/">
	<?php } ?>
	<? if($_SESSION['logged']['cod_us']>0) { ?>
	<script>ga('create', 'UA-29442208-8', { 'userId': '<?=$_SESSION['logged']['cod_us']."-".$_SESSION['logged']['usu_us']?>' });	 </script>
	<? }else { ?>
	<script>ga('create', 'UA-29442208-8','auto');</script>
	<? } ?>
	<? create_metas();?>
	<link rel="icon" href="favicon.ico">
	<!--Estilos Plugins-->
	<link href="css/jquery.bxslider.css" rel="stylesheet">
	<link href="css/colorbox.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet">
	<link href="css/jquery-ui.structure.min.css" rel="stylesheet">
	<link href="css/perfect-scrollbar.min.css" rel="stylesheet">	
	<!--Estilos generales-->
	<link href="css/reset.css" rel="stylesheet">
	<link href="css/styles.css?v=<?=time()?>" rel="stylesheet">
	
	<!--Librerias plugins-->
	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/modernizr.custom.61835.js"></script>
	<script src="js/prefixfree.min.js"></script>
	<script src="js/underscore-min.js"></script>
	<script src="js/jquery.bxslider.min.js"></script>
	<script src="js/jquery.colorbox-min.js"></script>
	<script src="js/perfect-scrollbar.min.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/jquery.form.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<!--	Track para google analytics de youtube y vimeo-->
	<script src="js/vimeo.ga.min.js"></script>
	<script src="js/lunametrics-youtube.gtm.min.js"></script>
	<!--js Interfaz grafica-->
   		 <script>
        var myuVar = "";
        </script>
    <?
		if($_SESSION['logged']['cod_us']>0)
		{ ?>
		<script>
        var myuVar = "c161803-<?=$_SESSION['logged']['cod_us']?>";
        </script>
		<? }else{ 
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}
		  echo $ip_address;
		?>
		<script>
	    	$(()=>{
	    		$.get('verify?ip=<?php echo $ip_address; ?>',resp=>{
	    			if (resp.message == 1) {
	    				location.href = language+"/usuario/"+get_alias(resp.name);
	    			}
	    		});
	    	});
		</script>
		<? } ?>
	<meta name="google-site-verification" content="VBpQwnVy9nWdM4RWsoLxyZIM_WPBInjAA59fcmgpqyM" />
	<script type="text/javascript">var language = <?php echo json_encode($lang_ct); ?>;</script>
	<? if($_SESSION['logged']['cod_us']>0){ ?>
		<script>
		 ga('create', 'UA-29442208-8', { 'userId': '<?=$_SESSION['logged']['cod_us']."-".$_SESSION['logged']['usu_us']?>' });
		</script>
	<? }else { ?>
	<script>
    	ga('create', 'UA-29442208-8','auto');
    </script>
	<? } ?>
	<script> ga('send', 'pageview'); </script>
</head>

<body>
	<!--Facebook sdk-->
	<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '624279207678314',
          xfbml      : true,
          version    : 'v2.2'
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