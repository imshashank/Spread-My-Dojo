<html>
<body>

<form action="import1.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>

<?php
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
  }
?>

<?php 

    if( ! $xml = simplexml_load_file($_FILES["file"]["tmp_name"]) ) 
    { 
        echo 'unable to load XML file'; 
    } 
    else 
    { 
        foreach( $xml as $user ) 
        { 
            echo 'Firstname: '.$user->firstname.'<br />'; 
            echo 'Surname: '.$user->surname.'<br />'; 
            echo 'Email: '.$user->email.'<br />'; 
            echo 'Country: '.$user->country.'<br />'; 
        } 
    } 

?> 
