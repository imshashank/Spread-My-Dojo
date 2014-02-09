<?
require_once("conf/config_logged_in.php");
require_once("conf/db.php");
$user_id = $user->get_user_id();
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
				  <li <?=(($page == "import.php")?"class='active'":"")?> ><a href="import.php">Import</a></li>
				  <li <?=(($page == "market.php")?"class='active'":"")?>><a href="market.php">Market</a></li>
				  <li <?=(($page == "scheduled.php")?"class='active'":"")?>><a href="scheduled.php">Scheduled</a></li>
				  <li <?=(($page == "sent.php")?"class='active'":"")?>><a href="sent.php">Sent</a></li>
				</ul>
			</div>
			<br><br><br>
			<div class="col-lg-12">
				<?php
				//show all Lists added by this user
				$sql ="SELECT DISTINCT `list_name` FROM `email_ids` where user_id='".$user_id."';";
				$res=mysql_query($sql);
				
				if(mysql_num_rows($res) != 0){?>
				<div class="row">
					<div class="col-lg-4">
						<table class="table">
						<thead>
							<tr><th>List Name</th><th>Users</th></tr>
						</thead>
						<tbody>
						<?
						while($result=mysql_fetch_array($res)){
							$query="SELECT COUNT(*) from `email_ids` where user_id='".$user_id."' AND list_name='".$result[0]."';";
							$r=mysql_query($query);
							while($x=mysql_fetch_array($r)){
								echo " <tr><td><a href='list_emails.php?list_name=".$result[0] ."'>".$result[0]."</a></td><td> $x[0] </td></tr>";
							}
						}
						?>
						</tbody>
						</table>
					</div>
				</div>
				<?}else{
					echo "<p>No data has been imported!</p>";
				}?>
			</div>
		</div>
	</div>
	<?include("inc/footer.php");?>