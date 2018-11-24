<?php 
include_once '../includes/dboperation.php';

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['email']) and isset($_POST['password'])){

	$db = new dboperation;

	$result = $db->updatePassword($_POST['password'], $_POST['email']);
	if($result==1) {
		$response['error'] = false;
		$response['message'] = "Password updated successfully";

	} elseif($result ==2 ) {
		$response['error'] = true;
		$response['message'] = "No match found for that email";
	}
}
} else {
	$response['error'] = true;
	$response['message'] = "Invalid request";
}
echo json_encode($response);
 ?>