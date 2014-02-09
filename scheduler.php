<?require_once("conf/config_logged_in.php");
require_once("conf/db.php");
?>

<?include("inc/header.php");?>
	<div class="container">
<?php include("inc/navbar.php");?>
<?php
if(!isset($_GET['product_id'])){
//echo 'Please select a email campaign';
}
//$product_id=12;
$product_id=$_POST['product_id'];

$start_year= $_POST['start_year'];
$start_month= $_POST['start_month'];
$start_day= $_POST['start_day'];
$start_hour= $_POST['start_hour'];
$start_minute= $_POST['start_minute'];
$d="$start_year-$start_month-$start_day $start_hour:$start_minute:0";
$my_date = date($d);

$today = date("Y-m-d H:i:s");
$expire = $d;
 //from db
//echo "<br/> Today is ".$today;
$today_time = strtotime($today);
$expire_time = strtotime($expire);

if ($expire_time < $today_time) { 
//echo "$expire_time is small <br/>";
 }

//echo $my_date;
//INSERT INTO my_table (date_time) VALUES ('$my_date');
$sql ="select userid from `product` where productid ='".$product_id."'";
//echo $sql."<br/>";
$res=mysql_query($sql);
while($result=mysql_fetch_array($res)){

$publisher=$result[0];
//echo $publisher;
}

//echo "The publisher is $publisher";
//get email_ids
$sql= "select EmailTemplateID,Day from  email_templates where ProductID='".$product_id."'";
//echo $sql;
$res=mysql_query($sql);

while($result=mysql_fetch_array($res)){
//$result[0] = email_id
$start_day=$start_day+ $result[1];
//echo "Start date is $start_day ";
$my_date="$start_year-$start_month-$start_day $start_hour:$start_minute:0";
//$my_date = date($d);



$query="INSERT INTO `osuhack`.`scheduler` (`id`, `publisher`, `campaigner`, `email_id`, `list_name`, `time`, `flag`,`product_id`) VALUES ('','".$publisher."', '".$_SESSION[user_id]."', '".$result[0]."', '".$_POST['list_name']."', '".$my_date."', '0','".$product_id."');";

echo "<br/>".$sql."</br>";
	if(isset($product_id)){
	$r=mysql_query($query);
		if($r){
		echo '<p id="message">Product Camaping Scheduled</p> ';}
		}
}

$q= "SELECT name from product where productid='".$_GET['product_id']."'";
$res=mysql_query($q);
while($result=mysql_fetch_array($res)){
$n=$result[0];
}

echo "<div style='text-align: center;margin-top: 26px;margin-bottom: -32px;margin-left: -71px;font-size: 33px;font-weight: 800;'>
	 Product Name: ".$n ."</div>";

?>
<form role="form" class="form-horizontal" action="scheduler.php" method="post" enctype="multipart/form-data" style="margin-top: 39px;
margin-left: 36%;">
<?

$sql ="SELECT DISTINCT `list_name` FROM `email_ids` where user_id='".$_SESSION[user_id]."';";
//echo $sql;
$res=mysql_query($sql);
echo "<br/>Select a list <select name='list_name' style='margin-bottom: 15px;'>";
while($result=mysql_fetch_array($res)){
	$query="SELECT COUNT(*) from `email_ids` where user_id='".$_SESSION[user_id]."' AND list_name='".$result[0]."';";
	$r=mysql_query($query);
	while($x=mysql_fetch_array($r)){
	$users=$x[0];
	//echo " <tr> <td>".$result[0] ."</td><td> $x[0] </td></tr>";
	}
  $options.="<OPTION VALUE=\"$result[0]\">".$result[0]." Users: ".$users." </option>";
  }


echo $options ."</select><br/>";
?>
<table>
<tr><td>Year</td><td>Month</td><td>Day</td><td>Hour</td><td>Minute</td></tr>
<tr>
<td><?php echo createYears(2012, 2020, 'start_year', 2010); ?></td>

<td><?php echo createMonths('start_month', 2); ?></td>

<td><?php echo createDays('start_day', 8); ?></td>

<td><?php echo createHours('start_hour', 0); ?></td>

<td><?php echo createMinutes('start_minute', 00); ?></td>


</tr>

</table>
<input type="hidden" name="product_id" value="<?php echo $_GET['product_id']; ?>">

<input type="submit" name="submit" value="Submit" class="btn btn-primary" style="margin-top: 15px;margin-left: 88px;">
</form>



<?

//get all emails with the email campaign name/id

?>

	</div>

