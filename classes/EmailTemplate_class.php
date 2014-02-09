<?
class EmailTemplate{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function insert_template($subject, $body, $day, $stage, $pro_id){
		return $this->db->insert("email_templates" , "Subject, Body, Day, Stage, ProductID" , "'$subject' , '".base64_encode($body)."', $day, $stage, $pro_id");
	}
	
	public function update_template($subject, $body, $day, $stage,$pro_id){
		return $this->db->update("email_templates", "Subject = '$subject', Body = '".base64_encode($body)."', Day = $day","Stage = $stage AND ProductID = $pro_id");
	}
	
	public function has_all_templates($pro_id){
		$res = $this->db->select("email_templates", "COUNT(DISTINCT Stage) as c","ProductID = $pro_id" );
		if($res[0]['c'] == 5)
			return true;
		return false;
	}
	
	public function has_templates($pro_id){
		$res = $this->db->select("email_templates", "COUNT(DISTINCT Stage) as c","ProductID = $pro_id" );
		if($res[0]['c'] > 0)
			return true;
		return false;
	}
	
	public function get_current_stage($pro_id){
		$res = $this->db->select("email_templates" , "(MAX(Stage)+1) as c_stage", "ProductID = $pro_id");
		return (($res[0]['c_stage']== "")?"1":$res[0]['c_stage']);
	}
	
	public function get_all_templates($pro_id){
		return $this->db->select("email_templates", "*", "ProductID = $pro_id");
	}
	
	public function print_email_template($template_id){
		$temp = $this->db->select("email_templates", "*","EmailTemplateID = $template_id");
		$temp = $temp[0];
		echo "<div class='form-group'>";
			echo "<label for='".$temp['Stage']."_subject'>Subject</label>";
			echo "<input type='text' class='form-control' id='".$temp['Stage']."_subject' name='".$temp['Stage']."_subject' value='".$temp['Subject']."' >";
		echo "</div>";
		echo "<div class='form-group'>";
			echo "<label for='".$temp['Stage']."_body'>Body</label>";
			echo "<textarea class='form-control' id='".$temp['Stage']."_body' name='".$temp['Stage']."_body' rows='10'>". base64_decode($temp['Body']) . "</textarea>";
		echo "</div>";
		echo "<div class='form-group'>";
			echo "<label for='".$temp['Stage']."_day'>Days</label>";
			echo "<div class='input-group'>";
				echo "<input type='number' class='form-control' id='".$temp['Stage']."_day' name='".$temp['Stage']."_day' value='".$temp['Day']."' >";
				echo "<span class='input-group-addon'>Days after the first email</span>";
			echo "</div>";
		echo "</div>";
	}
}
?>