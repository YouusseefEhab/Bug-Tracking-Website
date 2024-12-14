<?php
require_once __DIR__.'/../../../Controllers/staffPermissions.php';
require_once __DIR__ . '/../../../Controllers/usersController.php';
require_once __DIR__ . '/../../../Models/user.php';

if(!isset($_SESSION)){
	session_start();
}

if (isset($_POST['IDToRemove'])) {
	UsersController::deleteAccount($_POST['IDToRemove']);
}

$users = UsersController::getUsersArray(UsersController::getRoleID('Staff'));
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
					for ($i = 0; $i < count($users); $i++) {
						echo '
						<div class="col-sm-6 col-xl-3">
							<div class="card overflow-hidden rounded-2">
								<div class="card-body pt-3 p-4">
									<br>
									<h4 class="fs-8 fw-semibold w-100 text-center">' . $users[$i]->getUsername() . '</h4>
									<h4 class="fs-8 fw-semibold w-100 text-center">ID: ' . $users[$i]->getID() . '</h4>
									<br>
									<h4 class="fs-8 fw-semibold w-100 text-center">' . $users[$i]->getRole() . '</h4>
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
