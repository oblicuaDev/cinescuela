<?php 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token,Access-Control-Allow-Origin');
extract($_GET);
include "includes/sdk.php";
include 'includes/functions.php';

if (isset($app)) {
	$resp = setIp($user);
}else{
	session_start();
	$resp = setIp($_SESSION['logged']['cod_us']);
}

echo $resp;