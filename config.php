<?
function __autoload($class)
{
    require_once (__DIR__ . "/../classes/" . $class . "_class.php");
}
#require("classes/Database_class.php");
#require("classes/User_class.php");

define ( DB_USER, "hack_2014_user" );
define ( DB_PASS, "hack_2014_pass" );
define ( DB_HOST, "niesmocom.ipagemysql.com" );
define ( DB_DB, "hack_2014");

$db = new Database ( DB_HOST, DB_USER, DB_PASS, DB_DB );
$user = new User($db);
?>