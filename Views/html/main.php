<?php
require_once __DIR__.'/../../Models/user.php';
if(!isset($_SESSION)){
	session_start();
}
$role = $_SESSION['loggedInUser']->getRole();
header('location:./'.$role.'/main.php');
?>
