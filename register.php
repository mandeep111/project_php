<?php

require_once '../includes/dboperation.php';

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['username']) and 
		isset($_POST['email']) and
			isset($_POST['password'])and
				isset($_POST['phone']) and
					isset($_POST['gender'])) {
	$db = new dboperation();


	$result = $db->createUser(
		$_POST['username'],
		$_POST['password'],
		$_POST['email'],
		$_POST['phone'],
		$_POST['gender']);

	if($result == 1) {
		$response['error'] = false;
		$response['message'] = "User registered successfully";

	} elseif($result ==2) {
		$response['error'] = true;
		$response['message'] = "User registered failed";
	}elseif($result ==0) {
		$response['error'] = true;
		$response['message'] = "Email already existed";
	}

}
	// else {
	// 	$response['error'] = true;
	// 	$response['message'] = "Fields are missing";
	// }

	
} else {
	$response['error'] = true;
	$response['message'] = "Invalid request";
}
echo json_encode($response);