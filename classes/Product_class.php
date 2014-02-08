<?
class Product{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function register($name, $description, $category, $price, $commission){
		if(!is_numeric($price) || !is_numeric($commission)){
			return false;
		}
		$this->db->insert("product","Name, Description, CatID, Price, Commission", "'$name','$description',$category, $price, $commission");
		return $this->db->lastInsertedId();
	}

}

?>