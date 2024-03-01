<?php include 'includes/head.php'; 
$rowID = $_GET['rowID']; 
$movie = $cinescuela->getPeliculas($rowID, 1, 1);
?>
<!--Contenedor principal-->
<div id="main_container">
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->
	<article class="intern general">
 
		<h2>Reproduciendo <?=$movie->title->rendered?></h2>
        <? if($_SESSION['logged']['cod_us']>0 || $_SESSION['logged']['cod_us'] !=""){
			?>
            <figure>
            <h6><?=$_SESSION['logged']['usu_us']?></h6>
			<?=$movie->acf->iframe?>
       <!-- <div id='playermntoEfApuiUt'></div>-->
		<!--<script type='text/javascript'>
            jwplayer('playermntoEfApuiUt').setup({
                file: '<?// campo_adicional("video-file",$_GET['a']); ?>',
                title: '<?=$spina_post['title']?>',
                width: '100%',
                aspectratio: '16:9',
                autostart: 'true',
				skin:'vapor'
            });
        </script>-->
		<!--<script type="application/javascript" src="//content.jwplatform.com/players/57TyccEf-pY6etSeW.js"></script>-->
        </figure>
        
            <!-- <div class="intro">
                Para ver esta película debes haberla adquirido. Si crees que es un error puedes <a href="<?=$_GET['lang']?>/contacto">contactarnos aquí</a>
            </div> -->
        <? 
		}else{ //Si no hay sesión ?>
        <div class="intro">
                Para ver películas debes haber iniciado sesión con tu cuenta.
            </div>
        <? } ?>
	</article><!--Fin Contenido interna-->

<?php include 'includes/footer.php'; ?>