<?php
require_once __DIR__.'/../../../../Controllers/dbController.php';

if(!isset($_SESSION)){
	session_start();
}

header('location:'.$_SERVER['HTTP_REFERER']);

$_SESSION['assign_errors'] = array();

$bugID = $_POST['bugID'];
$staffID = $_POST['staffID'];
$priorityID = $_POST['priorityID'];
$statusID = 2;

$query = "SELECT * FROM users WHERE id = $staffID;";
$result = DbController::query($query);
$userRow = $result->fetch_assoc();

if(!$staffID){ array_push($_SESSION['assign_errors'], 'Staff Member ID is Required'); }
if(!$priorityID){ array_push($_SESSION['assign_errors'], 'Priority is Required'); }
if($userRow['role_id'] != 2){ array_push($_SESSION['assign_errors'], 'ID Does Not Belong To Staff Member'); }

if(count($_SESSION['assign_errors']) > 0) exit();

if(count($_SESSION['assign_errors']) == 0){
	$query = "UPDATE bugs SET assigned_staff_id = $staffID, priority_id = $priorityID, status_id = $statusID WHERE id = $bugID;";
	DbController::query($query);
	$_SESSION['assign_success'] = true;
}
?>
