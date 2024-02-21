<?php
	@session_start();
	include 'includes/connection.php';
	
	//Búsqueda del Usuario si coincide
	$user_search = filter_input(INPUT_POST, 'userforgot');
	$search = $oreka->getByField($user_search,'name_user',1,1,1,'lord','upward');

	if(!property_exists($search, 'message') && $search[0]->es->name_user == $user_search ){

		//Búsqueda del tipo de token
		$tipostoken = $oreka->getCollection(246, 'lord', 'upward', 20, 1);
		
		//Elimina tokens antiguos del usuario
		$tokens_act = $oreka->getCollection(245, 'lord', 'upward', 20, 1);

		if(is_array($tokens_act)){
			for ($i = 0; $i < count($tokens_act) ; $i++) { 
				if($tokens_act[$i]->es->user_token == $search[0]->es->rowID){
					$miedicion = $oreka->delete($tokens_act[$i]->es->rowID);
				}
			}
		}

		//print_r($tokens_act);

		//Creación del token
		$fecha = date("Y-m-d h:m:s");
		$myhash = create_hash($search[0]->es->rowID,$tipostoken[0]->es->rowID);

		// Busqueda plantilla notificación
		$template = $oreka->getRows(19844)->es;
		$vars     = $oreka->getRows($template->vars_template);
		
		//Edición de variables
		$explodetoken = explode(' ', $myhash);
		$hola = $vars[0]->es->content_vars.' '.$search[0]->es->name_user;
		$url  = 'http://cinescuela.org/?token='.$explodetoken[0].'&user='.$search[0]->es->rowID;
		$desc = str_replace('|url|', $url, $vars[2]->es->content_vars);

		$mergevariables = array(
			array('name'=>$vars[0]->es->main_fie,'content'=> $hola),
			array('name'=>$vars[1]->es->main_fie,'content'=> $vars[1]->es->content_vars),
			array('name'=>$vars[2]->es->main_fie,'content'=> $desc),
			array('name'=>$vars[3]->es->main_fie,'content'=> $vars[3]->es->content_vars),
			array('name'=>$vars[4]->es->main_fie,'content'=> $vars[4]->es->img_vars),
			array('name'=>$vars[5]->es->main_fie,'content'=> $vars[5]->es->img_vars)
		);

		//Notificación Oreka
		$notification = $oreka->sendNotification('multimedia6@quickin.co',
											$search[0]->es->mail_user,
											$search[0]->es->firstname_user,
											$mergevariables,
											$template->name_template,
											$template->tempkey_template,
											$template->apikey_template,
											$template->name_template);

		//Inserción en Oreka
		$idfies   = '549,547,548,550';
		$typefies = 'char_val,val_val,val_val,date_val';
		$values   = array($myhash,$tipostoken[0]->es->rowID,$search[0]->es->rowID,$fecha);

		$myinsert  = $oreka->postRow('245','1', $idfies , $typefies, $values);

		echo json_encode('listo');
	}else{
		echo json_encode('fail');
	}
?>