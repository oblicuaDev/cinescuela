<?php include 'includes/connection.php'; ?>
<?php 
	/*{"data":{
			"newrow0":{
				"module":9,
				"idfields":{"id0" : 64, "id1" : 65, "id2" : 66, "id3" : 67, "id4" : 54},
				"typefields":{"type0" : "char_val", "type1" : "char_val", "type2" : "char_val", "type3" : "char_val", "type4" : "char_val"},
				"values":{"val0" : "hola", "val1" : "hola", "val2" : "hola", "val3" : "hola", "val4" : "hola"}
				}
			}
		}*/

		/*Se organizan los IDs*/
		$auxids     = '64,65,66,67,54';
		$explodeids = explode(',', $auxids);

		for ($i = 0; $i < count($explodeids) ; $i++) {
			$valaux  = 'id'.$i; 
			$aux-> $valaux = intval($explodeids[$i]);
		}
		$idfields->idfields = $aux;

		/*Se organizan los Types*/
		$auxtypes     = 'char_val,char_val,char_val,char_val,char_val';
		$explodetypes = explode(',', $auxtypes);

		for ($i = 0; $i < count($explodetypes) ; $i++) {
			$valaux  = 'type'.$i; 
			$aux1-> $valaux = $explodetypes[$i];
		}
		$typefields->typefields = $aux1;

		/*Se organizan los values*/
		$auxvalues     = 'hola,hola,hola,hola,hola';
		$explodevalues = explode(',', $auxvalues);

		for ($i = 0; $i < count($explodevalues) ; $i++) {
			$valaux  = 'val'.$i; 
			$aux2-> $valaux = $explodevalues[$i];
		}
		$values->values = $aux2;

		$row  = ["module"=>'9',"idfields"=>$aux,"typefields"=>$aux1,"values"=>$aux2];
		$data->newrow0 = $row;
		$body->data = $data;
		print_r(json_encode($body));
?>