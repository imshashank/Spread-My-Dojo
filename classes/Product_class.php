<?
class Product{
	private $db;
	
	public function __construct($db){
		$this->db = $db;
	}
	
	public function register($name, $description, $category, $price, $commission,$user_id){
		if(!is_numeric($price) || !is_numeric($commission)){
			return false;
		}
		$this->db->insert("product","Name, Description, CatID, Price, Commission,UserID", "'$name','$description',$category, $price, $commission ,$user_id");
		return $this->db->lastInsertedId();
	}
	
	public function get_products_for($user_id){
		return $this->db->select("product","*","UserID = $user_id");
	}
	
	public function set_image_for($prod_id , $source, $alt){
		return $this->db->insert("image", "Source, Alt, ProductID" , "'$source' , '$alt',$prod_id");
	}
	
	public function get_image_for($prod_id,$count){
		return $this->db->select("image", "Source, Alt", "ProductID = $prod_id", "" , "" , "$count");
	}
	
	public function get_product($prod_id,$user_id){
		$res = $this->db->select("product" , "*","ProductID = $prod_id AND UserID = $user_id");
		return $res[0];
	}

}

?>