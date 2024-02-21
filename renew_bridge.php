<?php
	include 'includes/connection.php';

	$password = filter_input(INPUT_POST, 'password');
	$usuario  = filter_input(INPUT_POST, 'userID');
	$token    = filter_input(INPUT_POST, 'token');
	$action   = filter_input(INPUT_POST, 'action');
	$source   = filter_input(INPUT_POST, 'source');

	if(!empty($password) && !empty($usuario)){

		$mytoken = $oreka->getByField($token,"tok_token",1,1,1,'lord','upward');
		
		$body_ed->rowid = 255;
		$body_ed->return = 'gimmeASignal';
		
		$values->val0 = md5($password);
		$idfies->id0  = 70;
		$types->type0 = 'char';
		
		$body_ed->idfies =$idfies;
		$body_ed->values =$values;
		$body_ed->types =$types;

		$miedicion = $oreka->editRow($body_ed);

		$midelete  = $oreka->delete($mytoken[0]->es->rowID);
		echo json_encode('listo');
	}

?>