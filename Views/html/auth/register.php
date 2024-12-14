<?php
require_once __DIR__.'/../../../Controllers/dbController.php';
require_once __DIR__.'/../../../Controllers/usersController.php';

if(!isset($_SESSION)){
	session_start();
}

header('location:'.$_SERVER['HTTP_REFERER']);

$_SESSION['register_errors'] = array();

$conn = DbController::openConnection();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
$password = mysqli_real_escape_string($conn, $_POST['password']);

$conn->close();

if(isset($_POST['role'])) $role = $_POST['role'];
else $role = 'Customer';

if(!$username){ array_push($_SESSION['register_errors'], 'Username is Required'); }
if(!$email){ array_push($_SESSION['register_errors'], 'Email is Required'); }
if(!$password){ array_push($_SESSION['register_errors'], 'Password is Required'); }

if(count($_SESSION['register_errors']) > 0) exit();

if(UsersController::isEmailTaken($email)){ array_push($_SESSION['register_errors'], 'Email Already Taken'); }

if(count($_SESSION['register_errors']) == 0){
	$_SESSION['register_success'] = true;
	UsersController::register($username, $email, $password, $role);
	if(isset($_SESSION['loggedInUser'])) exit();

	UsersController::confirmLogin($email, $password);
	header("location:http://".$_SERVER['SERVER_NAME'].'/Bug-Tracking-WebApp/Views/html/main.php');
}
?>
