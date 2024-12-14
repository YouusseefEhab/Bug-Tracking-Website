<?php
require_once __DIR__.'/../../../Controllers/staffPermissions.php';
require_once __DIR__ . '/../../../Controllers/projectsController.php';
require_once __DIR__ . '/../../../Controllers/usersController.php';
require_once __DIR__ . '/../../../Controllers/bugsController.php';
require_once __DIR__ . '/../../../Models/bug.php';
require_once __DIR__ . '/../../../Models/user.php';

$bugs = BugsController::getBugsArray(orderBy: 'priority_id', assignedStaffID: $_SESSION['loggedInUser']->getID());
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
				<div class="row">
					<?php
					for ($i = 0; $i < count($bugs); $i++) {
						if($bugs[$i]->getStatus() == 'Investigating')
						{
							echo '
							<div class="col-sm-6 col-xl-3">
								<div class="card overflow-hidden rounded-2">
									<div class="card-body pt-3 p-4">
										<br>
										<h1 class="fw-semibold w-100 text-center">Bug #' . $bugs[$i]->getID() . '</h1>
										<h3 class="fw-semibold w-100 text-center" style="color: ' . $bugs[$i]->getPriorityColor() . ';">Priority: ' . $bugs[$i]->getPriority() . '</h3>
										<br>
										<h4 class="fw-semibold w-100 text-center">Status: ' . $bugs[$i]->getStatus() . '</h4>
										<h4 class="fw-semibold w-100 text-center">Project: ' . ProjectsController::getProjectFromID($bugs[$i]->getProjectID()) . '</h4>
											<div class="d-flex align-items-center justify-content-center w-100">
											<form action="bug-page.php" method="GET" class="w-100">
												<input type="hidden" name="bugID" value="' . $bugs[$i]->getID() . '">
												<button type="submit" class="btn btn-dark w-100 m-1 fs-5">See Details</button>
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
					}
					echo '
						</div>
						<div class="row">
						';
					for ($i = 0; $i < count($bugs); $i++) {
						if($bugs[$i]->getStatus() == 'Fixed')
						{
							echo '
							<div class="col-sm-6 col-xl-3">
								<div class="card overflow-hidden rounded-2">
									<div class="card-body pt-3 p-4">
										<br>
										<h1 class="fw-semibold w-100 text-center">Bug #' . $bugs[$i]->getID() . '</h1>
										<h3 class="fw-semibold w-100 text-center" style="color: ' . $bugs[$i]->getPriorityColor() . ';">Priority: ' . $bugs[$i]->getPriority() . '</h3>
										<br>
										<h4 class="fw-semibold w-100 text-center">Status: ' . $bugs[$i]->getStatus() . '</h4>
										<h4 class="fw-semibold w-100 text-center">Project: ' . ProjectsController::getProjectFromID($bugs[$i]->getProjectID()) . '</h4>
											<div class="d-flex align-items-center justify-content-center w-100">
											<form action="bug-page.php" method="GET" class="w-100">
												<input type="hidden" name="bugID" value="' . $bugs[$i]->getID() . '">
												<button type="submit" class="btn btn-dark w-100 m-1 fs-5">See Details</button>
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
