<?php
function currentURL(){
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	return $pageURL;
}
function changeLang($new){
	$newURL=str_replace("/".$_GET['lang']."/", "/".$new."/", currentURL());
	return $newURL;
}
function pager($currentPage,$totalPages)
{
	$cadena = '<ul>';
    if($currentPage>1){ 
		$cadena .='<li><a href="'.currentURL().'/pagina-'.($currentPage-1).'" class="prev">prev</a></li>';
    } 
    for($i=1;$i<=$totalPages;$i++){ 
    	$cadena .='<li><a href="'.currentURL().'/pagina-'.$i.'"'; 
		if($currentPage==$i){ $cadena .='class="active"'; }
		$cadena .='>'.$i.'</a></li>';
    } 
    if($currentPage<$totalPages){ 
		$cadena .='<li><a href="'.currentURL().'/pagina-'.($currentPage+1).'" class="next">next</a></li>';
    } 
	$cadena .='</ul>';
	if(isset($_GET['page'])){
		$cadena=str_replace('/pagina-'.$_GET['page'].'/', '/', $cadena);
	}
	echo $cadena;
}
function dev($dir){
	$dir=str_replace("123", "217", $dir);
	return str_replace("oreka_dev", "oreka", $dir);
}
function create_metas(){
	global $oreka,$metas,$gnrl,$category,$rows,$lang;
	$metas['analytics']='<script>(function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,"script","https://www.google-analytics.com/analytics.js","ga");</script>';
  	$langFound=false;
	//24=event 8=movie 6=cycle
	if(!( isset($_GET['cat']) && isset($_GET['rowID']) ) ){
		$metas['words']=$gnrl->keywseo_meta;
		$metas['desc']=$gnrl->metadseo_meta;
		$metas['title']=$gnrl->titseo_meta;
		$metas['img']=$gnrl->imgogseo_meta;
		$metas['dom']=$gnrl->domseo_meta;
	}
	if(isset($_GET['cat'])){
		$category=$oreka->getRows($_GET['cat']);
		if($category->es){
			$category=$category->es;
			$langFound=true;
		}
		else{
			$category=$category->es;
			$langFound=false;
		}
		$metas['words']=$category->keywseo_meta;
		$metas['desc']=$category->metadseo_meta;
		$metas['title']=$category->titseo_meta." - ".$gnrl->titseo_meta;
		$metas['dom']=$category->domseo_meta;
	}
	if(isset($_GET['rowID'])){
		$rows=$oreka->getRows($_GET['rowID']);
		if($rows->es){
			$rows=$rows->es;
			$langFound=true;
		}
		else{
			$rows=$rows->es;
			$langFound=false;
		}
	}
	if(isset($_GET['cat'])&&isset($_GET['rowID'])){
		$metas['words']=$rows->keywseo_meta;
		$metas['desc']=$rows->metadseo_meta;
		$metas['title']=$category->titseo_meta." - ".$rows->titseo_meta." - ".$gnrl->titseo_meta;
		$metas['img']=$rows->imgogseo_meta;
		$metas['dom']=$rows->domseo_meta;
	}
	echo '<meta charset="utf-8">';
	echo '<meta name="keywords" content="'.$metas['words'].'">';
	echo '<meta name="description" content="'.$metas['desc'].'">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">';
	echo '<title>'.$metas['title'].'</title>';
	echo $metas['analytics'];
	echo "<!--[if IE]>\n";
	echo "<script>";
	echo "\n\tdocument.createElement('header');\n\tdocument.createElement('footer');";
	echo "\n\tdocument.createElement('section');\n\tdocument.createElement('figure');\n\tdocument.createElement('aside');";
	echo "\n\tdocument.createElement('nav');\n\tdocument.createElement('article');";
	echo "\n</script>";
	echo "\n<![endif]-->";
}
function find_rowID($rowID,$rows){
	if(!is_array($rows)) return false;
	global $lang;
	$nrows=count($rows);
	for ($i=0; $i < $nrows; $i++) { 
		$row=$rows[$i]->es;
		if($row->rowID==$rowID){
			return true;
		}
	}
	return false;
}
function get_alias($String)
{
	$String = html_entity_decode($String); // Traduce codificación

	$String=str_replace("¡","&#161;",$String);//Signo de exclamación abierta.&iexcl;
	$String=str_replace("¢","-",$String);//Signo de centavo.&cent;
	$String=str_replace("£","-",$String);//Signo de libra esterlina.&pound;
	$String=str_replace("¤","-",$String);//Signo monetario.&curren;
	$String=str_replace("¥","-",$String);//Signo del yen.&yen;
	$String=str_replace("¦","-",$String);//Barra vertical partida.&brvbar;
	$String=str_replace("§","-",$String);//Signo de sección.&sect;
	$String=str_replace("¨","-",$String);//Diéresis.&uml;
	$String=str_replace("©","-",$String);//Signo de derecho de copia.&copy;
	$String=str_replace("ª","-",$String);//Indicador ordinal femenino.&ordf;
	$String=str_replace("«","-",$String);//Signo de comillas francesas de apertura.&laquo;
	$String=str_replace("¬","-",$String);//Signo de negación.&not;
	$String=str_replace("","-",$String);//Guión separador de sílabas.&shy;
	$String=str_replace("®","-",$String);//Signo de marca registrada.&reg;
	$String=str_replace("¯","&-",$String);//Macrón.&macr;
	$String=str_replace("°","-",$String);//Signo de grado.&deg;
	$String=str_replace("±","-",$String);//Signo de más-menos.&plusmn;
	$String=str_replace("²","-",$String);//Superíndice dos.&sup2;
	$String=str_replace("³","-",$String);//Superíndice tres.&sup3;
	$String=str_replace("´","-",$String);//Acento agudo.&acute;
	$String=str_replace("µ","-",$String);//Signo de micro.&micro;
	$String=str_replace("¶","-",$String);//Signo de calderón.&para;
	$String=str_replace("·","-",$String);//Punto centrado.&middot;
	$String=str_replace("¸","-",$String);//Cedilla.&cedil;
	$String=str_replace("¹","-",$String);//Superíndice 1.&sup1;
	$String=str_replace("º","-",$String);//Indicador ordinal masculino.&ordm;
	$String=str_replace("»","-",$String);//Signo de comillas francesas de cierre.&raquo;
	$String=str_replace("¼","-",$String);//Fracción vulgar de un cuarto.&frac14;
	$String=str_replace("½","-",$String);//Fracción vulgar de un medio.&frac12;
	$String=str_replace("¾","-",$String);//Fracción vulgar de tres cuartos.&frac34;
	$String=str_replace("¿","-",$String);//Signo de interrogación abierta.&iquest;
	$String=str_replace("×","-",$String);//Signo de multiplicación.&times;
	$String=str_replace("÷","-",$String);//Signo de división.&divide;
	$String=str_replace("À","a",$String);//A mayúscula con acento grave.&Agrave;
	$String=str_replace("Á","a",$String);//A mayúscula con acento agudo.&Aacute;
	$String=str_replace("Â","a",$String);//A mayúscula con circunflejo.&Acirc;
	$String=str_replace("Ã","a",$String);//A mayúscula con tilde.&Atilde;
	$String=str_replace("Ä","a",$String);//A mayúscula con diéresis.&Auml;
	$String=str_replace("Å","a",$String);//A mayúscula con círculo encima.&Aring;
	$String=str_replace("Æ","a",$String);//AE mayúscula.&AElig;
	$String=str_replace("Ç","c",$String);//C mayúscula con cedilla.&Ccedil;
	$String=str_replace("È","e",$String);//E mayúscula con acento grave.&Egrave;
	$String=str_replace("É","e",$String);//E mayúscula con acento agudo.&Eacute;
	$String=str_replace("Ê","e",$String);//E mayúscula con circunflejo.&Ecirc;
	$String=str_replace("Ë","e",$String);//E mayúscula con diéresis.&Euml;
	$String=str_replace("Ì","i",$String);//I mayúscula con acento grave.&Igrave;
	$String=str_replace("Í","i",$String);//I mayúscula con acento agudo.&Iacute;
	$String=str_replace("Î","i",$String);//I mayúscula con circunflejo.&Icirc;
	$String=str_replace("Ï","i",$String);//I mayúscula con diéresis.&Iuml;
	$String=str_replace("Ð","d",$String);//ETH mayúscula.&ETH;
	$String=str_replace("Ñ","n",$String);//N mayúscula con tilde.&Ntilde;
	$String=str_replace("Ò","o",$String);//O mayúscula con acento grave.&Ograve;
	$String=str_replace("Ó","o",$String);//O mayúscula con acento agudo.&Oacute;
	$String=str_replace("Ô","o",$String);//O mayúscula con circunflejo.&Ocirc;
	$String=str_replace("Õ","o",$String);//O mayúscula con tilde.&Otilde;
	$String=str_replace("Ö","o",$String);//O mayúscula con diéresis.&Ouml;
	$String=str_replace("Ø","o",$String);//O mayúscula con barra inclinada.&Oslash;
	$String=str_replace("Ù","u",$String);//U mayúscula con acento grave.&Ugrave;
	$String=str_replace("Ú","u",$String);//U mayúscula con acento agudo.&Uacute;
	$String=str_replace("Û","u",$String);//U mayúscula con circunflejo.&Ucirc;
	$String=str_replace("Ü","u",$String);//U mayúscula con diéresis.&Uuml;
	$String=str_replace("Ý","y",$String);//Y mayúscula con acento agudo.&Yacute;
	$String=str_replace("Þ","b",$String);//Thorn mayúscula.&THORN;
	$String=str_replace("ß","b",$String);//S aguda alemana.&szlig;
	$String=str_replace("à","a",$String);//a minúscula con acento grave.&agrave;
	$String=str_replace("á","a",$String);//a minúscula con acento agudo.&aacute;
	$String=str_replace("â","a",$String);//a minúscula con circunflejo.&acirc;
	$String=str_replace("ã","a",$String);//a minúscula con tilde.&atilde;
	$String=str_replace("ä","a",$String);//a minúscula con diéresis.&auml;
	$String=str_replace("å","a",$String);//a minúscula con círculo encima.&aring;
	$String=str_replace("æ","a",$String);//ae minúscula.&aelig;
	$String=str_replace("ç","a",$String);//c minúscula con cedilla.&ccedil;
	$String=str_replace("è","e",$String);//e minúscula con acento grave.&egrave;
	$String=str_replace("é","e",$String);//e minúscula con acento agudo.&eacute;
	$String=str_replace("ê","e",$String);//e minúscula con circunflejo.&ecirc;
	$String=str_replace("ë","e",$String);//e minúscula con diéresis.&euml;
	$String=str_replace("ì","i",$String);//i minúscula con acento grave.&igrave;
	$String=str_replace("í","i",$String);//i minúscula con acento agudo.&iacute;
	$String=str_replace("î","i",$String);//i minúscula con circunflejo.&icirc;
	$String=str_replace("ï","i",$String);//i minúscula con diéresis.&iuml;
	$String=str_replace("ð","i",$String);//eth minúscula.&eth;
	$String=str_replace("ñ","n",$String);//n minúscula con tilde.&ntilde;
	$String=str_replace("ò","o",$String);//o minúscula con acento grave.&ograve;
	$String=str_replace("ó","o",$String);//o minúscula con acento agudo.&oacute;
	$String=str_replace("ô","o",$String);//o minúscula con circunflejo.&ocirc;
	$String=str_replace("õ","o",$String);//o minúscula con tilde.&otilde;
	$String=str_replace("ö","o",$String);//o minúscula con diéresis.&ouml;
	$String=str_replace("ø","o",$String);//o minúscula con barra inclinada.&oslash;
	$String=str_replace("ù","o",$String);//u minúscula con acento grave.&ugrave;
	$String=str_replace("ú","u",$String);//u minúscula con acento agudo.&uacute;
	$String=str_replace("û","u",$String);//u minúscula con circunflejo.&ucirc;
	$String=str_replace("ü","u",$String);//u minúscula con diéresis.&uuml;
	$String=str_replace("ý","y",$String);//y minúscula con acento agudo.&yacute;
	$String=str_replace("þ","b",$String);//thorn minúscula.&thorn;
	$String=str_replace("ÿ","y",$String);//y minúscula con diéresis.&yuml;
	$String=str_replace("Œ","d",$String);//OE Mayúscula.&OElig;
	$String=str_replace("œ","-",$String);//oe minúscula.&oelig;
	$String=str_replace("Ÿ","-",$String);//Y mayúscula con diéresis.&Yuml;
	$String=str_replace("ˆ","-",$String);//Acento circunflejo.&circ;
	$String=str_replace("˜","-",$String);//Tilde.&tilde;
	$String=str_replace("–","-",$String);//Guiún corto.&ndash;
	$String=str_replace("—","-",$String);//Guiún largo.&mdash;
	$String=str_replace("'","-",$String);//Comilla simple izquierda.&lsquo;
	$String=str_replace("'","-",$String);//Comilla simple derecha.&rsquo;
	$String=str_replace("‚","-",$String);//Comilla simple inferior.&sbquo;
	$String=str_replace("\"","-",$String);//Comillas doble derecha.&rdquo;
	$String=str_replace("\"","-",$String);//Comillas doble inferior.&bdquo;
	$String=str_replace("†","-",$String);//Daga.&dagger;
	$String=str_replace("‡","-",$String);//Daga doble.&Dagger;
	$String=str_replace("…","-",$String);//Elipsis horizontal.&hellip;
	$String=str_replace("‰","-",$String);//Signo de por mil.&permil;
	$String=str_replace("‹","-",$String);//Signo izquierdo de una cita.&lsaquo;
	$String=str_replace("›","-",$String);//Signo derecho de una cita.&rsaquo;
	$String=str_replace("€","-",$String);//Euro.&euro;
	$String=str_replace("™","-",$String);//Marca registrada.&trade;
	$String=str_replace(":","-",$String);//Marca registrada.&trade;
	$String=str_replace(" & ","-",$String);//Marca registrada.&trade;
	$String=str_replace("(","-",$String);
	$String=str_replace(")","-",$String);
	$String=str_replace("?","-",$String);
	$String=str_replace("¿","-",$String);
	$String=str_replace(",","-",$String);
	$String=str_replace(";","-",$String);
	$String=str_replace("�","-",$String);
	$String=str_replace("/","-",$String);
	$String=str_replace(" ","-",$String);//Espacios
	$String=str_replace(".","",$String);//Punto
	
	//Mayusculas
	$String=strtolower($String);
	
	return($String);
}
function create_hash($usu,$type){
	// Activation type = 1
	// Forgot  type    = 2
	$fecharegistro = date("Y-m-d");

	$variableinterna = $usu.'-'.$type.'-'.$fecharegistro;
	$mihash = md5($variableinterna);
	
	return $mihash.' '.$variableinterna ;
}
	function read_json($array){
		$str = file_get_contents('js/data_static.json');
		$array = json_decode($str, true);
		return $array;
	}
	function find_array($array, $row, $lang){
		echo $array[$row][$lang];
	}
function getRealIP() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   
		{
			$ip_address = $_SERVER['HTTP_CLIENT_IP'];
		}
		//whether ip is from proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
		{
			$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		//whether ip is from remote address
		else
		{
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}
		return $ip_address;
}
function verifyIp($theip)
{
	global $oreka;
	//$ip = getRealIP();
	$ip = $theip;
	$user = $oreka->getByField('-'.$ip.'-','ips_user',1,1,1,'created','downward');
	if (is_array($user)) {
		return $user[0]->es;
	}else{
		return false;
	}
}
function setIp($userRowID)
{
	$ip = getRealIP();
	$ch = curl_init('http://orekacloud.com/p/custom_functions/217/set_ip.php');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"user":'.$userRowID.',"ip":"'.$ip.'"}');
    $ch_response = curl_exec($ch);
    
    curl_close($ch);
    return $ch_response;
}
?>