<?php
	//obtenemos el parámetro
	$articulo = $_GET['a'];
	$contenido = $_GET['from'];

	function obtenerId($a) {
		/*--Cambia el Id del registro--*/
		switch ($a) {
			case '1518':
				return 'releve-210006';
			case '1527':
				return 'hyper-realidad-210013';
			case '1529':
				return 'airumakuchi-210010';
			case '320':
				return 'noche-herida-285';
			case '1151':
				return 'noche-herida-285';
			case '365':
				return 'en-lo-escondido-283';
			default:
				return 'hyper-realidad-210013';
		}
	}

	$id = obtenerId($articulo);

	//Ahora sí, la redirección
	if(empty($contenido)){
		$url = 'http://cinescuela.org/acompanamientos-pedagogicos/es/presentacion/'.$id;
	}elseif($contenido == 'culture'){
		$url = 'http://cinescuela.org/acompanamientos-pedagogicos/es/cultura-y-sociedad/'.$id;
	}
	
	//echo $url.':P';
	header('Location: ' . $url, true, 301);
	die();
?>
