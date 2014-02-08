<?
require_once("conf/config.php");
if($user->logged_in()){
	header('Location: index.php');
}
if($_POST[submit]){
    if($user->authenticate($_POST[email], $user->getHashedPassword($_POST[pass]))){
        header('Location: index.php');
    }
    else
        echo "Something went wrong";
}
?>
<?include("inc/header.php");?>
    <form method="POST" action="login.php">
        <h1>Log In</h1>
        <p>Email <input name="email" type="text" placeholder="Email" required /></p>   
        <p>Password<input name="pass" type="password" placeholder="Password" required /></p>
        <br />
        <input type="submit" name="submit" value="Log in" />
        <a href="">Forgot your password?</a> <a href="signup.php">Register</a>
    </form>
<?include("inc/footer.php");?>