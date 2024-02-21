<?php
	include "sdk.php";
	$oreka=new O("d1eb63ddc08ca2f41401b60bc6b7fc87*1.3");

	
	//$response=$oreka->helloworld();

	
	if($response->brand=="Marca no encontrada o entorno incorrecto")
	
	//$_GET['lang'] = $_GET['lang'];
	$lang="es";
	if(!isset($_GET['lang']) || empty($_GET['lang'])){
		$_GET['lang']="es";
		$lang = 'es';
	}
	//echo $lang;
	if(isset($_GET['lang'])){
		$lang=$_GET['lang'];
	}
	$gnrl=$oreka->getRows(21808);
	$module=$oreka->getModule($gnrl->es->modID);
	if($module->lang_mod){
		$auxLang=$_GET['lang'];
		$gnrl=$gnrl->$auxLang;
	}
	else{
		$gnrl=$gnrl->es;
	};
	include 'functions.php';
	
?>