<?php

require_once '../includes/dboperation.php';

$response = array();
if($_SERVER['REQUEST_METHOD']== 'POST') {
	if(isset($_POST['email']) and isset($_POST['password'])) {
		$db = new dboperation();

		if ($db->userLogin($_POST['email'], $_POST['password'])) {
			$user = $db->getUserByEmail($_POST['email']);
			$response['error'] = false;
			$response['id'] = $user['id'];
			$response['password']= $user['password'];
			$response['email'] = $user['email'];
			$response['username'] = $user['username'];
			$response['phone'] = $user['phone'];
			$response['gender'] = $user['gender'];

		}else {
			$response['error'] = true;
			$response['message'] = "Invalid email or password";
		}
	}
		// else {
	// 	$response['error'] = true;
	// 		$response['message'] = "Fields are missing";
	// 	}	
}

	

echo json_encode($response);
