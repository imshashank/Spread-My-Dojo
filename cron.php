<?require_once("conf/config_logged_in.php");
require_once("conf/db.php");
include("inc/header.php");
require 'vendor/autoload.php';

$sendgrid_username = 'osuhack';
$sendgrid_password = 'osu_hack1';
$to                = 'agarwal.202@osu.edu';
$sendgrid = new SendGrid($sendgrid_username, $sendgrid_password, array("turn_off_ssl_verification" => true));
$email    = new SendGrid\Email();

?>
<div class="container">
<?php include("inc/navbar.php");?>

<?php
//search for any email campaign to be sent

//check where time is smaller then current


//import email from the email DB and start sending

date_default_timezone_set('America/New_York');
$today = date("Y-m-d H:i:s");
$today_time = strtotime($today);

$sql="select * from `scheduler` where flag=0 && time <'".$today."' ORDER BY time ASC; ";
echo $sql;

$res=mysql_query($sql);

while($result=mysql_fetch_array($res)){
//check if time is smaller then this
//send email_id to list_name
$list_name=$result[4];
$email_id=$result[3];
$publisher=$result[1];
$campaigner=$result[2];
$product_id=$result[7];
echo $email_id;
$q="Select * from email_ids where list_name='".$list_name."' LIMIT 0, 10000;";
echo $q;
$q=mysql_query($q);
while($r=mysql_fetch_array($q)){
//echo $[0];
$name=$r[3];
$mail=$r[4];
$y= "SELECT * from email_templates where EmailTemplateID ='".$email_id."'";
echo $y;
$y=mysql_query($y);
while($x=mysql_fetch_array($y)){
$body=$x[2];
$body=base64_decode($body);
$subject=$x[1];
}
echo "</br> Sending email to $mail and $name with subject $subject and $body";
$sendgrid_username = 'osuhack';
$sendgrid_password = 'osu_hack1';
$to                = 'agarwal.202@osu.edu';
$from= 'mail@spreadmydojo.com';

$link="http://spreadmydojo.com/pay.php?publisher='".$publisher."'&campaigner='".$campaigner."'&product_id='".$product_id."'";
echo $link;
$array = array("$link");
$sendgrid = new SendGrid($sendgrid_username, $sendgrid_password, array("turn_off_ssl_verification" => true));
$email    = new SendGrid\Email();
$email->addTo($mail)->
       setFrom($from)->
       setSubject($subject)->
       setText('Please switch to HTML version to see the full email')->
       setHtml($body)->
       addSubstitution("%link%", $array)->
       addMessageHeader('X-Sent-Using', 'SendGrid-API')->
       addMessageHeader('X-Transport', 'web');
//       addAttachment('./gif.gif', 'owl.gif');

$response = $sendgrid->web->send($email);
var_dump($response);
$m="UPDATE scheduler SET flag = 3 WHERE email_id = '".$email_id."';";
echo $m;
$n=mysql_query($m);
}

}

?>
</div>

<?php include("inc/footer.php");?>

