<?php
@session_start();

include ("includes/connection.php");

	$nameuser = filter_input(INPUT_POST, 'username');
	$user     = $oreka->getByField($nameuser,'name_user',1,1,1,'lord','upward',1);

	if(!is_array($user)){
		echo json_encode('0');
	}
	else{
		$user=$user[0]->es;
		$passuser = md5(filter_input(INPUT_POST, 'password'));
		$destino  = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_SPECIAL_CHARS);

		$urldestino = str_replace('https://quickin-apps.com/lab/development/cinescuela_site/', '', $destino);

		if(empty($user)){
			echo json_encode('0');
		}else{
			if($user->active_user == '1'){
				$ipVerified = true;
				if (isset($user->ips_user) && $user->ips_user !== '') {
					$ips = explode(',', $user->ips_user);
					$theIp = '-'.getRealIP().'-';
					$ipVerified = in_array($theIp, $ips);
				}
				if($user->pass_user == $passuser && $ipVerified){
					$_SESSION['logged']['cod_us'] = $user->rowID;
					$_SESSION['logged']['usu_us'] = $user->firstname_user;
					$_SESSION['logged']['pro_us'] = $user->perfil_user;
					$_SESSION['logged']['region_us'] = $user->region_user;
					$_SESSION['logged']['mail_us'] = $user->mail_user;
					echo json_encode($user->firstname_user);
				}else{
					echo json_encode('0');
				}
			}else{
				if($user->pass_user == $passuser){
					echo json_encode('2');
				}else{
					echo json_encode('0');
				}
			}
		}
	}
?>