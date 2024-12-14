<?php
require_once __DIR__.'/../../../../Controllers/projectsController.php';

if(!isset($_SESSION)){
	session_start();
}

header('location:'.$_SERVER['HTTP_REFERER']);

$_SESSION['project_errors'] = array();

$conn = DbController::openConnection();

$name = mysqli_real_escape_string($conn, $_POST['name']);
$category = $_POST['category'];

$conn->close();

if(!$name){ array_push($_SESSION['project_errors'], 'Project Name is Required'); }

if(count($_SESSION['project_errors']) > 0) exit();

if(ProjectsController::isProjectNameTaken($name)){ array_push($_SESSION['project_errors'], 'Project Name Already Taken'); }

if(count($_SESSION['project_errors']) == 0){
	ProjectsController::addProject($name, $category);
	$_SESSION['project_success'] = true;
}
?>
