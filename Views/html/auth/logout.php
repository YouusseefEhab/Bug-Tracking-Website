<?php
if(!isset($_SESSION)){
	session_start();
}
session_unset();
header('location:http://'.$_SERVER['SERVER_NAME'].'/Bug-Tracking-WebApp/Views/html/auth/authentication-login.php');
?>
