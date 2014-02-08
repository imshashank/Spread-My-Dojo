<?php


$data = array("name" => "hacking", "api_user" => "osuhack","api_key"=> "osu_hack1");                                                                    
$data_string = json_encode($data);                                                                                   
 
$ch = curl_init('https://api.sendgrid.com/api/newsletter/lists/add.json');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   
 
$result = curl_exec($ch);

/*

$url = 'https://api.sendgrid.com/api/newsletter/lists/add.json';
$data = array("name" => "hacking", "api_user" => "osuhack","api_key"=> "osu_hack1");

$response = sendPostData($url, $data);
print_r($response);
function sendPostData($url, $post){
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));
 return curl_exec($ch);
}
*/

?>
