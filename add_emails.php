<?require_once("conf/config_logged_in.php")?>
<?if(isset($_GET['p']))
	$p_id =$_GET['p'];
elseif(isset($_POST['p']))
	$p_id = $_POST['p'];
?>
<?if(isset($_GET['stage'])){
	$stage = $_GET['stage'];
}elseif(isset($_POST['stage'])){
	$stage = $_POST['stage'];
}else{
	$stage = $email_template->get_current_stage($p_id);
}
if($stage == 6){
	header('Location: publisher.php');
}
?>
<?include("inc/header.php");?>
<?
if(isset($_POST['submit'])){
	$email_template->insert_template($_POST['subject'], $_POST['body'], $_POST['day'], ($stage-1), $p_id);
}
?>
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
			<br><br>
			<?$prod = $product->get_product($p_id,$user->get_user_id());?>
			<?$img = $product->get_image_for($p_id,1); $img = $img[0];?>
			<div class="col-lg-12">
				<h3><?=$prod['Name']?></h2>
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img src="<?=$img['Source']?>" <?=(isset($img['Source'])?"":"data-src='holder.js/100%x200'")?> alt="<?=$img['Alt']?>" >
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<ul class="list-group">
							<li class="list-group-item">Description: <?=$prod['Description']?></li>
							<li class="list-group-item">Price: $<?=$prod['Price']?></li>
							<li class="list-group-item">Commission: $<?=$prod['Commission']?></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<h4>Stage <?=$stage?></h4>
						<p>Set Email Template</p>
						<form role="form" method="POST" action="add_emails.php" enctype="multipart/form-data">
							<input type="hidden" name="stage" value="<?=($stage+1)?>" >
							<input type="hidden" name="p" value="<?=($p_id)?>" >
							<div class="form-group">
								<label for="subject">Subject</label>
								<input type="text" class="form-control" id="subject" name="subject" placeholder="subject">
						    </div>
							<div class="form-group">
								<label for="body">Body</label>
								<textarea class="form-control" id="body" name="body" placeholder="body" rows="5"></textarea>
							</div>
							<div class="form-group">
								<label for="day">Days</label>
								<div class="input-group">
									<input type="number" class="form-control" id="day" name="day" >
									<span class="input-group-addon">Days after the first email</span>
								</div>
							</div>
							<input type="submit" name="submit" value="next">
						</form>
					</div>
				</div>
			</div>
		</div>		
	</div>
<?include("inc/footer.php");?>

