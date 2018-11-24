<?php 
session_start();
	class dboperation{
		private $con;

		function __construct() {
			require_once dirname(__FILE__).'/dbconnect.php';

			$db = new dbconnect();

			$this -> con = $db -> connect();
		}

		//create operation

		public function createUser($username, $pass, $email, $phone, $gender) {

			if($this->isUserExist($email)) {
				return 0;
			}
			else {
				$password = md5($pass);
				$stmt = $this->con-> prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `gender`) VALUES (NULL, ?, ?, ?, ?, ?);");
				$stmt -> bind_param("sssss", $username, $password, $email, $phone, $gender);

				if($stmt -> execute()) {
					return 1;
				}
				else {
					return 2;
				}
		}
	}
	
	public function updateUser($username, $pass, $email, $phone, $id) {
			$password=md5($pass);
			$stmt = $this->con->prepare("UPDATE users SET username=?, password=?, email=?, phone=? WHERE id=?");
			$stmt -> bind_param("ssssi", $username, $password, $email, $phone, $id);
			if($this-> isUserExist($email)){
			return 0;
			} elseif($stmt->execute()){
				return 1;
			} else {
				return 2;
			}
		}

	

	public function updatePassword($pass, $email){
		if($this-> isUserExist($email)) {
			$password =  md5($pass);
			$stmt = $this->con->prepare("UPDATE users SET password=? WHERE email=?");
			$stmt -> bind_param("ss", $password, $email);
			if($stmt->execute()){
				return 1;

		} 
	}else {
			return 2;
		}
	
	}


	// public function deleteUser($username) {
	// 	$stmt =$this->con->prepare("DELETE FROM users where username=?");
	// 	$stmt -> bind_param("s", $username);
	// 	if($stmt->execute()) {
	// 		return 1;
	// 	}
	// 	else {
	// 		return 2;
	// 	}
	// }	
	

	public function deleteUser($id) {
		$stmt =$this->con->prepare("DELETE FROM users where id=?");
		$stmt -> bind_param("i", $id);
		if($stmt->execute()) {
			return 1;
		}
		else {
			return 2;
		}
	}	

	public function userLogin($email, $pass){
		$password = md5($pass);
		$stmt = $this->con->prepare("SELECT id FROM users WHERE email = ? AND password= ?");
		$stmt -> bind_param("ss", $email, $password);
		$stmt -> execute();
		$stmt -> store_result();
		return $stmt ->num_rows>0;
	}

	public function getUserByEmail($email) {
		$stmt = $this->con->prepare("SELECT * FROM users WHERE email = ?");
		$stmt -> bind_param("s", $email);
		$stmt -> execute();
		return $stmt->get_result()->fetch_assoc();
	}

	private function isUserExist($email) {
		$stmt = $this->con->prepare("SELECT id FROM users where email =?");
		$stmt -> bind_param("s",  $email);
		$stmt -> execute();
		$stmt ->store_result();
		return $stmt->num_rows >0;
	}

	
}

