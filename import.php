<?require_once("conf/config_logged_in.php")?>
<?php require_once('conf/db.php')?>
<html>
<body>
<?php 
echo "The id is" . $_SESSION[user_id]; 
?>
<form action="import.php" method="post"
enctype="multipart/form-data">
List Namw: <input type="text" name="list_name"><br>
Category: <input type="text" name="category"><br>

<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>

<input type="submit" name="submit" value="Submit">
</form>

<?php

echo "List name" .$_POST["list_name"]."</br>";
if(isset($_POST["list_name"])){
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
$row = 1;
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
