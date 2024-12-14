<?php
require_once __DIR__.'/../../../Controllers/customerPermissions.php';
require_once __DIR__.'/../../../Controllers/dbController.php';

if(!isset($_SESSION)){
	session_start();
}

if(isset($_SESSION['bug_errors'])){
	$bug_errors = $_SESSION['bug_errors'];
	unset($_SESSION['bug_errors']);
}

$success = "";
if(isset($_SESSION['bug_success']))
{
	$success = "Bug Added Successfully";
	unset($_SESSION['bug_success']);
}

$query = 'SELECT * FROM projects ORDER BY name ASC;';
$projectsResult = DbController::query($query);
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
							if(isset($bug_errors)){
							foreach($bug_errors as $error){
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
							<form enctype="multipart/form-data" action="./form-handling/new-bug.php" method="POST">
								<div class="mb-3">
									<label for="projectID" class="form-label">Project</label>
									<select id="projectID" class="form-control" name="projectID">
										<option selected value=""> -- Select a Project -- </option>
										<?php
											while($row = $projectsResult->fetch_assoc())
											echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
										?>
									</select> 
								</div>
								<div class="mb-3">
									<label for="description" class="form-label">Description</label>
									<br>
									<textarea id="description" name="description" rows="4" cols="30" placeholder="Brief Description of Bug."></textarea>
								</div>
								<div class="mb-3">
									<label for="screenshot" class="form-label">Bug Screenshot (PNG, JPG or JPEG Only)</label>
									<br>
									<input type="file" name="screenshot" id="screenshot" accept=".png,.jpg,.jpeg">
								</div>
								<button type="submit" class="btn btn-primary fw-semibold fs-4">Add Bug</button>
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
