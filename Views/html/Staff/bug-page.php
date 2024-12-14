<?php
require_once __DIR__.'/../../../Controllers/staffPermissions.php';
require_once __DIR__.'/../../../Controllers/bugsController.php';
require_once __DIR__.'/../../../Controllers/projectsController.php';
require_once __DIR__.'/../../../Controllers/dbController.php';
require_once __DIR__.'/../../../Models/bug.php';
require_once __DIR__.'/../../../Models/user.php';
require_once __DIR__.'/../../../Models/message.php';

if(isset($_SESSION['assign_errors'])){
	$errors = $_SESSION['assign_errors'];
	unset($_SESSION['assign_errors']);
}

if(isset($_SESSION['message_errors'])){
	$errors = $_SESSION['message_errors'];
	unset($_SESSION['message_errors']);
}

$success = "";
if(isset($_SESSION['assign_success']))
{
	$success = "Bug Assigned Successfully";
	unset($_SESSION['assign_success']);
}

if(isset($_SESSION['message_success']))
{
	$success = "Message Sent Successfully";
	unset($_SESSION['message_success']);
}

if(isset($_GET['bugID']))
	$bug = BugsController::getBug($_GET['bugID']);
else
{
	echo 'Bug has to be in URL!';
	exit();
}

$query = 'SELECT * FROM priorities ORDER BY id ASC;';
$result = DbController::query($query);

$messages = MessagesController::getMessagesArray($bug->getReporter()->getID(), $bug->getID())
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
							<?php 
							if(isset($errors)){
							foreach($errors as $error){
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
							<h1 class="fw-bold display-3">Bug #<?php echo $bug->getID(); ?></h1>
							<br>
							<br>
							<br>
							<h3 class="fw-semibold">Project:</h3>
							<h4><?php echo ProjectsController::getProjectFromID($bug->getProjectID()); ?></h4>
							<br>
							<h3 class="fw-semibold">Status:</h3>
							<h4><?php echo $bug->getStatus(); ?></h4>
							<br>
							<h3 class="fw-semibold">Assigned Staff Member:</h3>
							<h4>ID: <?php echo $bug->getAssignedStaff()->getID(); ?></h4>
							<h4>Username: <?php echo $bug->getAssignedStaff()->getUsername(); ?></h4>
							<br>
							<h3 class="fw-semibold">Priority:</h3>
							<h4 style="color:<?php echo $bug->getPriorityColor(); ?>;"><?php echo $bug->getPriority(); ?></h4>
							<br>
							<h3 class="fw-semibold">Bug Creation Date:</h3>
							<h4>Date: <?php echo explode(' ', $bug->getDateCreated())[0]; ?></h4>
							<h4>Time: <?php echo explode(' ', $bug->getDateCreated())[1]; ?></h4>
							<br>
							<h3 class="fw-semibold">Description:</h3>
							<h4><?php echo $bug->getDescription(); ?></h4>
							<br>
							<h3 class="fw-semibold">Screenshot:</h3>
							<img class="border border-info" src="./form-handling/get-image.php?name=Bug-<?php echo $bug->getID(); ?>" width="800" height="500">
							<br>
							<br>
							<h3 class="fw-semibold">Bug Reporter:</h3>
							<h4>ID: <?php echo $bug->getReporter()->getID(); ?></h4>
							<h4>Username: <?php echo $bug->getReporter()->getUsername(); ?></h4>
							<br>
							<?php
							if($bug->getStatus() == 'Investigating')
							{
							?>
							<h3 class="fw-semibold">Send Message:</h3>
							<form action="./form-handling/send-message.php" method="POST">
								<input type="hidden" name="senderID" value="<?php echo $_SESSION['loggedInUser']->getID(); ?>">
								<input type="hidden" name="receiverID" value="<?php echo $bug->getReporter()->getID(); ?>">
								<input type="hidden" name="bugID" value="<?php echo $bug->getID(); ?>">
								<div class="mb-3">
									<label for="staffID" class="form-label">Message</label>
									<br>
									<textarea id="message" name="message" rows="5" cols="30" placeholder="Enter Message..."></textarea>
								</div>
								<div class="mb-3">
									<label for="fixed" class="form-label">Bug Fixed: </label>
									<input type="checkbox" id="fixed" name="fixed" value="<?php echo $bug->getID(); ?>">
								</div>
								<button type="submit" class="btn btn-primary fw-semibold fs-4">Send Message</button>
							</form>
							<br>
							<h3 class="fw-semibold">Assign bug to another Staff member:</h3>
							<form action="./form-handling/assign-bug.php" method="POST">
								<input type="hidden" name="bugID" value="<?php echo $bug->getID(); ?>">
								<div class="mb-3">
									<label for="staffID" class="form-label">Staff Member ID</label>
									<br>
									<input class="w-25" type="number" id="staffID" name="staffID">
								</div>
								<button type="submit" class="btn btn-primary fw-semibold fs-4">Assign Bug</button>
							</form>
							<?php
							}
							?>
							<br>
							<h3 class="fw-semibold">Messages:</h3>
							<?php
							for($i = 0; $i < count($messages); $i++)
							{
							echo '
							<h4>From: ' . $messages[$i]->getSender()->getUsername() . ' (' . $messages[$i]->getSender()->getRole() . ')</h4>
							<h4>' . $messages[$i]->getMessage() . '</h4>
							<br>
							';
							}
							?>
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
