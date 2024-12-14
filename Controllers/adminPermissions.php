<?php
require_once __DIR__.'/../Models/user.php';
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['loggedInUser']))
	header('location:http://'.$_SERVER['SERVER_NAME'].'/Bug-Tracking-WebApp/Views/html/auth/authentication-login.php');
elseif($_SESSION['loggedInUser']->getRole() != 'Admin')
	header($_SESSION['main']);
?>
