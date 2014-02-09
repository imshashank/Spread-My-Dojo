<?require_once("conf/config_logged_in.php");
require_once("conf/db.php");
?>

<?php
$product_id=$_POST['product_id'];
$title=$_POST['title'];
$money=$_POST['price'];
$commission=$_POST['commission'];
$publisher=$_POST['publisher'];
$campaigner=$_POST['campaigner'];
/*
echo "product_id".$product_id."</br>";
echo "publisher".$publisher."</br>";
echo "campaigner".$campaigner,"</br>";
echo "title".$title,"</br>";
$money=$money/100;
echo "money".$money."</br>";
echo "commision".$commission."</br>";
*/
$money=$money/100;
//divide money subtract commission from the price
$pub_earn= $money - (($money*$commission)/100);
//echo $pub_earn."pub earn</br>";

$camp_earn=$money-$pub_earn;
//echo $camp_earn."</br>";

//insert this in camp & pub money tables
//pub
$sql="INSERT INTO `osuhack`.`money` (`id`, `user_id`, `product_id`, `name`, `money`) VALUES (NULL, ".$publisher.", ".$product_id.", '".$title."', '".floatval($pub_earn)."');";
//echo $sql;
$res=mysql_query($sql);


$sql="INSERT INTO `osuhack`.`money` (`id`, `user_id`, `product_id`, `name`, `money`) VALUES (NULL, ".$campaigner.", ".$product_id.", '".$title."', '".floatval($camp_earn)."');";
//echo $sql;
$res=mysql_query($sql);

?>

	<div class="container">

<h1> Thanks for the payment, you will soon receive your product</h1>


<div> <h2>order details</h2>
<h3>Product Name: <?php echo  $title; ?></h3>
<h3>Price: <?php echo $money; ?> </h3>
</div>


