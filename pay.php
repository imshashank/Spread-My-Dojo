<?require_once("conf/config_logged_in.php");
require_once("conf/db.php");
?>

<?include("inc/header.php");?>
	<div class="container">
<?php include("inc/navbar.php");?>
<?php
$publisher=$_GET['publisher'];
$campaigner=$_GET['campaigner'];
$product_id=$_GET['product_id'];

//echo $publisher;
//echo $campaigner;
//echo $product_id;


$sql="select * from product where productid=".$product_id;
//echo $sql;
$res=mysql_query($sql);
while($result=mysql_fetch_array($res))
	{
		$title=$result[1];
		$description=$result[2];
		$price=$result[3];
		$commission=$result[4];
	}

//echo $price."</br>";
//echo $commission."</br>";
$sql="select source from image where productid=".$product_id."";
//echo $sql;
$res=mysql_query($sql);
while($result=mysql_fetch_array($res))
	{
	$img=$result[0];
//echo $img;
	}
?>

<table class="table table-bordered table-responsive" style="width: 18%;margin-left: 42%;margin-top: 33px;">
<tr><td><h1 style="text-align: center;"><?php echo $title; ?></h1></td></tr>
<tr><td><img style=" max-width: 154px;margin-left: 10%;margin-right: 13%;" src="<?echo $img; ?>"></td></tr>
<tr><td style="text-align: center;"><p><?php echo $description; ?></td></tr>
<tr><td style="text-align: center;"><b>Price: <?php echo $price?></b></td></tr>
<tr><td style="text-align: center;">
<form action="/thanks.php" method="POST">
<?php 
$price = $price*100;?>
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_h44dIBF4jQBaliyVTw5Yj5z0"
    data-image="<?php echo $img; ?>"
    data-name="<?php echo $ttile; ?>"
    data-description="<?php echo $description; ?>"
    data-amount="<?echo $price;?>">
  </script>
<input type="hidden" name="price" value="<?php echo $price; ?>">
<input type="hidden" name="commission" value="<?php echo $commission; ?>">
<input type="hidden" name="publisher" value="<?php echo $publisher; ?>">
<input type="hidden" name="campaigner" value="<?php echo $campaigner; ?>">
</form>
</td></tr>
</table>

	</div>

<?php include("inc/footer.php");?>
