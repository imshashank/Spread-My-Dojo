<?require_once("conf/config_logged_in.php")?>
<?
if(isset($_POST['submit'])){
	$errors = array();
	$id = $product->register($_POST['title'],$_POST['description'],$_POST['category'],$_POST['price'],$_POST['commission'],$user->get_user_id());
	if($id == false){
		$errors[] = "The product was not registered correctly";
	}
	else{
		if($_FILES['image']){
			if(mkdir("./img/".$id)){
				$counter = 0;
				foreach($_FILES['image']['name'] as $name){
					if(file_exists("./img/".$id."/".$name)){
						$errors[] = "$name already exists";
					}
					else{
						move_uploaded_file($_FILES['image']['tmp_name'][$counter],"./img/".$id."/$name");
						$product->set_image_for($id , "img/".$id."/$name",$name);
					}
					$counter++;
				}
			}
			else{
					$errors[] = "we were not able to create a directory for your product";
			}
		}
	}
	if(!empty($errors)){
		print_r($errors);
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
			<div class="col-lg-6">
				<h1>Add a New Product</h1>
				<?$cats = $category->get_all_main_categories();?>
				<form role="form" method="POST" action="product.php" enctype="multipart/form-data">
				  <div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Title">
				  </div>
				  <div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" id="description" name="description" placeholder="Description" rows="3"></textarea>
				  </div>
				  <div class="form-group">
					<label for="category">Category</label>
					<?foreach($cats as $cat){?>
					<div class="radio">
					  <label>
						<input type="radio" name="category" id="<?=$cat['Title']?>" value="<?=$cat['CatID']?>" ><?=$cat['Title']?>
					  </label>
					</div>
					<?}?>
				  </div>
				  
				  <div class="form-group">
					<label for="price">Price</label>
					<div class="input-group">
						<span class="input-group-addon">$</span>
						<input type="text" class="form-control" id="price" name="price" placeholder="Price">
					</div>
				  </div>
				  <div class="form-group">
					<label for="commission">Commission</label>
					<div class="input-group">
						<span class="input-group-addon">$</span>
						<input type="text" class="form-control" id="commission" name="commission" placeholder="Commission">
					</div>
				  </div>				  
			      <div class="form-group">
					<label for="image">Upload Images</label>
					<input type="file" name="image[]" multiple="true" id="image">
				  </div>
				  <button type="submit" class="btn btn-default" name="submit">Add Product</button>
				</form>
			</div>
		</div>
	</div>
	<?include("inc/footer.php")?>