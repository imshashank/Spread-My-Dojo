<?
require_once("conf/config.php");
include("inc/header.php");

if(isset($_POST['signup'])){
	$error = array();
	//print_r($_POST);
	//checking if they are the same pass
	if($_POST[pass] == $_POST[repass]){
		//create a new user
		$hashed_pass = sha1($_POST[pass]);
		//echo $hashed_pass;
		if(!$user->register_user($_POST[fname],$_POST[lname],$_POST[email],$hashed_pass)){
			$error[] = "Something went wrong!";
		}
	}
	else{
		$error[] = "Passwords DIDNOT Match!";
	}
	
	if(!empty($error)){
		foreach($error as $e){
			echo "<p>$e</p>";
		}
	}
	else{
		echo "<p>You have successfully created a new user</p>";
	}
	
}


?>

<form class="form-horizontal" role="form" method="post" action="signup.php">
  <div class="form-group">
    <label for="first_name" class="col-sm-2 control-label">First Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="first_name" name="fname" placeholder="First Name">
    </div>
  </div>
  <div class="form-group">
    <label for="last_name" class="col-sm-2 control-label">Last Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="last_name" name="lname" placeholder="Last Name">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="pass" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="re-password" class="col-sm-2 control-label">Verify Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="re-password" name="repass" placeholder="Password">
    </div>
  </div>
  <!--<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>-->
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="signup">Sign in</button>
    </div>
  </div>
</form>
<?include("inc/footer.php");?>