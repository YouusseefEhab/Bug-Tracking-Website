<?php
require_once __DIR__.'/../../../Controllers/staffPermissions.php';
require_once __DIR__.'/../../../Controllers/bugsController.php';
require_once __DIR__.'/../../../Controllers/projectsController.php';
require_once __DIR__.'/../../../Controllers/dbController.php';
require_once __DIR__.'/../../../Models/bug.php';
require_once __DIR__.'/../../../Models/user.php';

if(isset($_GET['staffID']))
	$staffID = $_GET['staffID'];
else
{
	echo 'Staff Member ID has to be in URL!';
	exit();
}

$query = "SELECT * FROM users WHERE id = $staffID;";
$result = DbController::query($query);
$staff = new User($result->fetch_assoc());

$query = "SELECT * FROM bugs WHERE assigned_staff_id = $staffID;";
$result = DbController::query($query);

$totalBugs = array();
$unfixedBugs = array();
$fixedBugs = array();

while($row = $result->fetch_assoc())
{
	$bug = new Bug($row);
	array_push($totalBugs, $bug);

	if($bug->getStatus() == 'Investigating')
		array_push($unfixedBugs, $bug);

	if($bug->getStatus() == 'Fixed')
		array_push($fixedBugs, $bug);
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
					<div class="card">
						<div class="card-body">
							<h1 class="fw-bold display-5"><?php echo $staff->getUsername(); ?> (<?php echo $staff->getRole(); ?>) (ID: <?php echo $staff->getID(); ?>)</h1>
							<br>
							<br>
							<br>
							<h3 class="fw-semibold">Total Bugs Assigned: <?php echo count($totalBugs); ?></h3>
							<br>
							<h3 class="fw-semibold">Bugs Under Investigation: <?php echo count($unfixedBugs); ?></h3>
							<br>
							<h3 class="fw-semibold">Total Bugs Fixed: <?php echo count($fixedBugs); ?></h3>
							<br>
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
