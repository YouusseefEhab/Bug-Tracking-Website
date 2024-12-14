<?php
require_once __DIR__.'/../../../Controllers/usersController.php';

if(!isset($_SESSION)){
	session_start();
}

header('location:./authentication-login.php');

$_SESSION['login_errors'] = array();

$conn = DbController::openConnection();

$email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
$password = mysqli_real_escape_string($conn, $_POST['password']);

$conn->close();

if(!$email){ array_push($_SESSION['login_errors'], 'Email is Required'); }

if(!$password){ array_push($_SESSION['login_errors'], 'Password is Required'); }

if(count($_SESSION['login_errors']) > 0){ exit(); }

if(!UsersController::confirmLogin($email, $password)){ array_push($_SESSION['login_errors'], 'Incorrect Email or Password'); }
else{ $_SESSION['main'] = 'location:http://'.$_SERVER['SERVER_NAME'].'/Bug-Tracking-WebApp/Views/html/main.php'; }
?>
