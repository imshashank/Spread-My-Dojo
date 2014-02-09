<?require_once("conf/config_logged_in.php")?>
<?if(isset($_GET['p']))
	$p_id =$_GET['p'];
elseif(isset($_POST['p'])){
	$p_id = $_POST['p'];
	unset($_POST['p']);
}
else{
	die("No product id was feeded! try to go to the index again!");
}
	
?>
<?
if(isset($_POST['save'])){
	unset($_POST['save']);
	foreach($_POST as $key=>$value){
		if(isset($_POST[$key])){
			$data = explode('_',$key);
			if(is_numeric($data[0])){
				$email_template->update_template($_POST[$data[0]."_subject"],$_POST[$data[0]."_body"], $_POST[$data[0]."_day"],$data[0],$p_id);
				unset($_POST[$data[0]."_subject"]);
				unset($_POST[$data[0]."_body"]);
				unset($_POST[$data[0]."_day"]);
			}
		}
	}
}
?>
<?include("inc/header.php");?>
	<div class="container">
		<?include("inc/navbar.php")?>
		<?$data=explode('/',$_SERVER['REQUEST_URI']);
		  $page = $data[count($data)-1];?>
			<div class="row">
				<br>
				<div class="col-lg-12">
					<ul class="nav nav-pills">
					  <li <?=(($page == "publisher.php")?"class='active'":"")?> ><a href="publisher.php">Market Place</a></li>
					  <li <?=(($page == "product.php")?"class='active'":"")?>><a href="product.php">Add Product</a></li>
					</ul>
				</div>
				<br><br><br>
				<div class="col-lg-12">
				<form role="form" method="POST" action="edit_emails.php">
				<input type="hidden" name="p" value="<?=$p_id?>">
					<?
					$arr = array("First","Second","Third","Fourth","Fifth");
					$counter = 0;
					$prod = $product->get_product($p_id,$user->get_user_id());
					$product->show_product($p_id, $user->get_user_id(),true);
					$templates = $email_template->get_all_templates($p_id);
					echo "<div class='row'>";
					foreach($templates as $template){
						echo "<div class='col-lg-6'>";
						echo "<h3>".$arr[$counter]." Email</h3>";
						$email_template->print_email_template($template["EmailTemplateID"]);
						echo "</div>";
						$counter++;
					}
					echo "</div>";
					?>
					<input type="submit" name="save" class="btn btn-primary" value="Save Changes">
				</form>
				</div>
			</div>
	</div>
<?include("inc/footer.php")?>