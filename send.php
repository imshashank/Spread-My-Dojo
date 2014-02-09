<?php
require 'vendor/autoload.php';
//Dotenv::load(__DIR__);

$sendgrid_username = 'osuhack';
$sendgrid_password = 'osu_hack1';
$to                = 'agarwal.202@osu.edu';

$sendgrid = new SendGrid($sendgrid_username, $sendgrid_password, array("turn_off_ssl_verification" => true));
$email    = new SendGrid\Email();
$email->addTo($to)->
       setFrom($to)->
       setSubject('[sendgrid-php-example] Owl')->
       setText('Owl are you doing?')->
       setHtml('<strong>%how% are you doing?</strong>')->
       addSubstitution("%how%", array("Owl"))->
       addMessageHeader('X-Sent-Using', 'SendGrid-API')->
       addMessageHeader('X-Transport', 'web');
//       addAttachment('./gif.gif', 'owl.gif');

$response = $sendgrid->web->send($email);
var_dump($response);
