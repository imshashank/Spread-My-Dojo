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
			<div class="col-lg-12">
				<?$schedules = $schedule->get_scheduled_emails_for($user->get_user_id(),0);
				if(!empty($schedules)){?>
					<table class="table">
					<thead>
						<tr><th class="text-center">Img</th><th class="text-center">Name</th><th class="text-center">Time</th><th class="text-right">Category</th></tr>
					</thead>
					<tbody>
					<?foreach($schedules as $sch){
						$img = $product->get_image_for($sch['ProductID']);
						$img = $img[0];
						echo "<tr>";
							echo "<td class='col-lg-1'><div class='row'><img class='col-lg-12 col-xs-12 col-md-12' ".(($img['Source'] == "")?"data-src='holder.js/100%x75'":"src='".$img['Source']."'")."/></div></td>";
							echo "<td style='vertical-align:middle' class='col-lg-3 text-center'>".$sch['Name']."</td>";
							echo "<td style='vertical-align:middle' class='col-lg-4 text-center'>".$sch['time']."</td>";
							echo "<td style='vertical-align:middle' class='col-lg-4 text-right'>".$sch['list_name']."</td>";
						echo "</tr>";
					}?>
					</tbody>
					</table>
				<?}else{
					echo "<p>There is no scheduled emails for your account</p>";
				}?>
			</div>
		</div>
	</div>
<?include("inc/footer.php")?>