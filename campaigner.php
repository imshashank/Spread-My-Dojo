<?require_once("conf/config_logged_in.php");
require_once("conf/db.php");
?>

<?include("inc/header.php");?>
    <div class="container">
	<?include("inc/navbar.php")?>
<?php
//show all Lists added by this user
$sql ="SELECT DISTINCT `list_name` FROM `email_ids` where user_id='".$_SESSION[user_id]."';";
//echo $sql;
$res=mysql_query($sql);
?>
<table>
<tr><td>List Name</td><td>Users</td></tr>

<?php
while($result=mysql_fetch_array($res)){

$query="SELECT COUNT(*) from `email_ids` where user_id='".$_SESSION[user_id]."' AND list_name='".$result[0]."';";

$r=mysql_query($query);
while($x=mysql_fetch_array($r)){
echo " <tr> <td><a href='list_emails.php?list_name=".$result[0] ."'>".$result[0]."</a></td><td> $x[0] </td></tr>";
}}
?>
</table>
</div>

<?include("inc/footer.php");?>
