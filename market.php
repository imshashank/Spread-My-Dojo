<?require_once("conf/config_logged_in.php")?>
<?include("inc/header.php");?>
    <div class="container">
	<?include("inc/navbar.php")?>
		<div class="row">
			<br>
			<div class="col-lg-12">
				<ul class="nav nav-pills">
				  <li <?=(($page == "import.php")?"class='active'":"")?> ><a href="import.php">Import</a></li>
				  <li <?=(($page == "market.php")?"class='active'":"")?>><a href="market.php">Market</a></li>
				  <li <?=(($page == "scheduled.php")?"class='active'":"")?>><a href="scheduled.php">Scheduled</a></li>
				  <li <?=(($page == "sent.php")?"class='active'":"")?>><a href="sent.php">Sent</a></li>
				</ul>
			</div>
			<br><br><br>
			<?$prods = $product->get_all_products();?>
			<div class="col-lg-12">
				<table class="table">
					<?foreach($prods as $prod){
						$img = $product->get_image_for($prod['ProductID'],1);
						$img = $img[0];
						echo "<tr>";
							echo "<td class='col-lg-3'><div class='row'><img class='col-lg-12 col-xs-12 col-md-12' ".(($img['Source'] == "")?"data-src='holder.js/100%x200'":"src='".$img['Source']."'")."/></div></td>";
							echo "<td class='col-lg-3'><h3>".$prod['Name']."</h3><p>".$prod['Description']."</p><p></td>";
							echo "<td class='col-lg-3'><br><p>Price : $".$prod['Price']."</p><p>Commission : $".$prod['Commission']."</p></td>";
							echo "<td class='col-lg-3 text-right'><p><a href='scheduler.php?product_id=".$prod['ProductID']."' class='btn btn-primary' role='button'>Send to Schedule</a></td>";
						echo "</tr>";
					}?>
				<?//print_r($prods);?>
				
				</table>
			</div>
		</div>
	</div>
<?include("inc/footer.php");?>
