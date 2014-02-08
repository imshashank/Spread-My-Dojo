<?php 
$hostname="localhost";
$username="osuhack";
$password="osu_hack1";
$db='osuhack';

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
or die("Unable to connect to MySQL");
$selected = mysql_select_db($db,$dbhandle) ;
?>
