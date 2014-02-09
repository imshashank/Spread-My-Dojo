<?
require_once("conf/config.php");
include("inc/header.php");


if(isset($_POST['signup'])){
	$error = array();

	


//print_r( $db->select("user", "pass, Fname, Lname" , "Email = '".$_POST['email']."' AND Password='".$_POST['pass'].'" , "" , "",  "1" ));

  $connection = mysqli_connect( "niesmocom.ipagemysql.com", "hack_2014_user", "hack_2014_pass", "hack_2014" );
  if($connection){
    //echo "we are connected<br>";
  }

  //$yoloswagdata= mysqli_query ($connection,"SELECT * FROM user WHERE Email = '".$_POST['email']."'");
  $yoloswagdata= mysqli_query ($connection,"SELECT Email, pass FROM user WHERE Email='".$_POST('email')."' AND pass='".$_POST('password')."'");
  $row = mysqli_fetch_array($yoloswagdata);


for($i =0;$i<$row->num_rows;$i++)
{
  echo mysqli_fetch_array($row);
}



}





?>


<html>
</body>

<form class="form-horizontal" role="form" method="post" action="log.php">
  <div class="form-group">
    <label for="Email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
    </div>
  </div>

    <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="password" name="password" placeholder="Password">
    </div>
  </div>





mk      <input type="submit" class="form-control"  name="signup">

</form>


  </body>
</html>