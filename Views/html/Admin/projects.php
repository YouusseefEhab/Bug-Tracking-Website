<?php
require_once __DIR__.'/../../../Controllers/adminPermissions.php';
require_once __DIR__ . '/../../../Controllers/projectsController.php';
require_once __DIR__ . '/../../../Controllers/categoriesController.php';
require_once __DIR__ . '/../../../Models/project.php';

if (isset($_POST['projectToRemove'])) {
	ProjectsController::deleteProject($_POST['projectToRemove']);
}

$projects = ProjectsController::getProjectsArray();
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
	<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
		<!-- Sidebar Start -->
		<?php require './basics/sidebar.php'; ?>
		<!--  Sidebar End -->
		<!--  Main wrapper -->
		<div class="body-wrapper">
			<!--  Header Start -->
			<?php require './basics/header.php'; ?>
			<!--  Header End -->
			<div class="container-fluid">
				<div class="w-25 justify-content-center d-flex">
					<a href="./add-project.php" class="btn btn-primary w-75 m-1 fs-6 fw-semibold justify-content-center align-items-center">Add<br>Project</a>
				</div>
				<br>
				<div class="row">
					<?php
					for ($i = 0; $i < count($projects); $i++) {
						echo '
						<div class="col-sm-6 col-xl-3">
							<div class="card overflow-hidden rounded-2">
								<div class="card-body pt-3 p-4">
									<br>
									<h4 class="fs-8 fw-semibold w-100 text-center">' . $projects[$i]->getName() . '</h4>
									<br>
									<h4 class="fs-6 fw-semibold w-100 text-center">' . CategoriesController::getCategoryFromID($projects[$i]->getCategoryID()) . '</h4>
									<div class="d-flex align-items-center justify-content-center w-100">
										<form action="project-page.php" method="GET" class="w-100">
											<input type="hidden" name="projectID" value="' . $projects[$i]->getID() . '">
											<button type="submit" class="btn btn-dark w-100 m-1 fs-5">See Details</button>
										</form>
									</div>
									<div class="d-flex align-items-center justify-content-center w-100">
										<form action="" method="POST" class="w-100">
											<input type="hidden" name="projectToRemove" value="' . $projects[$i]->getName() . '">
											<button type="submit" class="btn btn-outline-danger w-100 m-1 fs-5">Delete Project</button>
										</form>
									</div>
								</div>
							</div>
						</div>
							';
						if ($i + 1 % 4 == 0) {
							echo '
								</div>
								<div class="row">
								';
						}
					}
					?>
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
