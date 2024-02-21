<?php if(!defined("CLASS_O")){
define("CLASS_O", 1);
class O { 
    public $accessToken = 0;
    public $environment = 0;
    public $b64 = 0;
    private $headers = array();
    const ACCESS_POINT = 'http://orekacloud.com/api/public/';
    public function __construct($CaccessToken,$Cenvironment=0,$Cb64=0) {
       
        $this->accessToken = $CaccessToken;
        $this->environment = $Cenvironment;
        $this->b64 = $Cb64;
        $this->headers = array('Access-token: '.$this->accessToken.'','Environment-set: '.$this->environment,'Content-Type: application/json');
    }
    /*,'Environment-set: '.$this->environment,'enable-b64: '.$this->b64*/
    public function helloworld()
    {
       $service_url = self::ACCESS_POINT.'v1/hello';
       $myresponse = $this->MakeGetCall($service_url);
        //echo "helloworld";
        return $myresponse;
    }
    public function getUser($userID)
    {
        $service_url = self::ACCESS_POINT.'v1/users/'.(string)$userID;
        return $this->MakeGetCall($service_url);
    }
    public function getRows($id)
    {
        $theID=(string)$id;
        $theID=urlencode($theID);
        $service_url = self::ACCESS_POINT.'v1/rows/'.$theID;
        $resp=$this->MakeGetCall($service_url);
        return $resp;
    }
    public function getCollection($moduleID,$sort,$orientation,$quantity,$page)
    {
        if($quantity<=50){
            $themodule=(string)$moduleID;
            $themodule=urlencode($themodule);
            $service_url = self::ACCESS_POINT.'v1/collection/'.$themodule.'/'.$sort.'/'.$orientation.'/'.$quantity.'/'.$page;
            $response = $this->MakeGetCall($service_url);
        }else
        {
           echo $response = "Requests over 50 rows are not permitted in Oreka Rest API.";
        }
        return $response;
    }
    public function getSearch($moduleID,$keyword,$date1="",$date2="")
    {
        $themodule=(string)$moduleID;
        $themodule=urlencode($themodule);
        $thevalue=(string)$keyword;
        $thevalue=urlencode($thevalue);
        $service_url = self::ACCESS_POINT.'v1/searches/'.$themodule.'/'.$thevalue;
        if($date1!=""){
            $service_url.='/'.$date1;
            if($date2!=""){
                $service_url.='/'.$date2;
            }
        }
        $resp=$this->MakeGetCall($service_url);
        return $resp;
    }
    public function getByField($value,$field,$type,$quantity,$page,$sort,$orientation,$bounded=0)
    {
        if($quantity<=50){
            $thevalue=(string)$value;
            $thevalue=urlencode($thevalue);
            $service_url = self::ACCESS_POINT.'v1_1/dev-searches/'.$thevalue.'/'.$field.'/'.$type.'/'.$bounded.'/'.$quantity.'/'.$page.'/'.$sort.'/'.$orientation;
            $response = $this->MakeGetCall($service_url);
        }else
        {
           $response = "Requests over 50 rows are not permitted in Oreka Rest API.";
        }
        return $response;
    }
    public function getByMultipleField($value,$field,$type,$quantity,$page,$sort,$orientation)
    {
        if($quantity<=50){
            $thevalue=(string)$value;
            $thevalue=urlencode($thevalue);
            $field=urlencode($field);
            $type=urldecode($type);
            $service_url = self::ACCESS_POINT.'v1/dev-searches-multiple/'.$thevalue.'/'.$field.'/'.$type.'/'.$quantity.'/'.$page.'/'.$sort.'/'.$orientation;
            $response = $this->MakeGetCall($service_url);
        }else
        {
           $response = "Requests over 50 rows are not permitted in Oreka Rest API.";
        }
        return $response;
    }
    public function getModule($id){
        $service_url=self::ACCESS_POINT."v1/modules/".(string)$id;
        return $this->MakeGetCall($service_url);
    }
    public function editRow($body)
    {
        $bodyi = json_encode($body);
        $service_url = self::ACCESS_POINT.'v1/edit';
        return $this->MakePutCall($service_url,$bodyi);
    }
    public function sendNotification($from,$to,$toname,$mergevariables,$subject,$template,$mandrillApiKey,$fromName="Oreka Notifications Service"){
        $body=array("from"=>$from,"to"=>$to,"toname"=>$toname,"subject"=>$subject,"template"=>$template,"mandrillapikey"=>$mandrillApiKey,"sender"=>$fromName);
        $merged=array();
        for($i=0;$i<count($mergevariables);$i++){
            $merged["pos".$i]=$mergevariables[$i];
        }
        $body["mergevariables"]=$merged;
        $service_url=self::ACCESS_POINT."v1/notifications";
        $body=json_encode($body);
        return $this->MakePostCall($service_url,$body);
    }
    public function deleteRow($rowID){
        $service_url=self::ACCESS_POINT."v1/delete/$rowID";
        return $this->MakePostCall($service_url);
    }
    public function postRow($modules, $rows, $idfies, $types, $values){
        
        $service_url=self::ACCESS_POINT."v1/create";
        $iRows=0;
        if(!is_array($modules)){
            $modules=[$modules];
            $rows=[$rows];
            $idfies=[$idfies];
            $ntypes=count(explode(",", $types));
            $types=[$types];
            $nvalues=count($values);
            if($ntypes==$nvalues)
                $values=[[$values]];
        }

        $data=new stdClass();
        $body=new stdClass();
        for ($i=0; $i < count($modules); $i++) { 
            $currFields=explode(",", $idfies[$i]);
            $currTypes=explode(",", $types[$i]);
            for ($j=0; $j < $rows[$i]; $j++) {
                $newrow=new stdClass();
                $newrow->module=$modules[$i];
                $newrow->types="";
                $newrow->values=new stdClass();
                $newrow->idfields=new stdClass();
                $newrow->typefields=new stdClass();
                for ($k=0; $k < count($currFields); $k++) { 
                    $newrow->values->{"val$k"}=$values[$i][$j][$k];
                    $newrow->idfields->{"id$k"}=$currFields[$k];
                    $newrow->typefields->{"type$k"}=$currTypes[$k];
                }
                $data->{"newrow$iRows"}=$newrow;
                $iRows++;
            }
        }
        $body->data=$data;

        $body=json_encode($body);
        return $this->MakePostCall($service_url,$body);
    }
    public function setValidity($rowID,$to,$from="same"){
        $service_url=self::ACCESS_POINT."v1/validity/".(string)$rowID."/$to/$from";
        return $this->MakePutCall($service_url);
    }
    public function setDraft($rowID,$draft=1){
        $service_url=self::ACCESS_POINT."v1/draft/".(string)$rowID."/$draft";
        return $this->MakePutCall($service_url);
    }
    public function destroy(){
        $service_url=self::ACCESS_POINT."destroy";
        return $this->MakeGetCall($service_url);
    }
    public function uploadImage($fullPath,$fileName,$type){
        $body=array('picture' =>curl_file_create($fullPath, $type, $fileName));
        $service_url=self::ACCESS_POINT."v1/upload-picture";
        return $this->UploadFile($service_url,$body);
    }
    public function uploadMedia($fullPath,$fileName,$type){
        $body=array('media' =>curl_file_create($fullPath, $type, $fileName));
        $service_url=self::ACCESS_POINT."v1/upload-media";
        return $this->UploadFile($service_url,$body);
    }
    public function uploadFiles($fullPath,$fileName,$type){
        $body=array('media' =>curl_file_create($fullPath, $type, $fileName));
        $service_url=self::ACCESS_POINT."v1/upload-files";
        return $this->UploadFile($service_url,$body);
    }
    public function MakeGetCall($url)
    {
       // echo "<br><br><br>".$url."<br><br><br>";
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://ws.cinescuela.org/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "method":"GET",
            "url":"'.$url.'",
            "theb":"{}"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        


        
        $decoded = json_decode($response);
        //print_r($decoded); 
        curl_close($curl);
        return $decoded;

    }
    
    public function MakePutCall($url,$body="{}")
    {
        //array_push($this->headers,'Content-Length: '.strlen($body));
        //array_push($this->headers,'Content-Type: application/json');
        
        $service_url = $url;
        $ch = curl_init($service_url);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        // curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        // curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        $ch_response = curl_exec($ch);
        
        curl_close($ch);
        
        $decoded = json_decode($ch_response);
        
        return $decoded;
    }
    public function MakePostCall($url,$body="{}"){
        //array_push($this->headers,'Content-Length: '.strlen($body));
        //array_push($this->headers,'Content-Type: application/json');
        $service_url = $url;
        $ch = curl_init($service_url);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        // curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        // curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        $ch_response = curl_exec($ch);
        
        curl_close($ch);
        $decoded = json_decode($ch_response);
        return $decoded; 
    }
    public function UploadFile($url,$body){
        $headers=array('Access-token: '.$this->accessToken.'','Environment-set: '.$this->environment,'Cache-Control: no-cache');
        $service_url = $url;
        $ch = curl_init($service_url);
        
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        // curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        // curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        $ch_response = curl_exec($ch);
        
        curl_close($ch);
        $decoded = json_decode($ch_response);
        return $decoded;
    }
}
} ?>