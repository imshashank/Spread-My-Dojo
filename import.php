<?require_once("conf/config_logged_in.php")?>
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
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
?>