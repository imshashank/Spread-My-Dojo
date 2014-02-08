<?
class Category{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function get_all_main_categories(){
		$res = $this->db->select("category","*","Parent = 0 OR Parent IS null");
		return $res;
	}

}


?>
