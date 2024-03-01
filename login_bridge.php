<?php
@session_start();

include ("includes/connection.php");

	$nameuser = filter_input(INPUT_POST, 'username');
	$user = $cinescuela->loginCinescuelaUser($nameuser);
	if(!is_array($user)){
		echo json_encode('0');
	}
	else{
		$user = $user[0];
		$passuser = md5(filter_input(INPUT_POST, 'password'));
		if(empty($user)){
			echo json_encode('0');
		}else{
			if($user->acf->usuario_activo == '1'){
				$ipVerified = true;
				if (isset($user->acf->ips) && $user->acf->ips !== '') {
					$ips = explode(',', $user->acf->ips);
					$theIp = '-'.getRealIP().'-';
					$ipVerified = in_array($theIp, $ips);
				}
				if($user->acf->contrasena_antigua == $passuser && $ipVerified){
					$_SESSION['logged']['cod_us'] = $user->id;
					$_SESSION['logged']['usu_us'] = $user->acf->primer_nombre;
					$_SESSION['logged']['pro_us'] = $user->acf->perfil_de_usuario;
					$_SESSION['logged']['region_us'] = $user->acf->region;
					$_SESSION['logged']['mail_us'] = $user->acf->correo_electronico;
					echo json_encode($user->acf->primer_nombre);
				}else{
					echo json_encode('0');
				}
			}else{
				if($user->acf->contrasena_antigua == $passuser){
					echo json_encode('2');
				}else{
					echo json_encode('0');
				}
			}
		}
	}
?>