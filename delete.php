<?php 
include_once '../includes/dboperation.php';

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['id'])){

	$db = new dboperation;

	$result = $db->deleteUser($_POST['id']);
	if($result==1) {
		$response['error'] = false;
		$response['message'] = "User deleted successfully";

	}
}
} else {
	$response['error'] = true;
	$response['message'] = "Invalid request";
}
echo json_encode($response);
 ?>