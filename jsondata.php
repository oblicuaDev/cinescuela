<?php 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token,Access-Control-Allow-Origin');
extract($_GET);
include "includes/sdk.php";
include 'includes/functions.php';

$oreka = new O("d1eb63ddc08ca2f41401b60bc6b7fc87*1.3");
$response = $oreka->getCollection(8,"lord","upward",0,1);
$subject = $oreka->getCollection(18,"created","upward",0,1);
$max = sizeof($response);
$maxSub = sizeof($subject);
$fData = array();
for ($i=0; $i < $max; $i++) { 
    $movie = $response[$i];
    $fData[$i]["author"] = $movie->es->direct_film;
    $fData[$i]["title"] = $movie->es->tit_film;
    $fData[$i]["edition"] = "";
    $fData[$i]["editorial"] = "";
    $fData[$i]["publication"] = $movie->es->year_film;
    $subjectsF = ""; 
    $currentSub = explode(",",$movie->es->subjects_film);
    // var_dump($currentSub);
    // echo "\n /curretn subject*** \n";

    for ($k=0; $k < sizeof($currentSub); $k++) { 
        for ($j=0; $j < $maxSub; $j++) { 
            // var_dump($subject[$j]->es->rowID);
            // echo " - ";
            // var_dump($currentSub[$k]);
            // echo "\n /compare subject*** \n";
            if ($subject[$j]->es->rowID == $currentSub[$k]) {
                if ($k === 0) {
                    $subjectsF = $subject[$j]->es->name_subject;
                }else{
                    $subjectsF = $subjectsF.",".$subject[$j]->es->name_subject;
                }       
            }
        }
    }
    $fData[$i]["subjects"] = $subjectsF;
    $des = strip_tags($movie->es->desc_film);
    // $fData[$i]["description"] = html_entity_decode($des);
    $fData[$i]["description"] = $des;
    // https://www.cinescuela.org/movie.php?cat=19743&rowID=220927&lang=es
    $fData[$i]["URI"] = "https://www.cinescuela.org/movie.php?cat=19743&rowID=".$movie->es->rowID."&lang=es";
}
echo json_encode($fData);
// if (is_array($movie)) {
//     $nombre=$movie[0]->tit_film;
//     var_dump($nombre);
// } else {
//     echo $movie->message; 
//     var_dump($movie);
// }

?>