<section class="cont_login">
	<img src="images/site/logo.png" width="190" height="30" alt=""/>
	<h2>RECORDAR CONTRASEÑA</h2><hr>
    
    <form action="forgot_bridge.php" method="post">
    <? if($_GET['l']==1){ ?>
    <span class="warning" style="background-color:#D4FFDB; color:#417248;">Hemos enviado una nueva contraseña a tu correo electrónico.</span>
	<? } ?>
     <? if($_GET['l']==2){ ?>
    <span class="warning">El usuario que escribiste no existe. <a style="text-decoration:underline;" href="index.php?f=-1">Inténtalo de nuevo</a></span>
	<? } ?>
    <? if($_GET['l']==-1){ ?>
	<p>
		<label for="nom">Nombre de usuario</label>
		<input type="text" id="nom" name="usern"  required />
	</p>
    <!--class="r_pass"--> 
    <p>
		<input class="btn" type="submit" value="Recordar contraseña">
	</p>
    <? } ?>
    </form>
</section>