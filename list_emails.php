<?require_once("conf/config_logged_in.php");
require_once("conf/db.php");
?>
<?php include("inc/header.php");?>
    <div class="container">
<?php include("inc/navbar.php");

if (!isset ($_GET['list_name'])){
echo "Lis name not selected";
}
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * 20; 
$sql ="SELECT * FROM `email_ids` where user_id = '".$_SESSION[user_id]."' AND list_name ='".$_GET[list_name]."' ORDER BY name ASC LIMIT $start_from, 20;"; 
$rs_result = mysql_query ($sql); 
?> 
<table>
<tr><td>Name</td><td>Phone</td></tr>
<?php 
while ($row = mysql_fetch_assoc($rs_result)) { 
?> 
            <tr>
            <td><? echo $row["name"]; ?></td>
            <td><? echo $row["email"]; ?></td>
            </tr>
<?php 
} 
?> 
</table>
<?php
$sql = "SELECT COUNT(Name) FROM `email_ids` where user_id = '".$_SESSION[user_id]."' AND list_name ='".$_GET[list_name]."';"; 
$rs_result = mysql_query($sql);; 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / 20); 
  
for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='list_emails.php?page=".$i."&list_name=".$_GET['list_name']."'>".$i."</a> "; 
}; 
?>

</div>

<?include("inc/footer.php");?>
