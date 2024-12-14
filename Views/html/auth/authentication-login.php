<?php
if(!isset($_SESSION)){
	session_start();
}

if(isset($_SESSION['loggedInUser'])){ header($_SESSION['main']); exit(); }
if(isset($_SESSION['login_errors'])){
	$login_errors = $_SESSION['login_errors'];
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
			<div
				class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
				<div class="d-flex align-items-center justify-content-center w-100">
					<div class="row justify-content-center w-100">
						<div class="col-md-8 col-lg-6 col-xxl-3">
							<div class="card mb-0">
								<div class="card-body">
									<img class="text-nowrap logo-img text-center d-block py-3 w-100" src="../../assets/images/logos/dark-logo.svg" width="180" alt="">
									<?php 
									if(isset($login_errors)){
										foreach($login_errors as $error){
											echo '<div class="alert alert-danger" role="alert">';
											echo $error;
											echo '</div>';
										}
									}
									?>
									<form action="./authenticate.php" method="POST">
										<div class="mb-3">
											<label for="email" class="form-label">Email</label>
											<input type="email" class="form-control" name="email" aria-describedby="emailHelp">
										</div>
										<div class="mb-4">
											<label for="password" class="form-label">Password</label>
											<input type="password" class="form-control" name="password">
										</div>
										<input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sign In">
										<div class="d-flex align-items-center justify-content-center">
											<p class="fs-4 mb-0 fw-bold">New to Bug Tracker</p>
											<a class="text-primary fw-bold ms-2" href="./authentication-register.php">Create an account</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
		<script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	</body>

</html>
