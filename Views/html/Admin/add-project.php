<?php
require_once __DIR__.'/../../../Controllers/adminPermissions.php';
require_once __DIR__.'/../../../Controllers/dbController.php';

if(!isset($_SESSION)){
	session_start();
}

if(isset($_SESSION['project_errors'])){
	$project_errors = $_SESSION['project_errors'];
	unset($_SESSION['project_errors']);
}

$query = 'SELECT * FROM categories;';
$result = DbController::query($query);

if(isset($_SESSION['project_success']))
{
	$success = "Project Added Successfully";
	unset($_SESSION['project_success']);
}
else
{
	$success = "";
}
?>

<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bug Tracker</title>
		<link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
		<link rel="stylesheet" href="../../assets/css/styles.min.css" />
	</head>

	<body>
		<!--  Body Wrapper -->
		<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
			data-sidebar-position="fixed" data-header-position="fixed">
			<!-- Sidebar Start -->
			<?php require './basics/sidebar.php'; ?>
			<!--  Sidebar End -->
			<!--  Main wrapper -->
			<div class="body-wrapper">
				<!--  Header Start -->
				<?php require './basics/header.php'; ?>
				<!--  Header End -->
				<div class="container-fluid">
					<div class="card w-50">
						<div class="card-body">
							<?php 
							if(isset($project_errors)){
							foreach($project_errors as $error){
								echo '<div class="alert alert-danger" role="alert">';
								echo $error;
								echo '</div>';
							}
							}
							if($success)
							{
								echo '<div class="alert alert-success" role="alert">';
								echo $success;
								echo '</div>';
							}
							?>
							<form action="./form-handling/new-project.php" method="POST">
								<div class="mb-3">
									<label for="name" class="form-label">Name</label>
									<input type="text" class="form-control" name="name" id="name">
										<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
								</div>
								<div class="mb-3">
									<label for="category" class="form-label">Category</label>
									<select id="category" class="form-control" name="category">
										<?php
										while($row = $result->fetch_assoc())
										echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
										?>
									</select> 
								</div>
								<button type="submit" class="btn btn-primary fw-semibold fs-4">Add Project</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--  Main wrapper End -->
		</div>
		<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
		<script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<script src="../../assets/js/sidebarmenu.js"></script>
		<script src="../../assets/js/app.min.js"></script>
		<script src="../../assets/libs/simplebar/dist/simplebar.js"></script>
	</body>

</html>
