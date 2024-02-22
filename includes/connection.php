<?php
	include "oblicuasdk.php";
	include "sdk.php";
	$oreka=new O("d1eb63ddc08ca2f41401b60bc6b7fc87*1.3");
	$cinescuela =new Cinescuela();
	if($response->brand=="Marca no encontrada o entorno incorrecto")
	$lang="es";
	if(!isset($_GET['lang']) || empty($_GET['lang'])){
		$_GET['lang']="es";
		$lang = 'es';
	}
	if(isset($_GET['lang'])){
		$lang=$_GET['lang'];
	}
	$gnrl=$cinescuela->generalInfo[$lang];

	include 'functions.php';
	
?>