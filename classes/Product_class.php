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
	
	public function get_all_products(){
		return $this->db->select("product", "*");
	}
	
	public function show_product($prod_id,$user_id,$warning = false){
		$prod = $this->db->select("product" , "*","ProductID = $prod_id AND UserID = $user_id");
		$img = $this->get_image_for($prod_id,1);
		$img = $img[0];
		$prod = $prod[0];
		echo "<h3>".$prod['Name']."</h2>";
		echo "<div class='row'>";
			echo "<div class='col-sm-6 col-md-4'>";
				echo "<div class='thumbnail'>";
					echo "<img src='".$img['Source']."'". (isset($img['Source'])?"":"data-src='holder.js/100%x200'")."alt=".$img['Alt'].">";
				echo "</div>";
			echo "</div>";
			echo  "<div class='col-sm-6 col-md-4'>";
				echo "<ul class='list-group'>";
					echo "<li class='list-group-item'>Description: ".$prod['Description']."</li>";
					echo "<li class='list-group-item'>Price: $".$prod['Price']."</li>";
					echo "<li class='list-group-item'>Commission: $".$prod['Commission']."</li>";
				echo "</ul>";
				if($warning == true){
					echo "<div class='alert alert-warning'>Please make sure you include the text \"%LINK%\" in your email at least once. This link will allow the recipient to purchase the item.</div>";
				}
			echo "</div>";
		echo "</div>";
	}

}

?>