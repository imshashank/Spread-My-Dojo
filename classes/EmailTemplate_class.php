<?
class EmailTemplate{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function insert_template($subject, $body, $day, $stage, $pro_id){
		return $this->db->insert("email_templates" , "Subject, Body, Day, Stage, ProductID" , "'$subject' , '$body', $day, $stage, $pro_id");
	}
	
	public function has_all_templates($pro_id){
		$res = $this->db->select("email_templates", "COUNT(DISTINCT Stage) as c","ProductID = $pro_id" );
		if($res[0]['c'] == 5)
			return true;
		return false;
	}
	
	public function get_current_stage($pro_id){
		$res = $this->db->select("email_templates" , "(MAX(Stage)+1) as c_stage", "ProductID = $pro_id");
		return $res[0]['c_stage'];
	}
}
?>