<?php
function fillMergeVars($rows,$add){
	$ar=array();
	for ($i = 0; $i < count($rows); $i++) {
		$row=$rows[$i]->es;
		if($add&&$row->name_vars=="fname"){
			$var=array('name'=>$row->name_vars,'content'=> $row->content_vars.$add);
			array_push($ar, $var);
		}
		else{
			$var=array('name'=>$row->name_vars,'content'=> $row->content_vars);
			array_push($ar, $var);
		}
	}
	return $ar;
}
include 'includes/connection.php';
session_start();
extract($_POST);
$files=$oreka->postRow(244, 1, 341, "char_val", array($download));
$values=array($nom,$description,$trailer,$director,$tags,$country,$year,$mins,$body,$files->rowID);

$template=$oreka->getRows("213915,213909");
$vars=$oreka->getRows($template[0]->es->vars_template);
$mergevariables=fillMergeVars($vars,$_SESSION['logged']['usu_us']);/**/
$notification=$oreka->sendNotification("multimedia5@quickin.co",$_SESSION['logged']['mail_us'],$_SESSION['logged']['usu_us'],$mergevariables,$template[0]->es->name_template,$template[0]->es->tempkey_template,$template[0]->es->apikey_template,"Cinescuela");
$vars=$oreka->getRows($template[1]->es->vars_template);
$mergevariables=fillMergeVars($vars,"Administrador");
$desc=array("name"=>"desc","content"=>"El usuario ".$_SESSION['logged']['usu_us']." ha subido una nueva película con el nombre: ".$nom.".<br>Recuerda llenar los datos adicionales de la película y activarla para que todos puedan verla.<br>El link con los archivos relacionados de la película los puedes encontrar en Oreka en la ruta Inicio > Parámetros > Archivos de peliculas, con el nombre: ".$download);
array_push($mergevariables, $desc);
$notification=$oreka->sendNotification("multimedia5@quickin.co","cinescuela@mediodecontencion.com","Administrador Cinescuela",$mergevariables,$template[1]->es->name_template,$template[1]->es->tempkey_template,$template[1]->es->apikey_template);
$idfies="37,33,36,38,44,39,84,40,41,342";
$types="char_val,char_val,char_val,char_val,char_val,char_val,char_val,char_val,char_val,val_val";
$rowID=$oreka->postRow(8, 1, $idfies, $types, $values)->rowID;
$message=$oreka->setDraft($rowID)->message;
echo $rowID.": ".$message;
?>