<?php


require_once "./includes/auth.php";
require_once("./includes/class-instructor-dashboard.php");
$userID = $_SESSION['id'];
$dashboard = new InstructorDashboard($conn, $userID);
$totalUsers = $dashboard->get_total_users();
$totalInstructors = $dashboard->get_total_instructors();
$totalExercises = $dashboard->get_total_exercises();
$totalWorkouts = $dashboard->get_total_workouts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Instructor Dashboard</title>
	<?php include "./components/css.php" ?>
	<link rel="stylesheet" href="css/instructor-index.css" />
</head>

<body>
	<!-- header -->
	<?php include "../admin/components/navbar.php" ?>
	<!-- header -->
	<div class="grid-container">
		<!-- side -->
		<?php include "./components/sidebar.php" ?>
		<!-- side -->

		<!-- main -->
		<main class="main-container">
			<div class="page-title">
				<h1>DASHBOARD</h1>
			</div>
			<div class="card-section">
				<hr>
				<!-- cards -->
				<div class="cards">
					<div class="yellow card shadow">
						<div class="left-card"><i class="fa fa-user" aria-hidden="true"></i></div>
						<div class="right-card">
							<h2><?= $totalUsers; ?></h2>
							<p>Total Users</p>
						</div>
					</div>
					<div class="red card shadow">
						<div class="left-card"><i class="fa fa-users" aria-hidden="true"></i></div>
						<div class="right-card">
							<h2><?= $totalInstructors; ?></h2>
							<p>Total Instructors</p>
						</div>
					</div>
					<div class="green card shadow">
						<div class="left-card"><i class="fa fa-star" aria-hidden="true"></i></div>
						<div class="right-card">
							<h2><?= $totalExercises ?></h2>
							<p>Total Exercises Made By Me</p>
						</div>
					</div>
				</div>
				<!-- cards -->
			</div>
			<br>
			<div class="card-section">
				<div class="cards">
					<div class="yellow card shadow">
						<div class="left-card"><i class="fa fa-user" aria-hidden="true"></i></div>
						<div class="right-card">
							<h2><?= $totalWorkouts; ?></h2>
							<p>Total Workouts Made By Me</p>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="js/index.js"> </script>
	<script src="js/scripts.js"> </script>
</body>

</html>