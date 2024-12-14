<?php
require_once __DIR__.'/../../../../Controllers/dbController.php';

if(!isset($_SESSION)){
	session_start();
}

header('location:'.$_SERVER['HTTP_REFERER']);

$_SESSION['assign_errors'] = array();

$bugID = $_POST['bugID'];
$staffID = $_POST['staffID'];

$query = "SELECT * FROM users WHERE id = $staffID;";
$result = DbController::query($query);
$userRow = $result->fetch_assoc();

if(!$staffID){ array_push($_SESSION['assign_errors'], 'Staff Member ID is Required'); }
if($userRow['role_id'] != 2){ array_push($_SESSION['assign_errors'], 'ID Does Not Belong To Staff Member'); }

if(count($_SESSION['assign_errors']) > 0) exit();

if(count($_SESSION['assign_errors']) == 0){
	$query = "UPDATE bugs SET assigned_staff_id = $staffID WHERE id = $bugID;";
	DbController::query($query);
	header($_SESSION['main']);
}
?>
