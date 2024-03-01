<?php 
include "../includes/oblicuasdk.php";
$cinescuela = new Cinescuela();
$posts = $cinescuela->getPeliculas("", $currentPage, 9, ['field'=>'pelicula_frances','value'=>1]);

echo $posts;