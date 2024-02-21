<?php
	@session_start();

	include 'includes/connection.php';
	if (isset($_SESSION['json_lan'])){
		//echo ' ya existia';
	}else{
		//echo 'lo setea';
		$json = read_json($json);
		$_SESSION['json_lan'] = $json;
	}

	$lang = filter_input(INPUT_GET, 'lang');
	$json = $_SESSION['json_lan'];
	$lang_ct = $lang;

	$token = filter_input(INPUT_GET, 'token');
	$user  = filter_input(INPUT_GET, 'user');
	$source  = filter_input(INPUT_GET, 'source');

	$url  = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_SPECIAL_CHARS);

	if(empty($token) && empty($user)){
?>
<section class="cont_login" id="login_section">
	<img src="images/site/logo.png" width="190" height="30" alt=""/>
	<h2><?=find_array($json,13, $lang_ct)?></h2><hr>
	<form action="login_bridge.php" method="post" name="loginForm" id="formLogin">
	<span class="warning" style="display: none;"><?=find_array($json,20, $lang_ct)?></span>
	<p>
		<label for="nom"><?=find_array($json,14, $lang_ct)?></label>
		<input type="text" id="nom" name="username" required />
		<span></span>
	</p>
	<p>
		<label for="pass"><?=find_array($json,15, $lang_ct)?></label>
		<input type="password" id="pass" name="password" required />
	</p>
	<p style="display: none;">
		<input type="text" name="url" value="dashboard/fr" hidden="hidden">	
	</p>
	<!--class="r_pass"-->
	<span><a href="javascript:;" id="aForgot"><?=find_array($json,22, $lang_ct)?></a></span>
	
	<p>
		<button class="btn" type="submit" id="btnLogin">
			<?=find_array($json,13, $lang_ct)?>
		</button>
	</p>
	</form>
</section>
<section class="cont_login" id="forgotSection">
	<img src="images/site/logo.png" width="190" height="30" alt=""/>
	<h2><?=find_array($json,24, $lang_ct)?></h2><hr>
	
	<form action="forgot_bridge.php" method="post" id="forgotForm">
	<p>
		<label for="nom"><?=find_array($json,25, $lang_ct)?></label>
		<input type="text" id="userforgot" name="userforgot"  required />
	<span><a href="javascript:;" id="arForgot"><-<?=find_array($json,32, $lang_ct)?></a></span>
	</p>
    <!--class="r_pass"--> 
    <p>
		<button class="btn" type="submit" id="btnForgot">
			<?=find_array($json,27, $lang_ct)?>
		</button>
	</p>
    
    </form>
</section>
<script>validateFormLogin();</script>
<div class="failed" style="display: none;">
	<span class="error"><?=find_array($json,29, $lang_ct)?></p></span>
</div>
<div class="success" style="display: none;">
	<h2 style="font-size: 1.1em;text-align: center;"><?=find_array($json,31, $lang_ct)?>.</h2>
</div>

<?php }else{

	$mytoken = $oreka->getByField($token,"tok_token",1,1,1,'lord','upward');
	if(is_array($mytoken)){
		
	$mytoken = $mytoken[0]->es;
	$auxexplode = explode(' ', $mytoken->tok_token);

	if($token == $auxexplode[0] && $user == $mytoken->user_token){
		echo 'token: '.$auxexplode[0].' user: '.$mytoken->user_token;
	?>
<section class="cont_login" id="renew_section">
	<img src="images/site/logo.png" width="190" height="30" alt=""/>
	<h2><?=find_array($json,93, $lang_ct)?></h2><hr>
    <form action="renew_bridge.php" method="post" name="renewForm" id="formRenew">
    <span class="warning" style="display: none;"><?=find_array($json,96, $lang_ct)?></span>
	
	<p>
		<label for="pass"><?=find_array($json,94, $lang_ct)?></label>
		<input type="password" id="pass" name="password" />
	</p>
	<p>
		<label for="pass"><?=find_array($json,95, $lang_ct)?></label>
		<input type="password" id="repass" name="repassword" />
	</p>
	<p style="display: none;">
		<input type="text" hidden name="userID" value="<?=$user?>">
		<input type="text" hidden name="token"  value="<?=$token?>">
		<input type="text" hidden name="action" value="changepass">
		<input type="text" name="source" value="<?=$source?>" hidden="hidden">	
	</p>
	<div id="feedback" style="display: none;">
		<h2>*<?=find_array($json,97, $lang_ct)?></h2>
	</div>
    <p>
		<button class="btn" type="submit" id="btnRenew">
			<?=find_array($json,98, $lang_ct)?>
		</button>
	</p>
    </form>
</section>
<script>validateRenewPass()</script>
<?php 	}}else{?>
	<section class="cont_login" id="renew_section">
	<img src="images/site/logo.png" width="190" height="30" alt=""/>
	<h2><?=find_array($json,99, $lang_ct)?></h2><hr>
</section>
<?php 	}?>
<?php }?>