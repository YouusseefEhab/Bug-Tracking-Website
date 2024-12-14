<?php
require_once __DIR__.'/../../../Controllers/adminPermissions.php';
if(!isset($_SESSION)){
	session_start();
}

if (isset($_SESSION['register_errors']))
{
	$register_errors = $_SESSION['register_errors'];
	unset($_SESSION['register_errors']);
}
if (isset($_SESSION['register_success']))
{
	$success = "Account Added Successfully";
	unset($_SESSION['register_success']);
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
				<div class="card w-50">
					<div class="card-body">
						<?php
						if (isset($register_errors)) {
							foreach ($register_errors as $error) {
								echo '<div class="alert alert-danger" role="alert">';
								echo $error;
								echo '</div>';
							}
						}
						if ($success) {
							echo '<div class="alert alert-success" role="alert">';
							echo $success;
							echo '</div>';
						}
						?>
						<form action="../auth/register.php" method="POST">
							<div class="mb-3">
								<label for="username" class="form-label">Username</label>
								<input type="text" class="form-control" name="username" id="username">
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
								<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
							</div>
							<div class="mb-3">
								<label for="password" class="form-label">Password</label>
								<input type="password" class="form-control" name="password" id="password">
							</div>
							<div class="mb-3">
								<label for="role" class="form-label">Role</label>
								<select id="role" name="role" class="form-control">
									<option value="Admin">Admin</option>
									<option value="Staff">Staff</option>
								</select>
							</div>
							<button type="submit" class="btn btn-primary fw-semibold fs-4">Add Account</button>
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