<?php include("inc/footer.php");?>
<?php
    /**
    *
    * @Create dropdown of years
    *
    * @param int $start_year
    *
    * @param int $end_year
    *
    * @param string $id The name and id of the select object
    *
    * @param int $selected
    *
    * @return string
    *
    */
    function createYears($start_year, $end_year, $id='year_select', $selected=null)
    {

        /*** the current year ***/
        $selected = is_null($selected) ? date('Y') : $selected;

        /*** range of years ***/
        $r = range($start_year, $end_year);

        /*** create the select ***/
        $select = '<select name="'.$id.'" id="'.$id.'">';
        foreach( $r as $year )
        {
            $select .= "<option value=\"$year\"";
            $select .= ($year==$selected) ? ' selected="selected"' : '';
            $select .= ">$year</option>\n";
        }
        $select .= '</select>';
        return $select;
    }

    /*
    *
    * @Create dropdown list of months
    *
    * @param string $id The name and id of the select object
    *
    * @param int $selected
    *
    * @return string
    *
    */
    function createMonths($id='month_select', $selected=null)
    {
        /*** array of months ***/
        $months = array(
                1=>'January',
                2=>'February',
                3=>'March',
                4=>'April',
                5=>'May',
                6=>'June',
                7=>'July',
                8=>'August',
                9=>'September',
                10=>'October',
                11=>'November',
                12=>'December');

        /*** current month ***/
        $selected = is_null($selected) ? date('m') : $selected;

        $select = '<select name="'.$id.'" id="'.$id.'">'."\n";
        foreach($months as $key=>$mon)
        {
            $select .= "<option value=\"$key\"";
            $select .= ($key==$selected) ? ' selected="selected"' : '';
            $select .= ">$mon</option>\n";
        }
        $select .= '</select>';
        return $select;
    }


    /**
    *
    * @Create dropdown list of days
    *
    * @param string $id The name and id of the select object
    *
    * @param int $selected
    *
    * @return string
    *
    */
    function createDays($id='day_select', $selected=null)
    {
        /*** range of days ***/
        $r = range(1, 31);

        /*** current day ***/
        $selected = is_null($selected) ? date('d') : $selected;

        $select = "<select name=\"$id\" id=\"$id\">\n";
        foreach ($r as $day)
        {
            $select .= "<option value=\"$day\"";
            $select .= ($day==$selected) ? ' selected="selected"' : '';
            $select .= ">$day</option>\n";
        }
        $select .= '</select>';
        return $select;
    }


    /**
    *
    * @create dropdown list of hours
    *
    * @param string $id The name and id of the select object
    *
    * @param int $selected
    *
    * @return string
    *
    */
    function createHours($id='hours_select', $selected=null)
    {
        /*** range of hours ***/
        $r = range(0, 23);

        /*** current hour ***/
        $selected = is_null($selected) ? date('h') : $selected;

        $select = "<select name=\"$id\" id=\"$id\">\n";
        foreach ($r as $hour)
        {
            $select .= "<option value=\"$hour\"";
            $select .= ($hour==$selected) ? ' selected="selected"' : '';
            $select .= ">$hour</option>\n";
        }
        $select .= '</select>';
        return $select;
    }

    /**
    *
    * @create dropdown list of minutes
    *
    * @param string $id The name and id of the select object
    *
    * @param int $selected
    *
    * @return string
    *
    */
    function createMinutes($id='minute_select', $selected=null)
    {
        /*** array of mins ***/
        $minutes = array(0, 15, 30, 45);

    $selected = in_array($selected, $minutes) ? $selected : 0;

        $select = "<select name=\"$id\" id=\"$id\">\n";
        foreach($minutes as $min)
        {
            $select .= "<option value=\"$min\"";
            $select .= ($min==$selected) ? ' selected="selected"' : '';
            $select .= ">".str_pad($min, 2, '0')."</option>\n";
        }
        $select .= '</select>';
        return $select;
    }

    /**
    *
    * @create a dropdown list of AM or PM
    *
    * @param string $id The name and id of the select object
    *
    * @param string $selected
    *
    * @return string
    *
    */
    function createAmPm($id='select_ampm', $selected=null)
    {
        $r = array('AM', 'PM');

    /*** set the select minute ***/
        $selected = is_null($selected) ? date('A') : strtoupper($selected);

        $select = "<select name=\"$id\" id=\"$id\">\n";
        foreach($r as $ampm)
        {
            $select .= "<option value=\"$t\"";
            $select .= ($ampm==$selected) ? ' selected="selected"' : '';
            $select .= ">$ampm</option>\n";
        }
        $select .= '</select>';
        return $select;
    }
?>
