<?
class Schedule{
	private $db;
	public function __construct($db){
		$this->db = $db;
	}
	
	public function get_scheduled_emails_for($user_id,$flag){
			return $this->db->select("scheduler as s,product as p","*"," s.product_id = p.ProductID AND campaigner = $user_id AND flag = $flag");
	}
}
?>