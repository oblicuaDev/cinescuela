<?php
	//obtenemos el parámetro
	$articulo = $_GET['m'];
	$contenido = $_GET['from'];

	function obtenerCat($a) {
		/*--Cambia el Id del registro--*/
		switch ($a) {
			case '9':
				return 'educacion';
			case '4':
				return 'actualidad';
			default:
				return '';
		}
	}

	$id = obtenerCat($articulo);

	//Ahora sí, la redirección
	$url = 'http://cinescuela.org/es/'.$id;
	
	//echo $url.':P';
	header('Location: ' . $url, true, 301);
	die();
?>
