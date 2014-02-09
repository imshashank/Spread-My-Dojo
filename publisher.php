<?require_once("conf/config_logged_in.php")?>
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
			<?$prods = $product->get_products_for($user->get_user_id());
			if(!empty($prods)){
				foreach($prods as $prod){
					$img = $product->get_image_for($prod['ProductID'],1);
					$img = $img[0];
					?>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
						  <img src="<?=$img['Source']?>" <?=(isset($img['Source'])?"":"data-src='holder.js/100%x200'")?> alt="<?=$img['Alt']?>">
						  <div class="caption">
							<h3><?=$prod['Name']?></h3>
							<p><?=$prod['Description']?></p>
							<p>Price: $<?=$prod['Price']?></p>
							<p>Commission: $<?=$prod['Commission']?></p>
							<?if(!$email_template->has_all_templates($prod['ProductID'])){?>
								<p><a href="add_emails.php?p=<?=$prod['ProductID']?>" class="btn btn-primary" role="button">Add Emails</a></p>
							<?}
							if($email_template->has_templates($prod['ProductID'])){?>
								<p><a href="edit_emails.php?p=<?=$prod['ProductID']?>" class="btn btn-info" role="button">View/Edit Emails</a></p>
							<?}?>
						  </div>
						</div>
					</div>
			<?}
			}?>
		
		</div>
    </div>
<?include("inc/footer.php");?>
