<?php
require_once __DIR__.'/../../../../Controllers/messagesController.php';
require_once __DIR__.'/../../../../Controllers/dbController.php';

if(!isset($_SESSION)){
	session_start();
}

header('location:'.$_SERVER['HTTP_REFERER']);

$_SESSION['message_errors'] = array();

$conn = DbController::openConnection();

$message = mysqli_real_escape_string($conn, $_POST['message']);
$senderID = $_POST['senderID'];
$receiverID = $_POST['receiverID'];
$bugID = $_POST['bugID'];
$fixed = $_POST['fixed'];
$statusID = 3;

$conn->close();

if(!$message){ array_push($_SESSION['message_errors'], "Message Can't Be Empty"); }

if(count($_SESSION['message_errors']) > 0) exit();

if(count($_SESSION['message_errors']) == 0){
	if($fixed)
	{
		$query = "UPDATE bugs SET status_id = $statusID WHERE id = $bugID;";
		DbController::query($query);
	}
	MessagesController::addMessage($message, $senderID, $receiverID, $bugID);
	$_SESSION['message_success'] = true;
}
?>
