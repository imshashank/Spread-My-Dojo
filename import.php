<?require_once("conf/config_logged_in.php")?>
<?php require_once('conf/db.php')?>
<?include("inc/header.php");?>
	<div class="container">
<?php include("inc/navbar.php");?>
<?php 
//echo "The id is" . $_SESSION[user_id]; 
?>
<br>
<div class="col-lg-12">
	<ul class="nav nav-pills">
	  <li <?=(($page == "import.php")?"class='active'":"")?> ><a href="import.php">Import</a></li>
	  <li <?=(($page == "market.php")?"class='active'":"")?>><a href="market.php">Market</a></li>
	  <li <?=(($page == "scheduled.php")?"class='active'":"")?>><a href="scheduled.php">Scheduled</a></li>
	  <li <?=(($page == "sent.php")?"class='active'":"")?>><a href="sent.php">Sent</a></li>
	</ul>
</div>
<br><br>
<div class="offset3 span6" style="margin-left: 30%;margin-top: 41px;">
<h2> Import Contacts to a list </h2>
<form action="import.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" >
<div class="form-group">
	<label for="list_name" class="col-sm-2 control-label">Enter a name for the List:</label>
	<div class="col-sm-10">
		<input type="text" id="list_name" name="list_name"><br>
	</div>
</div>
<div class="form-group">
	<label for="category" class="col-sm-2 control-label">Category</label>
	<div class="col-sm-10">
	<input type="text" id="category" name="category"><br>
	</div>
</div>
<div class="form-group">
<label for="file" class="col-sm-2 control-label" >Filename:</label>
	<div class="col-sm-10"><input type="file" name="file" id="file">
	</div>
</div>
<input type="submit" name="submit" value="Submit" style="margin-left: 134px;">
</form>
</div>
<?php

if(isset($_POST["list_name"])){
echo "List name" .$_POST["list_name"]."</br>";
$url = 'https://api.sendgrid.com/api/newsletter/lists/add.json';
$data = array("name" => $_POST["list_name"], "api_user" => "osuhack","api_key"=> "osu_hack1");

$response = sendPostData($url, $data);
print_r($response);
}
function sendPostData($url, $post){
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));
 return curl_exec($ch);
}

echo "Category is ". $_POST["category"]."</br>";
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
$row = 1;
if (($handle = fopen($_FILES["file"]["tmp_name"], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;

        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}

  }

?>
</body>
</html>
<?php
$row = 2;
if (($handle = fopen($_FILES["file"]["tmp_name"], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
/*        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
*/
//$query='INSERT INTO  `osuhack`.`email_ids` (`user_id` ,`list_name` ,`category` ,`name` ,`email`)VALUES ("'.$_SESSION[user_id].'",  "'.$_POST[list_name].'",  "'.$_POST[category].'",  "'$data[0]'", "'$data[1]'");';
$sql = "INSERT INTO `osuhack`.`email_ids` (`user_id`, `list_name`, `category`, `name`, `email`) VALUES ('".$_SESSION[user_id]."', '".$_POST[list_name]."', '".$_POST[category]."', '".$data[0]."', '".$data[1]."');";


echo $sql;
$res=mysql_query($sql);

   }
    fclose($handle);
}

//$res=mysql_query($query);



?>

</div>

<?php include("inc/footer.php");?>
