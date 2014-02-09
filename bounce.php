<?require_once("conf/config_logged_in.php");
require_once("conf/db.php");?>
<?include("inc/header.php");
require 'vendor/autoload.php';


$user = 'osuhack';
$pass = 'osu_hack1';
$to                = 'agarwal.202@osu.edu';
$sendgrid = new SendGrid($sendgrid_username, $sendgrid_password, array("turn_off_ssl_verification" => true));
$email    = new SendGrid\Email();

$url = 'https://api.sendgrid.com/';
//api_user=your_sendgrid_username&api_key=your_sendgrid_password&date=1

$params = array(
    'api_user'  => $user,
    'api_key'   => $pass,
    'date'      => '1',
  );


$request =  $url.'api/bounces.get.json';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);

// print everything out
//print_r($response);

$jsonArray = json_decode($response);

foreach($jsonArray as $value){
	$email = $value->email;
//	$email = $value->reason;
//    $preferredUsername = $value->Preferred User;
//echo $email;

$sql ="DELETE FROM email_ids WHERE email = '".$email."'";
$res=mysql_query($sql);
echo $email."<br/>";
//echo " Due to $reason </br>";
}

print_r($obj);


?>




<div class="container">

</div>


