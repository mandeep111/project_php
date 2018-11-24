<?php
require_once '../includes/dboperation.php';

$response = array();



if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['id']) and 
		isset($_POST['username']) and 
		isset($_POST['email']) and
			isset($_POST['password'])and
				isset($_POST['phone']) ) {
	$db = new dboperation();

	$result = $db->updateUser(
		$_POST['username'],
		$_POST['password'],
		$_POST['email'],
		$_POST['phone'],
		$_POST['id']);

	if($result == 1) {
		$response['error'] = false;
		$response['message'] = "User updated successfully";

	} elseif($result ==2) {
		$response['error'] = true;
		$response['message'] = "Some error occurred, try again!";
	}elseif($result ==0) {
		$response['error'] = true;
		$response['message'] = "Email already existed";
	}

}
} else {
	$response['error'] = true;
	$response['message'] = "Invalid request";
}
echo json_encode($response);

?>