<?require_once("conf/config_logged_in.php")?>

<?include("inc/header.php");?>
    <div class="container">
	<?include("inc/navbar.php")?>
<?php
//show all Lists added by this user
$sql ="SELECT DISTINCT `list_name` FROM `email_ids` where user_id='".$_SESSION[user_id]."'";

</div>

<?include("inc/footer.php")?>
