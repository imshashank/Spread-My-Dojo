<?
function __autoload($class)
{
    require_once (__DIR__ . "/../classes/" . $class . "_class.php");
}
#require("classes/Database_class.php");
#require("classes/User_class.php");

define ( DB_USER, "osuhack" );
define ( DB_PASS, "osu_hack1" );
define ( DB_HOST, "localhost" );
define ( DB_DB, "osuhack");

$db = new Database ( DB_HOST, DB_USER, DB_PASS, DB_DB );
$user = new User($db);
$product = new Product($db);
$category = new Category($db);
$email_template =  new EmailTemplate($db);
$schedule =  new Schedule($db);

?>