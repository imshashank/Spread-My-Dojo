<?
session_start();
class User{
	private $db;
	
	public function __construct( $db ){
		$this->db = $db;
	}
	
	public function register_user($fname, $lname, $email, $password){
		$res = $this->db->insert("user",
							"Fname, Lname , Email, Password" ,
							"'$fname' , '$lname', '$email' , '$password'");
		if ($res == 1)
			return true;
		return false;
	}
	
	public function authenticate($email , $password){
		$res = $this->db->select("user" , "UserId, Fname, Lname" , "Email = '$email' AND Password = '$password'" , "", "" , "1");
		if (count($res) == 1)
		{
			$_SESSION[user_id] = $res[0]['UserId'];
			$_SESSION[user_name] = $res[0]['Fname'] . " " . $res[0]['Lname'];
			return true;
		}
		return false;
	}
	
	public function logged_in() {
		return ((isset($_SESSION[user_id]) && isset($_SESSION[user_name]))); //|| ( isset($_COOKIE[user_name]) && isset($_COOKIE[user_id])) );
	}
	
	public function get_user_id(){
		return (isset($_SESSION['user_id']))?$_SESSION['user_id']:"";
	}
	
	public function getUsername(){
		if (isset ($_SESSION[user_name]))
			return $_SESSION[user_name];
		//elseif (isset($_COOKIE[user_name]))
		//	return $_COOKIE[user_name];
	}
	
	public function confirm_logged_in(){
		if (!$this->logged_in()) {
			header( 'Location: login.php' );
		}
	}
	
	public function isValidEmail($email){
		if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
			return true;
		return false;
	}
	
	public function getHashedPassword($pass){
		return sha1($pass);
	}
	
	public function emailExists($email){
		$res = $this->db->select("user" , "Email" , "Email = '$email'");
		if (count($res) != 0)
			return true;
		return false;
	}
	
}
?>