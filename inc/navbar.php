<?php
require_once("conf/db.php");

$sql="SELECT SUM(money) FROM money where user_id='".$_SESSION['user_id']."';";
$res=mysql_query($sql);
while($result=mysql_fetch_array($res)){
$earning=$result[0];
}

if(!isset($earning)){
$earning =0;
}
	  $data=explode('/',$_SERVER['REQUEST_URI']);
	  $page = $data[count($data)-1];
	  ?>
	  <div class="masthead">
		<p style="margin-top:-5px;font-size:13pt;">Hi <?=$_SESSION[user_name]?> <a href="logout.php" class="pull-right text-right">Logout</a></p>
        <h3 class="text-muted">Spread My Dojo</h3><p id="earning" style="float: right;position: relative;margin-top: -42px;font-size: 22px;
    margin-right: 0px;">Total Earning: <?php echo $earning;?> USD</p>
        <ul class="nav nav-justified">
          <li <?=(($page == "publisher.php" || $page == "product.php" || strpos($page,"add_emails.php")!== false || strpos($page,"edit_emails.php")!== false)?"class='active'":"")?>><a href="publisher.php">Publisher</a></li>
          <li <?=(($page == "campaigner.php" || $page == "market.php" || $page == "import.php" || $page == "scheduled.php")?"class='active'":"")?>><a href="campaigner.php">Campaigner</a></li>
        </ul>
      </div>
