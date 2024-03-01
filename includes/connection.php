<?php
	include "oblicuasdk.php";
	$cinescuela =new Cinescuela();
	$lang="es";
	if(!isset($_GET['lang']) || empty($_GET['lang'])){
		$_GET['lang']="es";
		$lang = 'es';
	}
	if(isset($_GET['lang'])){
		$lang=$_GET['lang'];
	}
	$gnrl = $cinescuela->generalInfo;
	include 'functions.php';
?>