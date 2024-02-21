<?php header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token,Access-Control-Allow-Origin');
extract($_GET);
include "includes/sdk.php";
include 'includes/functions.php';

$oreka = new O("d1eb63ddc08ca2f41401b60bc6b7fc87*1.3");
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$user = verifyIp($_GET['ip']);

if (isset($app)) {
	if ($user === false) {
		echo json_encode(['message'=>0,'ip'=>getRealIP(),'url'=>$actual_link]);
	}else{
		echo json_encode(['message'=>1,'user'=>$user,'ip'=>getRealIP()]);
	}
}else{
	if ($user === false) {
		echo '{"message":0, "ip":"'.getRealIP().'","url":"'.$actual_link.'"}';
	}else{
		session_start();
		$_SESSION['logged']['cod_us'] = $user->rowID;
		$_SESSION['logged']['usu_us'] = $user->firstname_user;
		$_SESSION['logged']['pro_us'] = $user->perfil_user;
		$_SESSION['logged']['region_us'] = $user->region_user;
		$_SESSION['logged']['mail_us'] = $user->mail_user;
		$_SESSION['loggedByIp'] = 1;
		
		echo '{"message":1, "name":"'.$user->firstname_user.'", "ip":"'.getRealIP().'","url":"'.$actual_link.'"}';
	}
}
