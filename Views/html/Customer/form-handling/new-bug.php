<?php
require_once __DIR__.'/../../../../Controllers/dbController.php';
require_once __DIR__.'/../../../../Controllers/bugsController.php';
require_once __DIR__.'/../../../../Models/user.php';

if(!isset($_SESSION)){
	session_start();
}

header('location:'.$_SERVER['HTTP_REFERER']);

$_SESSION['bug_errors'] = array();

$conn = DbController::openConnection();

$statusID = 1;
$dateCreated = date('Y-m-d H:i:s');
$description = mysqli_real_escape_string($conn, $_POST['description']);
$projectID = $_POST['projectID'];
$reporterID = $_SESSION['loggedInUser']->getID();

$conn->close();

$allowedExtensions = array('png', 'jpg', 'jpeg');
$fileExtension = explode('.', basename($_FILES['screenshot']['name']))[1];

if(!is_uploaded_file($_FILES['screenshot']['tmp_name'])){ array_push($_SESSION['bug_errors'], 'Screenshot is Required'); }
if(!in_array($fileExtension, $allowedExtensions)){ array_push($_SESSION['bug_errors'], 'Screenshot Has to Be in PNG Format'); }
if(!$projectID){ array_push($_SESSION['bug_errors'], 'Project is Required'); }
if(!$description){ array_push($_SESSION['bug_errors'], 'Description is Required'); }

if(count($_SESSION['bug_errors']) > 0) exit();

if(count($_SESSION['bug_errors']) == 0){
	BugsController::addBug($statusID, $dateCreated, $description, $projectID, $reporterID);

	$uploaddir = '../../../bugScreenshots/';

	$query = 'SELECT * FROM bugs ORDER BY id DESC;';
	$result = DbController::query($query);
	$row = $result->fetch_assoc();
	$bugID = $row['id'];

	$uploadfile = $uploaddir . 'Bug-' . $bugID . '.' . $fileExtension;
	move_uploaded_file($_FILES['screenshot']['tmp_name'], $uploadfile);
	$_SESSION['bug_success'] = true;
}
?>
